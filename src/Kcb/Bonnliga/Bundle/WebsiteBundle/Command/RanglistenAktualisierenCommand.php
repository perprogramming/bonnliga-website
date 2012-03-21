<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spieler;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Platzierung;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\GesamtRang;
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

        foreach ($ranglisten as $rangliste)
            $rangliste->zuruecksetzen();

        $em->flush();

        foreach ($em->getRepository('KcbBonnligaWebsiteBundle:Turnier')->findBy(array(), array('id' => 'asc')) as $turnier) {
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
            }

            foreach ($ranglisten as $rangliste)
                $rangliste->aktualisieren();
        }

        $em->flush();
    }

}