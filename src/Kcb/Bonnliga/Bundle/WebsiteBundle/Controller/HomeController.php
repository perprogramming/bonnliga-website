<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController extends Controller {

    /**
     * @Route("/")
     * @Template
     */
    public function indexAction() {
        return array(
            'comingUp' => $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Turnier')->getAktuelleTurniere(),
            'gesamtRangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getGesamtRangliste(),
            'ladyRangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getLadyRangliste(),
            'hobbyRangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getHobbyRangliste(),
            'proRangliste' => $this->get('kcb.bonnliga.rangliste_factory')->getProRangliste()
        );
    }

}