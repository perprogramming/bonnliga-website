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

class UpdateRanglistenCommand extends ContainerAwareCommand {

    public function configure() {
        $this->setName('kcb:bonnliga:update-ranglisten');
    }

    public function run(InputInterface $input, OutputInterface $output) {
        // Reset
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        foreach($em->getRepository('KcbBonnligaWebsiteBundle:Rang')->findAll() as $rang) {
            $em->remove($rang);
        }
        $em->flush();

        $gesamtRangliste = new \SplObjectStorage();

        $alleSpieler = $em->getRepository('KcbBonnligaWebsiteBundle:Spieler')->findAll();
        foreach ($alleSpieler as $spieler) {
            $rang = new GesamtRang();
            $rang->setSpieler($spieler);
            $gesamtRangliste[$spieler] = $rang;
            $em->persist($rang);
        }

        foreach ($em->getRepository('KcbBonnligaWebsiteBundle:Turnier')->findBy(array(), array('id' => 'asc')) as $turnier) {
            foreach ($turnier->getPlatzierungen() as $platzierung) {
                $spieler = $platzierung->getSpieler();
                $gesamtRang = $gesamtRangliste[$spieler];
                $gesamtRang->addPunkte($this->berechnePlatzierungPunkte($platzierung));
                $gesamtRang->erhoeheTeilnahmen();
            }
            $this->berechneRaenge($gesamtRangliste);
        }

        $em->flush();
    }

    protected function berechneRaenge(\SplObjectStorage $storage) {
        $raenge = array();
        foreach ($storage as $spieler) {
            $raenge[] = $storage[$spieler];
        }

        usort($raenge, function($a, $b) {
            return $b->getPunkte() - $a->getPunkte();
        });

        $aktuellePunktzahl = PHP_INT_MAX;
        $aktuellerRang = 0;
        foreach ($raenge as $rang) {
            if ($rang->getPunkte() < $aktuellePunktzahl) {
                $aktuellerRang++;
            }
            $rang->setRang($aktuellerRang);
        }
    }

    protected function berechnePlatzierungenPunkte(Collection $platzierungen) {
        $punkte = 0;
        foreach ($platzierungen as $platzierung) {
            $punkte += $this->berechnePlatzierungPunkte($platzierung);
        }
        return $punkte;
    }

    protected function berechnePlatzierungPunkte(Platzierung $platzierung) {
        $teilnehmerAnzahl = count($platzierung->getTurnier()->getPlatzierungen());
        $platz = $platzierung->getPlatzierung();
        return ($teilnehmerAnzahl - $platz) + 1;
    }

}