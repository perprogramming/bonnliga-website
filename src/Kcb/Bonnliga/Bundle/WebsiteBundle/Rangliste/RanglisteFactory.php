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

}