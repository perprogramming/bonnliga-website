<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="RangRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="typ", type="string")
 * @ORM\DiscriminatorMap({
 *      "gesamt" = "GesamtRang",
 *      "lady" = "LadyRang",
 *      "hobby" = "HobbyRang",
 *      "pro" = "ProRang",
 *      "spielstaette" = "SpielstaetteRang",
 *      "stammlokal" = "StammlokalRang"
 * })
 */
abstract class Rang {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
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

    public function __construct(Spieler $spieler) {
        $this->spieler = $spieler;
    }

    public function setRang($rang) {
        if ($rang == $this->rang) {
            $this->tendenz = 'gleich';
        } elseif ($this->rang == null) {
            $this->tendenz = 'steigend';
        } elseif ($rang > $this->rang) {
            $this->tendenz = 'fallend';
        } else {
            $this->tendenz = 'steigend';
        }
        $this->rang = $rang;
    }

    public function beruecksichtige(Platzierung $platzierung) {
        if ($platzierung->getSpieler() != $this->spieler)
            throw new \RuntimeException();
        $this->punkte += $platzierung->getPunkte();
        $this->teilnahmen++;
    }

    public function zuruecksetzen() {
        $this->punkte = 0;
        $this->teilnahmen = 0;
        $this->tendenz = 'gleich';
        $this->rang = null;
    }

    public function getId() {
        return $this->id;
    }

    public function getPunkte() {
        return $this->punkte;
    }

    public function getRang() {
        return $this->rang;
    }

    public function getSpieler() {
        return $this->spieler;
    }

    public function getTeilnahmen() {
        return $this->teilnahmen;
    }

    public function getTendenz() {
        return $this->tendenz;
    }

}