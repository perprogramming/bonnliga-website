<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Facts'    , array('route' => 'kcb_bonnliga_website_fact_index',
                                           'label' => '<i class="icon-question-sign icon-large"></i> Facts'));
        $menu->addChild('Turniere' , array('route' => 'kcb_bonnliga_website_turnier_index',
                                           'label' => '<i class="icon-calendar icon-large"></i> Turniere'));
        $menu->addChild('Rangliste', array('route' => 'kcb_bonnliga_website_rangliste_gesamt',
                                           'label' => '<i class="icon-trophy icon-large"></i> Rangliste'));
        $menu->addChild('Locations', array('route' => 'kcb_bonnliga_website_location_index',
                                           'label' => '<i class="icon-map-marker icon-large"></i> Locations'));
        $menu->addChild('Sponsoren', array('route' => 'kcb_bonnliga_website_sponsor_index',
                                           'label' => '<i class="icon-gift icon-large"></i> Sponsoren'));

        return $menu;
    }
}