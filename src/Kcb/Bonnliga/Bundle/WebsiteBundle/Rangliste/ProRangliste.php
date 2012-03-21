<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Rangliste;

class ProRangliste extends Rangliste {

    protected function getEntityRepository() {
        return $this->entityManager->getRepository('KcbBonnligaWebsiteBundle:ProRang');
    }

}
