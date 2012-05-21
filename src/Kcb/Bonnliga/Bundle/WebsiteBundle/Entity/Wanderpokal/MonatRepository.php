<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Wanderpokal;

use Doctrine\ORM\EntityRepository;

class MonatRepository extends EntityRepository {

    public function findAll() {
        return $this->getEntityManager()->createQuery("
            SELECT m, r, b FROM KcbBonnligaWebsiteBundle:Wanderpokal\Monat m
            JOIN m.raenge r
            JOIN r.beste b
            ORDER BY m.monat ASC
        ")->getResult();
    }

}