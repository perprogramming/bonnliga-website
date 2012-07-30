<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Rangliste;

use Symfony\Component\DependencyInjection\Container;

class Calculation {

    public static function run(Container $container) {
        $em = $container->get('doctrine.orm.entity_manager');
        $ranglisteFactory = $container->get('kcb.bonnliga.rangliste_factory');

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
        $vormonat = null;

        foreach ($em->getRepository('KcbBonnligaWebsiteBundle:Turnier')->findBy(array(), array('beginn' => 'asc')) as $turnier) {
            if (!$turnier->isVorbei() || !$turnier->getPlatzierungen())
                continue;

            $monat = $turnier->getBeginn()->format('Y-m-01');
            if ($monat != $letzterMonat) {
                if ($letzterMonat) {
                    $vormonat = self::persistWanderpokalMonat($em, $letzterMonat, $stammlokale, $ranglisten, $vormonat);
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

        $vormonat = self::persistWanderpokalMonat($em, $letzterMonat, $stammlokale, $ranglisten, $vormonat);

        $em->flush();
    }

    protected static function persistWanderpokalMonat($em, $monat, $stammlokale, $ranglisten, Monat $vormonat = null) {
        $em->flush();
        $wanderpokalMonat = new Monat(new \DateTime($monat));
        foreach ($stammlokale as $stammlokal) {
            $wanderpokalMonat->beruecksichtige($ranglisten['stammlokal' . $stammlokal->getId()], $vormonat);
        }
        $em->persist($wanderpokalMonat);
        return $wanderpokalMonat;
    }

}