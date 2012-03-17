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
            'spielstaetten' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Spielstaette')->findAll(),
            'stammlokale' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Stammlokal')->findAll()
        );
    }

    /**
     * @Route("/spielstaette")
     * @Template
     */
    public function spielstaetteDetailAction() {
        return array();
    }

    /**
     * @Route("/stammlokal")
     * @Template
     */
    public function stammlokalDetailAction() {
        return array();
    }

}
