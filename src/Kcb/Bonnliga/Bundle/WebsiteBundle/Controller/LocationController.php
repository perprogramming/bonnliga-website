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
            'stammlokale' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Stammlokal')->findBy(array(), array('name' => 'asc'))
        );
    }

    /**
     * @Route("/spielstaette/{slug}")
     * @Template
     */
    public function spielstaetteDetailAction($slug) {
        $spielstaette = $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Spielstaette')->findOneBy(array('slug' => $slug));
        return array(
            'spielstaette' => $spielstaette,
            'spielstaetteRangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getSpielstaetteRangliste($spielstaette),
            'stammlokalRangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getStammlokalRangliste($spielstaette)
        );
    }

    /**
     * @Route("/stammlokal/{slug}")
     * @Template
     */
    public function stammlokalDetailAction($slug) {
        return array(
            'stammlokal' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Stammlokal')->findOneBy(array('slug' => $slug))
        );
    }

}
