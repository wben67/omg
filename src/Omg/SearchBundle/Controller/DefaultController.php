<?php

namespace Omg\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('OmgSearchBundle:Default:index.html.twig', array('name' => $name));
    }
}
