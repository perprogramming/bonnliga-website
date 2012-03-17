<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spielstaette;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Stammlokal;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spieler;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Turnier;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Platzierung;

class LoadData extends AbstractFixture {

    protected $spielstaetteIndex = 0;
    protected $locationIndex = 0;
    protected $stammlokalIndex = 0;
    protected $spielerIndex = 0;
    protected $turnierIndex = 0;

    public function load(ObjectManager $manager) {
        foreach (array(
            'Babel',
            'Wache',
            'Maya',
            'Carpe Noctem'
        ) as $name) {
            $spielstaetteIndex = ++$this->spielstaetteIndex;
            $locationIndex = ++$this->locationIndex;

            $spielstaette = new Spielstaette();
            $spielstaette->setName($name);
            $this->addReference("spielstaette$spielstaetteIndex", $spielstaette);
            $this->addReference("location$locationIndex", $spielstaette);
            $manager->persist($spielstaette);
        }

        foreach (array(
            'Foosclub',
            'Pörx'
         ) as $name) {
            $stammlokalIndex = ++$this->stammlokalIndex;
            $locationIndex = ++$this->locationIndex;

            $stammlokal = new Stammlokal();
            $stammlokal->setName($name);
            $this->addReference("stammlokal$stammlokalIndex", $stammlokal);
            $this->addReference("location$locationIndex", $stammlokal);
            $manager->persist($stammlokal);
        }

        for ($n = 0; $n < 300; $n++) {
            $spielerIndex = ++$this->spielerIndex;
            $locationIndex = rand(1, $this->locationIndex);
            $stammlokal = $this->getReference("location$locationIndex");

            $spieler = new Spieler();
            $spieler->setName("Spieler $spielerIndex");
            $spieler->setStammlokal($stammlokal);
            $this->addReference("spieler$spielerIndex", $spieler);
            $manager->persist($spieler);
        }

        for ($n = 0; $n < 100; $n++) {
            $turnierIndex = ++$this->turnierIndex;
            $spielstaetteIndex = rand(1, $this->spielstaetteIndex);
            $spielstaette = $this->getReference("spielstaette$spielstaetteIndex");

            $turnier = new Turnier();

            $beliebigerZeitpunkt = time() - (rand(-20, 20) * 60 * 60 * 24);

            $turnier->setBeginn(new \Datetime("@$beliebigerZeitpunkt"));
            $turnier->setSpielstaette($spielstaette);

            for ($m = 0, $max = rand(10, 30); $m < $max; $m++) {
                $spielerIndex = rand(1, $this->spielerIndex);
                $spieler = $this->getReference("spieler$spielerIndex");

                $platzierung = new Platzierung();
                $platzierung->setSpieler($spieler);
                $platzierung->setPlatzierung($m + 1);
                $turnier->addPlatzierung($platzierung);
            }

            $manager->persist($turnier);
        }

        $manager->flush();
    }

}