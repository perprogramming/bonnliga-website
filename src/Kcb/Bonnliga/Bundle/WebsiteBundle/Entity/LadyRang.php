<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spieler;

/**
 * @ORM\Entity(repositoryClass="RangRepository")
 */
class LadyRang extends Rang {

    public function __construct(Spieler $spieler) {
        if (!$spieler->isWeiblich())
            throw new \Exception();
        parent::__construct($spieler);
    }

}
