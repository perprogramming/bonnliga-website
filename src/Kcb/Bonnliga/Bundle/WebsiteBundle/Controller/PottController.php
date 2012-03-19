<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/pott")
 */
class PottController extends Controller {

    /**
     * @Route("/details")
     * @Template
     */
    public function detailsAction() {
        $em = $this->getDoctrine()->getEntityManagerForClass("Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Platzierung");

        $res = $em->createQuery('SELECT COUNT(p) spieler FROM KcbBonnligaWebsiteBundle:Platzierung p')->getResult();

        $total = $res[0]['spieler']/2;
        // Hobby, Ladies, Pro
        $part  = $total * .1;

        $master = $total * .7;

        return array('pott'   => $total,
                     'master' => $master,
                     'pro'    => $part,
                     'hobby'  => $part,
                     'ladies' => $part);
    }
}