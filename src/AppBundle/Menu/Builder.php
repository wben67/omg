<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Accueil', array('route' => 'app'));
        $menu->addChild('Personnages', array( 'route' => 'omg_personnage_homepage' ) );
        $menu->addChild('Maisons', array( 'route' => 'omg_maison_homepage' ) );
        $menu->addChild('Compétences', array( 'route' => 'omg_competences_homepage' ) );
        $menu->addChild('Expériences', array( 'route' => 'omg_experience_homepage' ) );
		return $menu;
	}
}

