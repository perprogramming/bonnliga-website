<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

class RangRepository extends EntityRepository {

    public function findOneBySpieler(Spieler $spieler) {
        $className = $this->getClassName();

        $query = $this->_em->createQuery("
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