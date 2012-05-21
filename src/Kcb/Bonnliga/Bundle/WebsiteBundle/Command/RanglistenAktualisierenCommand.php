<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spieler;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Platzierung;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\GesamtRang;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Wanderpokal\Monat;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class RanglistenAktualisierenCommand extends ContainerAwareCommand {

    public function configure() {
        $this->setName('kcb:bonnliga:ranglisten-aktualisieren');
    }

    public function run(InputInterface $input, OutputInterface $output) {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $ranglisteFactory = $this->getContainer()->get('kcb.bonnliga.rangliste_factory');

        // Ranglisten
        $ranglisten = array();
        $ranglisten['gesamt'] = $ranglisteFactory->getGesamtRangliste();
        $ranglisten['lady'] = $ranglisteFactory->getLadyRangliste();
        $ranglisten['hobby'] = $ranglisteFactory->getHobbyRangliste();
        $ranglisten['pro'] = $ranglisteFactory->getProRangliste();
        foreach ($em->getRepository('KcbBonnligaWebsiteBundle:Spielstaette')->findAll() as $spielstaette) {
            $ranglisten['spielstaette' . $spielstaette->getId()] = $ranglisteFactory->getSpielstaetteRangliste($spielstaette);
        }
        $stammlokale = $em->getRepository('KcbBonnligaWebsiteBundle:Location')->findAll();
        foreach ($stammlokale as $stammlokal) {
            $ranglisten['stammlokal' . $stammlokal->getId()] = $ranglisteFactory->getStammlokalRangliste($stammlokal);
        }

        foreach ($ranglisten as $rangliste)
            $rangliste->zuruecksetzen();

        $wanderpokalMonatRepository = $em->getRepository('KcbBonnligaWebsiteBundle:Wanderpokal\Monat');
        foreach ($wanderpokalMonatRepository->findAll() as $monat) {
            $em->remove($monat);
        }

        $em->flush();

        $letzterMonat = false;
        $wanderpokalMonat = false;

        foreach ($em->getRepository('KcbBonnligaWebsiteBundle:Turnier')->findBy(array(), array('beginn' => 'asc')) as $turnier) {
            if (!$turnier->isVorbei() || !$turnier->getPlatzierungen())
                continue;

            $monat = $turnier->getBeginn()->format('Y-m-01');
            if ($monat != $letzterMonat) {
                if ($letzterMonat) {
                    $this->persistWanderpokalMonat($em, $letzterMonat, $stammlokale, $ranglisten);
                }
            }
            $letzterMonat = $monat;

            foreach ($turnier->getPlatzierungen() as $platzierung) {
                $ranglisten['gesamt']->beruecksichtige($platzierung);

                if ($platzierung->getSpieler()->isWeiblich()) {
                    $ranglisten['lady']->beruecksichtige($platzierung);
                }
                if ($platzierung->getSpieler()->isHobby()) {
                    $ranglisten['hobby']->beruecksichtige($platzierung);
                }
                if ($platzierung->getSpieler()->isPro()) {
                    $ranglisten['pro']->beruecksichtige($platzierung);
                }

                $ranglisten['spielstaette' . $turnier->getSpielstaette()->getId()]->beruecksichtige($platzierung);
                if ($stammlokal = $platzierung->getSpieler()->getStammlokal())
                    $ranglisten['stammlokal' . $stammlokal->getId()]->beruecksichtige($platzierung);
            }

            foreach ($ranglisten as $rangliste)
                $rangliste->aktualisieren();
        }

        $this->persistWanderpokalMonat($em, $letzterMonat, $stammlokale, $ranglisten);

        $em->flush();
    }

    protected function persistWanderpokalMonat($em, $monat, $stammlokale, $ranglisten) {
        $em->flush();
        $wanderpokalMonat = new Monat(new \DateTime($monat));
        foreach ($stammlokale as $stammlokal) {
            $wanderpokalMonat->beruecksichtige($ranglisten['stammlokal' . $stammlokal->getId()]);
        }
        $em->persist($wanderpokalMonat);
    }

}