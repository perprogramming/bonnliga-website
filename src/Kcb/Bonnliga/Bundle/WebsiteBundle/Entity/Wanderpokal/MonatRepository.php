<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Wanderpokal;

use Doctrine\ORM\EntityRepository;

class MonatRepository extends EntityRepository {

    public function findAll() {
        return $this->getEntityManager()->createQuery("
            SELECT m, r, b FROM KcbBonnligaWebsiteBundle:Wanderpokal\Monat m
            JOIN m.raenge r
            JOIN r.beste b
            ORDER BY m.monat DESC
        ")->getResult();
    }

    public function findCurrent() {
        return $this->getEntityManager()->createQuery("
            SELECT m, r, b FROM KcbBonnligaWebsiteBundle:Wanderpokal\Monat m
            JOIN m.raenge r
            JOIN r.beste b
            WHERE
              m.monat < :aktuellerMonat
            ORDER BY m.monat DESC
        ")->setMaxResults(1)->setParameter('aktuellerMonat', date('Y-m-01'))->getSingleResult();
    }

}