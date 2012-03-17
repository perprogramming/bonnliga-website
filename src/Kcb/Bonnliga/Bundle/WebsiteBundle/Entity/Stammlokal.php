<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="typ", type="string")
 * @ORM\DiscriminatorMap({"spielstaette" = "Spielstaette", "stammlokal" = "Stammlokal"})
 */
class Stammlokal extends Location {

    /**
     * @ORM\OneToMany(targetEntity="Spieler", mappedBy="stammlokal")
     */
    protected $stammspieler;

    public function __construct() {
        $this->stammspieler = new \Doctrine\Common\Collections\ArrayCollection();
    }

}