<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController extends Controller {

    /**
     * @Route("/")
     * @Template
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManagerForClass("Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Turnier");

        $comingUp = $em->createQuery('SELECT t FROM KcbBonnligaWebsiteBundle:Turnier t WHERE t.beginn > :lowerLimit AND t.beginn < :upperLimit ORDER BY t.beginn ASC')
                       ->setParameter('lowerLimit', new \DateTime("now"))
                       ->setParameter('upperLimit', new \DateTime("+7days"));

        return array(
            'comingUp' => $comingUp->getResult()
        );
    }

}