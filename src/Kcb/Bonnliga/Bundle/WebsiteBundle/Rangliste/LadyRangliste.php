<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Rangliste;

class LadyRangliste extends Rangliste {

    protected function getEntityRepository() {
        return $this->entityManager->getRepository('KcbBonnligaWebsiteBundle:LadyRang');
    }

}
