<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Spieler {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Location", inversedBy="stammspieler")
     */
    protected $stammlokal;

    /**
     * @ORM\OneToMany(targetEntity="Platzierung", mappedBy="spieler")
     */
    protected $platzierungen;

    public function __construct() {
        $this->platzierungen = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setStammlokal(Location $stammlokal) {
        $this->stammlokal = $stammlokal;
    }

    public function getStammlokal() {
        return $this->stammlokal;
    }

}