<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/locations")
 */
class LocationController extends Controller {

    /**
     * @Route("/")
     * @Template
     */
    public function indexAction() {
        return array(
            'locations' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Location')->findAll()
        );
    }

}
