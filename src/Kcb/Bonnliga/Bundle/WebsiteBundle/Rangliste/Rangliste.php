<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Rangliste;

use Doctrine\ORM\EntityManager;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Platzierung;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spieler;

abstract class Rangliste {

    protected $entityManager;
    protected $geaendert = false;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    abstract protected function getEntityRepository();

    public function getRaenge() {
        return $this->getEntityRepository()->findAll();
    }

    public function getRang(Spieler $spieler) {
        return $this->getEntityRepository()->findOneBySpieler($spieler);
    }

    public function zuruecksetzen() {
        foreach ($this->getRaenge() as $rang) {
            $rang->zuruecksetzen();
        }
    }

    public function beruecksichtige(Platzierung $platzierung) {
        $this->getRang($platzierung->getSpieler())->beruecksichtige($platzierung);
        $this->geaendert = true;
    }

    public function aktualisieren() {
        if (!$this->geaendert)
            return;

        $raenge = $this->getRaenge();

        usort($raenge, function($a, $b) {
            $aPunkte = $a->getPunkte();
            $bPunkte = $b->getPunkte();
            if ($aPunkte != $bPunkte)
                return $b->getPunkte() - $a->getPunkte();

            return strcmp($a->getSpieler()->getName(), $b->getSpieler()->getName());
        });

        $aktuellePunktzahl = PHP_INT_MAX;
        $naechsterRang = 0;
        $aktuellerRang = 0;
        foreach ($raenge as $rang) {
            $punkte = $rang->getPunkte();
            $naechsterRang++;
            if ($punkte <= $aktuellePunktzahl) {
                $aktuellerRang = $naechsterRang;
            }
            $rang->setRang($aktuellerRang);
            $aktuellePunktzahl = $punkte;
        }

        $this->geaendert = false;
    }

}