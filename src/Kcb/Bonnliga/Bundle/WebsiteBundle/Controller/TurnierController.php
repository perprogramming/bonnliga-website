<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/turniere")
 */
class TurnierController extends Controller {

    /**
     * @Route("/")
     * @Template
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManagerForClass("Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Turnier");

        $comingUp = $em->createQuery('SELECT t FROM KcbBonnligaWebsiteBundle:Turnier t WHERE t.beginn > :lowerLimit ORDER BY t.beginn ASC')
                        ->setParameter('lowerLimit', new \DateTime("now"));
        $past     = $em->createQuery('SELECT t FROM KcbBonnligaWebsiteBundle:Turnier t WHERE t.beginn <= :lowerLimit ORDER BY t.beginn DESC')
                        ->setParameter('lowerLimit', new \DateTime("now"));

        return array('comingUp' => $comingUp->getResult(),
                     'past'     => $past->getResult());
    }

}
