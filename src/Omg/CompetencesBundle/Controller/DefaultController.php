<?php

namespace Omg\CompetencesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('OmgCompetencesBundle:Default:index.html.twig', array('name' => $name));
    }
}
