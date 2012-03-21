<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

class SpielstaetteRangRepository extends RangRepository {

    public function findBySpielstaette(Spielstaette $spielstaette, $limit) {
        $className = $this->getClassName();

        $query = $this->getEntityManager()->createQuery("
            SELECT r, s, l FROM $className r
            JOIN r.spieler s
            JOIN s.stammlokal l
            JOIN r.spielstaette rs
            WHERE rs.id = :id
            ORDER BY r.rang ASC
        ")->setParameter('id', $spielstaette->getId());

        if ($limit)
            $query->setMaxResults($limit);

        return $query->getResult();
    }

    public function findOneBySpielerAndSpielstaette(Spieler $spieler, Spielstaette $spielstaette) {
        $className = $this->getClassName();

        $query = $this->getEntityManager()->createQuery("
            SELECT r FROM $className r
            JOIN r.spieler s
            JOIN r.spielstaette rs
            WHERE s.id = :id AND rs.id = :spielstaetteId
        ")->setParameter('id', $spieler->getId())->setParameter('spielstaetteId', $spielstaette->getId());

        if ($result = $query->getResult()) {
            return reset($result);
        } else {
            $rang = new $className($spieler, $spielstaette);
            $this->getEntityManager()->persist($rang);
            $this->getEntityManager()->flush($rang);
            return $rang;
        }
    }

}