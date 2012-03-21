<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Rangliste;

use Doctrine\ORM\EntityManager;

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

}