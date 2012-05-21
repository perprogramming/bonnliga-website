<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/wanderpokal")
 */
class WanderpokalController extends Controller {

    /**
     * @Route("/")
     * @Template
     */
    public function indexAction() {
        return array(
            'monate' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Wanderpokal\Monat')->findAll()
        );
    }

}
