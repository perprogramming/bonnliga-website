<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

class RangRepository extends EntityRepository {

    public function findAll() {
        $className = $this->getClassName();

        return $this->getEntityManager()->createQuery("
            SELECT r, s, l FROM $className r
            JOIN r.spieler s
            JOIN s.stammlokal l
            ORDER BY r.rang ASC
        ")->getResult();
    }

    public function findOneBySpieler(Spieler $spieler) {
        $className = $this->getClassName();

        $query = $this->getEntityManager()->createQuery("
            SELECT r FROM $className r
            JOIN r.spieler s
            WHERE s.id = :id
        ")->setParameter('id', $spieler->getId());

        if ($result = $query->getResult()) {
            return reset($result);
        } else {
            $rang = new $className($spieler);
            $this->getEntityManager()->persist($rang);
            $this->getEntityManager()->flush($rang);
            return $rang;
        }
    }

}