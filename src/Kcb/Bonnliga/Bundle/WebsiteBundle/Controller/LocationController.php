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
     * @Route("/spielstaette/{id}")
     * @Template
     */
    public function spielstaetteDetailAction($id) {
        return array('spielstaette' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Spielstaette')->find($id));
    }

    /**
     * @Route("/stammlokal/{id}")
     * @Template
     */
    public function stammlokalDetailAction() {
        return array();
    }

}
