<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spieler;

/**
 * @ORM\Entity(repositoryClass="StammlokalRangRepository")
 */
class StammlokalRang extends Rang {

    /**
     * @ORM\ManyToOne(targetEntity="Location")
     */
    protected $stammlokal;

    public function __construct(Spieler $spieler, Location $stammlokal) {
        if ($spieler->getStammlokal() !== $stammlokal)
            throw new \Exception();
        parent::__construct($spieler);
        $this->stammlokal = $stammlokal;
    }

}
