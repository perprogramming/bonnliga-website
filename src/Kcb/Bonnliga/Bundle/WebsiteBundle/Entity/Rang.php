<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="typ", type="string")
 * @ORM\DiscriminatorMap({"gesamt" = "GesamtRang"})
 */
class Rang {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $rang;

    /**
     * @ORM\ManyToOne(targetEntity="Spieler")
     */
    protected $spieler;

    /**
     * @ORM\Column(type="integer")
     */
    protected $punkte = 0;

    /**
     * @ORM\Column(type="integer")
     */
    protected $teilnahmen = 0;

    /**
     * @ORM\Column(type="text")
     */
    protected $tendenz = 'gleich';

    public function getId() {
        return $this->id;
    }

    public function addPunkte($punkte) {
        $this->punkte += $punkte;
    }

    public function getPunkte() {
        return $this->punkte;
    }

    public function setRang($rang) {
        if ($rang == $this->rang) {
            $this->tendenz = 'gleich';
        } elseif ($rang < $this->rang) {
            $this->tendenz = 'fallend';
        } else {
            $this->tendenz = 'steigend';
        }
        $this->rang = $rang;
    }

    public function getRang() {
        return $this->rang;
    }

    public function setSpieler(Spieler $spieler) {
        $this->spieler = $spieler;
    }

    public function getSpieler() {
        return $this->spieler;
    }

    public function erhoeheTeilnahmen() {
        $this->teilnahmen++;
    }

    public function getTeilnahmen() {
        return $this->teilnahmen;
    }

    public function getTendenz() {
        return $this->tendenz;
    }

}