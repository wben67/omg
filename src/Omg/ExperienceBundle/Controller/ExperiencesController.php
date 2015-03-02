<?php

namespace Omg\ExperienceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExperiencesController extends Controller
{
   public function indexAction()
    {
		$experiences = $this->getDoctrine()
			->getRepository('AppBundle:Experience')
			->findAll();

        return $this->render('OmgExperienceBundle:Experiences:index.html.twig', array('experiences' => $experiences));
    }
}
