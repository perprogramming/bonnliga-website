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
        $teilnehmerAnzahl = count($this->getTurnier()->getPlatzierungen());
        $platz = $this->platzierung;
        return ($teilnehmerAnzahl - $platz) + 1;
    }

}
