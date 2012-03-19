<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/turniere")
 */
class TurnierController extends Controller {

    /**
     * @Route("/")
     * @Template
     */
    public function indexAction() {
        $repository = $this->getDoctrine()->getRepository('KcbBonnligaWebsiteBundle:Turnier');
        return array(
            'comingUp' => $repository->getKommendeTurniere(),
            'past' => $repository->getVergangeneTurniere()
        );
    }

}
