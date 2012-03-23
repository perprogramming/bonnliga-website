<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Twig;

use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Spielstaette;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Stammlokal;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Turnier;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\Container;
use Doctrine\Common\Collections\Collection;

class Extension extends \Twig_Extension {

    protected $urlGenerator;
    protected $container;

    public function __construct(UrlGeneratorInterface $urlGenerator, Container $container) {
        $this->urlGenerator = $urlGenerator;
        $this->container = $container;
    }

    public function getFunctions() {
        return array(
            'spielstaettePath' => new \Twig_Function_Method($this, 'getSpielstaettePath'),
            'stammlokalPath' => new \Twig_Function_Method($this, 'getStammlokalPath'),
            'turnierPath' => new \Twig_Function_Method($this, 'getTurnierPath')
        );
    }

    public function getFilters() {
        return array(
            'date' => new \Twig_Filter_Method($this, 'getFormattedDate')
        );
    }

    public function getSpielstaettePath(Spielstaette $spielstaette) {
        return $this->urlGenerator->generate('kcb_bonnliga_website_location_spielstaettedetail', array('slug' => $spielstaette->getSlug()));
    }

    public function getStammlokalPath(Stammlokal $stammlokal) {
        return $this->urlGenerator->generate('kcb_bonnliga_website_location_stammlokaldetail', array('slug' => $stammlokal->getSlug()));
    }

    public function getTurnierPath(Turnier $turnier) {
        return $this->urlGenerator->generate('kcb_bonnliga_website_turnier_detail', array('id' => $turnier->getId()));
    }

    public function getFormattedDate(\DateTime $date, $format) {
        return strftime($format, $date->getTimestamp());
    }

    public function getName() {
        return 'kcb_bonnliga_twig_extension';
    }

}