<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spieler;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Platzierung;

/**
 * @ORM\Entity(repositoryClass="SpielstaetteRangRepository")
 */
class SpielstaetteRang extends Rang {

    /**
     * @ORM\ManyToOne(targetEntity="Spielstaette")
     */
    protected $spielstaette;

    public function __construct(Spieler $spieler, Spielstaette $spielstaette) {
        parent::__construct($spieler);
        $this->spielstaette = $spielstaette;
    }

    public function beruecksichtige(Platzierung $platzierung) {
        if ($platzierung->getTurnier()->getSpielstaette() !== $this->spielstaette)
            throw new \Exception();
        parent::beruecksichtige($platzierung);
    }

}
