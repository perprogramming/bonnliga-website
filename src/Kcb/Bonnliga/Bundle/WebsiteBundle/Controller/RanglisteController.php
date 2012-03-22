<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/rangliste")
 */
class RanglisteController extends Controller {

    /**
     * @Route("/")
     * @Template
     */
    public function gesamtAction() {
        return array(
            'rangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getGesamtRangliste(),
            'spielstaetten' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Spielstaette')->findBy(array(), array('name' => 'asc'))
        );
    }

    /**
     * @Route("/ladies/")
     * @Template
     */
    public function ladiesAction() {
        return array(
            'rangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getLadyRangliste(),
            'spielstaetten' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Spielstaette')->findBy(array(), array('name' => 'asc'))
        );
    }

    /**
     * @Route("/hobby/")
     * @Template
     */
    public function hobbyAction() {
        return array(
            'rangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getHobbyRangliste(),
            'spielstaetten' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Spielstaette')->findBy(array(), array('name' => 'asc'))
        );
    }

    /**
     * @Route("/pro/")
     * @Template
     */
    public function proAction() {
        return array(
            'rangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getProRangliste(),
            'spielstaetten' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Spielstaette')->findBy(array(), array('name' => 'asc'))
        );
    }

    /**
     * @Route("/spielstaette/{slug}/")
     * @Template
     */
    public function spielstaetteAction($slug) {
        $spielstaette = $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Spielstaette')->findOneBy(array('slug' => $slug));
        return array(
            'rangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getSpielstaetteRangliste($spielstaette),
            'spielstaette' => $spielstaette,
            'spielstaetten' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Spielstaette')->findBy(array(), array('name' => 'asc'))
        );
    }

}
