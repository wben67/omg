<?php

namespace Omg\PersonnageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Personnage;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\PersonnageType;
use AppBundle\Form\PersonnageUpdType;

class PersonnageController extends Controller
{
    public function indexAction()
    {
		$personnages = $this->getDoctrine()
			->getRepository( 'AppBundle:Personnage' )
			->findAll();

        return $this->render('OmgPersonnageBundle:Personnage:index.html.twig', array('personnages' => $personnages));
    }

	public function showAction( Personnage $personnage )
	{
		return $this->render('OmgPersonnageBundle:Personnage:show.html.twig', array('personnage' => $personnage ) );
	}

	public function addAction(Request $request )
	{
		$personnage = new Personnage();

		$form = $this->createForm( new PersonnageType(), $personnage );

		if ($form->handleRequest($request)->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist( $personnage );
			$em->flush();

			$request->getSession()->getFlashBag()->add('logmessage', 'Le personnage '.$personnage->getNom().' a été créé.');

			return $this->redirect($this->generateUrl('omg_personnage_homepage' ));
		}

		return $this->render( 'OmgPersonnageBundle:Personnage:add.html.twig', array( 'form' => $form->createView(), 'action' => 'Création' ));
	}


	public function updAction( Request $request, Personnage $personnage )
	{
		$form = $this->createForm( new PersonnageUpdType(), $personnage );

		if ($form->handleRequest($request)->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist( $personnage );
			$em->flush();

			$request->getSession()->getFlashBag()->add('logmessage', 'Le personnage '.$personnage->getNom().' a été modifié.');

			return $this->redirect($this->generateUrl('omg_personnage_homepage' ));
		}

		return $this->render( 'OmgPersonnageBundle:Personnage:add.html.twig', array( 'form' => $form->createView(),  'action' => 'Modification'));
	}

	public function delAction( Request $request, Personnage $personnage )
	{
		$em = $this->getDoctrine()->getManager();
		$em->remove( $personnage );
		$em->flush();

		$request->getSession()->getFlashBag()->add('logmessage', 'Le personnage '.$personnage->getNom().' a été supprimé.');

		return $this->redirect($this->generateUrl('omg_personnage_homepage' ));
	}
}
