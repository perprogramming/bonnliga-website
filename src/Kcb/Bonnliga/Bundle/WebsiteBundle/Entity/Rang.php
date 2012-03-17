<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="typ", type="string")
 * @ORM\DiscriminatorMap({"gesamt" = "GesamtRang"})
 */
abstract class Rang {

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
    protected $punkte;

    /**
     * @ORM\Column(type="integer")
     */
    protected $teilnahmen;

    /**
     * @ORM\Column(type="text")
     */
    protected $tendenz;

    public function getId() {
        return $this->id;
    }

    public function setPunkte($punkte) {
        $this->punkte = $punkte;
    }

    public function getPunkte() {
        return $this->punkte;
    }

    public function setRang($rang) {
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

    public function setTeilnahmen($teilnahmen) {
        $this->teilnahmen = $teilnahmen;
    }

    public function getTeilnahmen() {
        return $this->teilnahmen;
    }

    public function setTendenz($tendenz) {
        $this->tendenz = $tendenz;
    }

    public function getTendenz() {
        return $this->tendenz;
    }

}