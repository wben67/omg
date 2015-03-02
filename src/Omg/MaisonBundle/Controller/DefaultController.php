<?php

namespace Omg\MaisonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('OmgMaisonBundle:Default:index.html.twig', array('name' => $name));
    }
}
