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
    public function indexAction() {
        $daten = $this->getDoctrine()->getRepository("KcbBonnligaWebsiteBundle:GesamtRang")->findBy(array(), array('rang' => 'asc'));


        return array('daten' => $daten);
    }

}
