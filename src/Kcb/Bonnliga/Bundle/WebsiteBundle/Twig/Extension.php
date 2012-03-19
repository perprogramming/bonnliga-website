<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Twig;

use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spielstaette;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Stammlokal;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Turnier;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Extension extends \Twig_Extension {

    protected $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator) {
        $this->urlGenerator = $urlGenerator;
    }

    public function getFunctions() {
        return array(
            'spielstaettePath' => new \Twig_Function_Method($this, 'getSpielstaettePath'),
            'stammlokalPath' => new \Twig_Function_Method($this, 'getStammlokalPath'),
            'turnierVorbei'   => new \Twig_Function_Method($this, 'getTurnierVorbei'),
            'turnierNichtBald'   => new \Twig_Function_Method($this, 'getTurnierNichtBald')
        );
    }

    public function getSpielstaettePath(Spielstaette $spielstaette) {
        return $this->urlGenerator->generate('kcb_bonnliga_website_location_spielstaettedetail', array('slug' => $spielstaette->getSlug()));
    }

    public function getStammlokalPath(Stammlokal $stammlokal) {
        return $this->urlGenerator->generate('kcb_bonnliga_website_location_stammlokaldetail', array('slug' => $stammlokal->getSlug()));
    }

    public function getName() {
        return 'kcb_bonnliga_twig_extension';
    }

}