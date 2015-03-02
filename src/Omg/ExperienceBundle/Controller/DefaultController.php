<?php

namespace Omg\ExperienceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('OmgExperienceBundle:Default:index.html.twig', array('name' => $name));
    }
}
