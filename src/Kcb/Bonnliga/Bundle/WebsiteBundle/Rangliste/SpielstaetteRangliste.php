<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Rangliste;

use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spielstaette;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spieler;
use Doctrine\ORM\EntityManager;

class SpielstaetteRangliste extends Rangliste {

    protected $spielstaette;

    public function __construct(EntityManager $entityManager, Spielstaette $spielstaette) {
        parent::__construct($entityManager);
        $this->spielstaette = $spielstaette;
    }

    protected function getEntityRepository() {
        return $this->entityManager->getRepository('KcbBonnligaWebsiteBundle:SpielstaetteRang');
    }

    public function getRaenge($limit) {
        return $this->getEntityRepository()->findBySpielstaette($this->spielstaette, $limit);
    }

    public function getRang(Spieler $spieler) {
        return $this->getEntityRepository()->findOneBySpielerAndSpielstaette($spieler, $this->spielstaette);
    }

}
