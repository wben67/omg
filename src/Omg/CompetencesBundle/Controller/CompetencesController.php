<?php

namespace Omg\CompetencesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Competences;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CompetencesType;
use AppBundle\Form\CompetencesUpdType;

class CompetencesController extends Controller
{
    public function indexAction()
    {
		$competences = $this->getDoctrine()
			->getRepository( 'AppBundle:Competences' )
			->findAll();

        return $this->render('OmgCompetencesBundle:Competences:index.html.twig', array('competences' => $competences));
    }

	public function showAction( Competences $competence )
	{
		return $this->render('OmgCompetencesBundle:Competences:show.html.twig', array('competence' => $competence ) );
	}

	public function addAction(Request $request )
	{
		$competence = new Competences();

		$form = $this->createForm( new CompetencesType(), $competence );

		if ($form->handleRequest($request)->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist( $competence );
			$em->flush();

			$request->getSession()->getFlashBag()->add('logmessage', 'La compétence '.$competence->getNom().' a été créée.');

			return $this->redirect($this->generateUrl('omg_competences_homepage' ));
		}

		return $this->render( 'OmgCompetencesBundle:Competences:add.html.twig', array( 'form' => $form->createView(), 'action' => 'Création' ));
	}


	public function updAction( Request $request, Competences $competence )
	{
		$form = $this->createForm( new CompetencesUpdType(), $competence );

		if ($form->handleRequest($request)->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist( $competence );
			$em->flush();

			$request->getSession()->getFlashBag()->add('logmessage', 'La compétence '.$competence->getNom().' a été modifiée.');

			return $this->redirect($this->generateUrl('omg_competences_homepage' ));
		}

		return $this->render( 'OmgCompetencesBundle:Competences:add.html.twig', array( 'form' => $form->createView(), 'action' => 'Modification' ));
	}

	public function delAction( Request $request, Competences $competence )
	{
		$em = $this->getDoctrine()->getManager();
		$em->remove( $competence );
		$em->flush();

		$request->getSession()->getFlashBag()->add('logmessage', 'La compétence '.$competence->getNom().' a été supprimée.');

		return $this->redirect($this->generateUrl('omg_competences_homepage' ));
	}
}
