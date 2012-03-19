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
            'spielstaetten' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Spielstaette')->findBy(array(), array('name' => 'asc')),
            'stammlokale' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Stammlokal')->findAll()
        );
    }

    /**
     * @Route("/spielstaette/{id}")
     * @Template
     */
    public function spielstaetteDetailAction($id) {
        $spielstaette = $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Spielstaette')->find($id);

        $turniere = $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Turnier')->findBy(array('spielstaette' => $spielstaette->getId()), array('beginn' => 'asc'), 3);

        return array('spielstaette' => $spielstaette,
                     'turniere'     => $turniere);
    }

    /**
     * @Route("/stammlokal/{id}")
     * @Template
     */
    public function stammlokalDetailAction() {
        return array();
    }

}
