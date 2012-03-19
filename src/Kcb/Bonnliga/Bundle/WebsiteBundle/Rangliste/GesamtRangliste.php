<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Rangliste;

class GesamtRangliste extends Rangliste {

    protected function getEntityRepository() {
        return $this->entityManager->getRepository('KcbBonnligaWebsiteBundle:GesamtRang');
    }

}
