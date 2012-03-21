<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Rangliste;

use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Location;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spieler;
use Doctrine\ORM\EntityManager;

class StammlokalRangliste extends Rangliste {

    protected $stammlokal;

    public function __construct(EntityManager $entityManager, Location $stammlokal) {
        parent::__construct($entityManager);
        $this->stammlokal = $stammlokal;
    }

    protected function getEntityRepository() {
        return $this->entityManager->getRepository('KcbBonnligaWebsiteBundle:StammlokalRang');
    }

    public function getRaenge($limit) {
        return $this->getEntityRepository()->findByStammlokal($this->stammlokal, $limit);
    }

    public function getRang(Spieler $spieler) {
        return $this->getEntityRepository()->findOneBySpielerAndStammlokal($spieler, $this->stammlokal);
    }

}
