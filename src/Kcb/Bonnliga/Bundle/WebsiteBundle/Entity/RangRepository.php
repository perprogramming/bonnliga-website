<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

class RangRepository extends EntityRepository {

    public function findRaenge() {
        $className = $this->getClassName();

        $query = $this->getEntityManager()->createQuery("
            SELECT r, s, l FROM $className r
            JOIN r.spieler s
            LEFT JOIN s.stammlokal l
            ORDER BY r.rang ASC, s.vorname ASC, s.nachname ASC
        ");

        return $query->getResult();
    }

    public function findRaengeForRangliste($limit) {
        $className = $this->getClassName();

        $query = $this->getEntityManager()->createQuery("
            SELECT r, s, l FROM $className r
            JOIN r.spieler s
            LEFT JOIN s.stammlokal l
            WHERE r.rang IS NOT NULL
            ORDER BY r.rang ASC, s.vorname ASC, s.nachname ASC
        ");

        if ($limit)
            $query->setMaxResults($limit);

        return $query->getResult();
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