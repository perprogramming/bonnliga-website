<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="typ", type="string")
 * @ORM\DiscriminatorMap({"spielstaette" = "Spielstaette", "stammlokal" = "Stammlokal"})
 */
abstract class Location {

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
     * @ORM\Column
     */
    protected $slug;

    /**
     * @ORM\OneToMany(targetEntity="Spieler", mappedBy="stammlokal")
     */
    protected $stammspieler;

    public function __construct() {
        $this->stammspieler = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function setSlug($slug) {
        $this->slug = $slug;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getStammspieler() {
        return $this->stammspieler;
    }

}