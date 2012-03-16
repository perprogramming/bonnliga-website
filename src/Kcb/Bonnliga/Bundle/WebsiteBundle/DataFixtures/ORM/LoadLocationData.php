<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Location;
use Doctrine\Common\Persistence\ObjectManager;

class LoadLocationData implements FixtureInterface {

    public function load(ObjectManager $manager) {
        foreach (array(
            'Babel',
            'Wache',
            'Maya',
            'Carpe Noctem'
        ) as $name) {
            $location = new Location();
            $location->setName($name);
            $manager->persist($location);
        }

        $manager->flush();
    }

}