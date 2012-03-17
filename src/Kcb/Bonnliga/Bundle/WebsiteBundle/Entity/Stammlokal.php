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
}