<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TurnierRepository extends EntityRepository {

    public function getKommendeTurniere() {
        return $this->getEntityManager()->createQuery("
            SELECT t, s FROM KcbBonnligaWebsiteBundle:Turnier t
            JOIN t.spielstaette s
            WHERE t.beginn > :jetzt
            ORDER BY t.beginn ASC
        ")->setParameter('jetzt', new \DateTime("now"))->getResult();
    }

    public function getAktuelleTurniere() {
        return $this->getEntityManager()->createQuery("
            SELECT t, s FROM KcbBonnligaWebsiteBundle:Turnier t
            JOIN t.spielstaette s
            WHERE t.beginn > :jetzt
            ORDER BY t.beginn ASC
        ")
        ->setMaxResults(10)
        ->setParameter('jetzt', new \DateTime('now'))
        ->getResult();
    }

    public function getVergangeneTurniere() {
        return $this->getEntityManager()->createQuery("
            SELECT t, s FROM KcbBonnligaWebsiteBundle:Turnier t
            JOIN t.spielstaette s
            WHERE t.beginn <= :jetzt
            ORDER BY t.beginn DESC
        ")->setParameter('jetzt', new \DateTime('now'))->getResult();
    }

}