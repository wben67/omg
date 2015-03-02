<?php

namespace Omg\MaisonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Maison;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\MaisonType;
use AppBundle\Form\MaisonUpdType;

class MaisonController extends Controller
{
    public function indexAction()
    {
		$maisons = $this->getDoctrine()
			->getRepository( 'AppBundle:Maison' )
			->findAll();

        return $this->render('OmgMaisonBundle:Maison:index.html.twig', array('maisons' => $maisons));
    }

	public function showAction( Maison $maison )
	{
		return $this->render('OmgMaisonBundle:Maison:show.html.twig', array('maison' => $maison ) );
	}

	public function addAction(Request $request )
	{
		$maison = new Maison();

		$form = $this->createForm( new MaisonType(), $maison );

		if ($form->handleRequest($request)->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist( $maison );
			$em->flush();

			$request->getSession()->getFlashBag()->add('logmessage', 'La maison '.$maison->getNom().' a été créée.');

			return $this->redirect($this->generateUrl('omg_maison_homepage' ));
		}

		return $this->render( 'OmgMaisonBundle:Maison:add.html.twig', array( 'form' => $form->createView(), 'action' => 'Création' ));
	}


	public function updAction( Request $request, Maison $maison )
	{
		$form = $this->createForm( new MaisonUpdType(), $maison );

		if ($form->handleRequest($request)->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist( $maison );
			$em->flush();

			$request->getSession()->getFlashBag()->add('logmessage', 'La maison '.$maison->getNom().' a été modifiée.');

			return $this->redirect($this->generateUrl('omg_maison_homepage' ));
		}

		return $this->render( 'OmgMaisonBundle:Maison:add.html.twig', array( 'form' => $form->createView(), 'action' => 'Création' ));
	}

	public function delAction( Request $request, Maison $maison )
	{
		$em = $this->getDoctrine()->getManager();
		$em->remove( $maison );
		$em->flush();

		$request->getSession()->getFlashBag()->add('logmessage', 'La maison '.$maison->getNom().' a été supprimée.');

		return $this->redirect($this->generateUrl('omg_maison_homepage' ));
	}
}
