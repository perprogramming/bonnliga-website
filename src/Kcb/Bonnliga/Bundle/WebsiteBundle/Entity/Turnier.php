<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="TurnierRepository")
 */
class Turnier {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Spielstaette", inversedBy="turniere")
     */
    protected $spielstaette;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $beginn;

    /**
     * @ORM\OneToMany(targetEntity="Platzierung", mappedBy="turnier", cascade={"ALL"}, orphanRemoval=true)
     * @ORM\OrderBy({"platzierung" = "ASC"})
     */
    protected $platzierungen;

    /**
     * @ORM\Column(type="text")
     */
    protected $beschreibung;

    public function __construct() {
        $this->platzierungen = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function addPlatzierung(Platzierung $platzierung) {
        $platzierung->setTurnier($this);
        $this->platzierungen->add($platzierung);
    }

    public function getPlatzierungen() {
        return $this->platzierungen;
    }

    public function setSpielstaette(Spielstaette $spielstaette) {
        $this->spielstaette = $spielstaette;
    }

    public function getSpielstaette() {
        return $this->spielstaette;
    }

    public function setBeginn($beginn) {
        $this->beginn = $beginn;
    }

    public function getBeginn() {
        return $this->beginn;
    }

    public function isKommend() {
        return $this->beginn > new \DateTime('now');
    }

    public function isVorbei() {
        return !$this->isKommend();
    }

    public function isNichtBald() {
        return $this->beginn > new \DateTime('next month');
    }

    public function setBeschreibung($beschreibung) {
        $this->beschreibung = $beschreibung;
    }

    public function getBeschreibung() {
        return $this->beschreibung;
    }

}