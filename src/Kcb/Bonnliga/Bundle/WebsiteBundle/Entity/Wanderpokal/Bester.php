<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Wanderpokal;

use Doctrine\ORM\Mapping as ORM;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spieler;

/**
 * @ORM\Entity
 * @ORM\Table(name="WanderpokalBester")
 */
class Bester {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Rang", inversedBy="beste")
     * @ORM\JoinColumn(name="rang_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $rang;

    /**
     * @ORM\ManyToOne(targetEntity="Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spieler")
     */
    protected $spieler;

    /**
     * @ORM\Column(type="integer")
     */
    protected $punkte = 0;

    public function __construct(Rang $rang, Spieler $spieler, $punkte) {
        $this->rang = $rang;
        $this->spieler = $spieler;
        $this->punkte = $punkte;
    }

    public function getId() {
        return $this->id;
    }

    public function getMonatsrang() {
        return $this->monatsrang;
    }

    public function getPunkte() {
        return $this->punkte;
    }

    public function getSpieler() {
        return $this->spieler;
    }

}