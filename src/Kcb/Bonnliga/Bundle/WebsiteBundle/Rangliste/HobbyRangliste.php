<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Rangliste;

class HobbyRangliste extends Rangliste {

    protected function getEntityRepository() {
        return $this->entityManager->getRepository('KcbBonnligaWebsiteBundle:HobbyRang');
    }

}
