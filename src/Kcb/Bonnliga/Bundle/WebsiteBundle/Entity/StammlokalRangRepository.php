<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

class StammlokalRangRepository extends RangRepository {

    public function findByStammlokal(Location $stammlokal, $limit) {
        $className = $this->getClassName();

        $query = $this->getEntityManager()->createQuery("
            SELECT r, s, l FROM $className r
            JOIN r.spieler s
            JOIN s.stammlokal l
            JOIN r.stammlokal rl
            WHERE rl.id = :id
            ORDER BY r.rang ASC
        ")->setParameter('id', $stammlokal->getId());
        if ($limit)
            $limit->setMaxResults($limit);
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