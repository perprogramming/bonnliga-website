<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Platzierung {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Turnier", inversedBy="platzierungen")
     */
    protected $turnier;

    /**
     * @ORM\ManyToOne(targetEntity="Spieler", inversedBy="platzierungen")
     */
    protected $spieler;

    /**
     * @ORM\Column(type="integer")
     */
    protected $platzierung;

    public function getId() {
        return $this->id;
    }

    public function setPlatzierung($platzierung) {
        $this->platzierung = $platzierung;
    }

    public function getPlatzierung() {
        return $this->platzierung;
    }

    public function setSpieler($spieler) {
        $this->spieler = $spieler;
    }

    public function getSpieler() {
        return $this->spieler;
    }

    public function setTurnier($turnier) {
        $this->turnier = $turnier;
    }

    public function getTurnier() {
        return $this->turnier;
    }

    public function getPunkte() {
        // Teilnehmeranzahl && Platzierung
        $n = count($this->getTurnier()->getPlatzierungen());
        $p = $this->platzierung;

        // Wenn nur ein Spieler, dann gibt's auch keine Punkte
        if ($n < 2) return 0;

        // Stufen
        $s = floor(log($n - 1) / log(2)) + 2;

        /*
         * Kurzbeschreibung:
         * ln(n-1)/ln(2) ~ wie oft kann ich n durch 2 teilen -> Anzahl Punktstufen
         *
         * die untere H√§lfte der Teilnehmer bekommt 2 Punkte
         * die untere H√§lfte des Rests bekommt 3 Punkte
         * ...
         * bis zu den top3 Teams (6 Teilnehmer), die dann jeweils eine Stufe sind
         */
        $punkte = ($s - floor(log(max(1, $p - 1)) / log(2))) + floor((($n - $p) + 6) / $n);

        // Bei weniger als 8 Spielern reduzieren wir die Punkte
        if ($n < 8) {
            $punkte -= 2;
        }

        return $punkte;
    }

}
