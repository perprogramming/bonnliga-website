<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Extension;

class TwigDateShiftExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'date_shift'   => new \Twig_Function_Method($this, 'date_shift')
        );
    }

    public function date_shift($shift) {
        return new \DateTime("@" . strtotime($shift));
    }

    public function getName()
    {
        return 'twig_date_shift_extension';
    }

}