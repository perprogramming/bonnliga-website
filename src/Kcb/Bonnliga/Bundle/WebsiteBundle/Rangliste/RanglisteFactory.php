<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Rangliste;

use Doctrine\ORM\EntityManager;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spielstaette;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Location;

class RanglisteFactory {

    protected $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getGesamtrangliste() {
        return new GesamtRangliste($this->entityManager);
    }

    public function getLadyRangliste() {
        return new LadyRangliste($this->entityManager);
    }

    public function getHobbyRangliste() {
        return new HobbyRangliste($this->entityManager);
    }

    public function getProRangliste() {
        return new ProRangliste($this->entityManager);
    }

    public function getSpielstaetteRangliste(Spielstaette $spielstaette) {
        return new SpielstaetteRangliste($this->entityManager, $spielstaette);
    }

    public function getStammlokalRangliste(Location $stammlokal) {
        return new StammlokalRangliste($this->entityManager, $stammlokal);
    }

}