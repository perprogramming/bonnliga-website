<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

class StammlokalRangRepository extends RangRepository {

    public function findByStammlokal(Location $stammlokal) {
        $className = $this->getClassName();

        $query = $this->getEntityManager()->createQuery("
            SELECT r, s, l FROM $className r
            JOIN r.spieler s
            LEFT JOIN s.stammlokal l
            JOIN r.stammlokal rl
            WHERE rl.id = :id
            ORDER BY r.rang ASC, s.vorname ASC, s.nachname ASC
        ")->setParameter('id', $stammlokal->getId());
        return $query->getResult();
    }

    public function findByStammlokalForRangliste(Location $stammlokal, $limit) {
        $className = $this->getClassName();

        $query = $this->getEntityManager()->createQuery("
            SELECT r, s, l FROM $className r
            JOIN r.spieler s
            LEFT JOIN s.stammlokal l
            JOIN r.stammlokal rl
            WHERE rl.id = :id AND r.rang IS NOT NULL
            ORDER BY r.rang ASC, s.vorname ASC, s.nachname ASC
        ")->setParameter('id', $stammlokal->getId());
        if ($limit)
            $query->setMaxResults($limit);
        return $query->getResult();
    }

    public function findOneBySpielerAndStammlokal(Spieler $spieler, Location $stammlokal) {
        $className = $this->getClassName();

        $query = $this->getEntityManager()->createQuery("
            SELECT r FROM $className r
            JOIN r.spieler s
            JOIN r.stammlokal rl
            WHERE s.id = :id AND rl.id = :stammlokalId
        ")->setParameter('id', $spieler->getId())->setParameter('stammlokalId', $stammlokal->getId());

        if ($result = $query->getResult()) {
            return reset($result);
        } else {
            $rang = new $className($spieler, $stammlokal);
            $this->getEntityManager()->persist($rang);
            $this->getEntityManager()->flush($rang);
            return $rang;
        }
    }

}