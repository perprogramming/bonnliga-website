<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/facts")
 */
class FactController extends Controller {

    /**
     * @Route("/")
     * @Template
     */
    public function indexAction() {
        return array(
            'spielstaetten' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Spielstaette')->findBy(array(), array('name' => 'asc'))
        );
    }

    /**
     * @Route("/regeln")
     * @Template
     */
    public function regelnAction() {
        return array();
    }

    /**
     * @Route("/faq")
     * @Template
     */
    public function faqAction() {
        return array();
    }

}