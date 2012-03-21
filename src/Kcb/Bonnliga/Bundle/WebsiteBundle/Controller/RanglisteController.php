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
            'rangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getGesamtRangliste()
        );
    }

    /**
     * @Route("/ladies/")
     * @Template
     */
    public function ladiesAction() {
        return array(
            'rangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getLadyRangliste()
        );
    }

    /**
     * @Route("/hobby/")
     * @Template
     */
    public function hobbyAction() {
        return array(
            'rangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getHobbyRangliste()
        );
    }

    /**
     * @Route("/pro/")
     * @Template
     */
    public function proAction() {
        return array(
            'rangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getProRangliste()
        );
    }

}
