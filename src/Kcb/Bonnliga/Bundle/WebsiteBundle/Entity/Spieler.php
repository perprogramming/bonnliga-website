<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Spieler {

    // Fake enum - Geschlecht
    const GESCHLECHT_WEIBLICH = "Weiblich";
    const GESCHLECHT_MAENNLICH = "Männlich";

    // Fake enum - Status
    const EINSTUFUNG_PRO = "Pro";
    const EINSTUFUNG_HOBBY = "Hobby";

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column
     */
    protected $vorname;

    /**
     * @ORM\Column
     */
    protected $nachname;

    /**
     * @ORM\ManyToOne(targetEntity="Location", inversedBy="stammspieler")
     */
    protected $stammlokal;

    /**
     * @ORM\OneToMany(targetEntity="Platzierung", mappedBy="spieler")
     */
    protected $platzierungen;

    /**
     * @ORM\Column(type="string")
     */
    protected $geschlecht;

    /**
     * @ORM\Column(type="string")
     */
    protected $einstufung;

    public function __construct() {
        $this->platzierungen = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->vorname . ' ' . substr($this->nachname, 0, 1) . '.';
    }

    public function setStammlokal(Location $stammlokal) {
        $this->stammlokal = $stammlokal;
    }

    public function getStammlokal() {
        return $this->stammlokal;
    }

    public function getPlatzierungen() {
        return $this->platzierungen;
    }

    public function setGeschlecht($geschlecht)
    {
        if(!in_array($geschlecht, array(self::GESCHLECHT_MAENNLICH, self::GESCHLECHT_WEIBLICH)))
            throw new \InvalidArgumentException("Ungültiges Geschlecht");

        $this->geschlecht = $geschlecht;
    }

    public function getGeschlecht()
    {
        return $this->geschlecht;
    }

    public function setEinstufung($einstufung)
    {
        if(!in_array($einstufung, array(self::EINSTUFUNG_HOBBY, self::EINSTUFUNG_PRO)))
                    throw new \InvalidArgumentException("Ungültige Einstufung");

        $this->einstufung = $einstufung;
    }

    public function getEinstufung()
    {
        return $this->einstufung;
    }

    public function setNachname($nachname) {
        $this->nachname = $nachname;
    }

    public function getNachname() {
        return $this->nachname;
    }

    public function setVorname($vorname) {
        $this->vorname = $vorname;
    }

    public function getVorname() {
        return $this->vorname;
    }
}