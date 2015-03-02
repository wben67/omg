<?php

namespace Omg\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;

class SearchController extends Controller
{
    public function renderSearchAction()
    {
        return $this->render('OmgSearchBundle:Search:search.html.twig');
    }

	public function searchAction( Request $request )
	{
		$personnages = null;
		$maisons = null;
		$competences = null;

		$bPers = false;
		$bComp = false;
		$bMais = false;

		if ($request->getMethod() == 'POST') 
		{
			$postData = $request->request->all();
			
			$searchinput = $postData['searchinput'];

			$mess=$searchinput;

			foreach( $postData as $field => $fieldvalue )
			{
				switch( $field )
				{
				case "cb_maison":
					$bMais = ( !strcmp( $fieldvalue , "bMais" ));
					if ( $bMais )
					$mess.=" + Mais";
					break;

				case "cb_competence":
					$bComp = ( !strcmp( $fieldvalue ,"bComp"  ));
					if ( $bComp )
					$mess.=" + Comp";
					break;

				case "cb_personnage":
					$bPers = ( !strcmp($fieldvalue ,"bPers" ) );
					if ( $bPers )
					$mess.=" + Pers";
					break;
				}

			}

			if ( $bPers )
			{
				$em = $this->getDoctrine()->getManager();

				$query = $em->createQuery( "SELECT p FROM AppBundle\Entity\Personnage p WHERE p.nom LIKE :searchinput or p.description like :searchinput " ); 
				$query->setParameter( 'searchinput' , '%'.$searchinput.'%' );

				$personnages = $query->getResult();


			}
	
			if ( $bComp )
			{
				$em = $this->getDoctrine()->getManager();

				$query = $em->createQuery( "SELECT c FROM AppBundle\Entity\Competences c WHERE c.nom LIKE :searchinput or c.description like :searchinput " ); 
				$query->setParameter( 'searchinput' , '%'.$searchinput.'%' );

				$competences = $query->getResult();
			}
	
			if ( $bMais )
			{
				$em = $this->getDoctrine()->getManager();

				$query = $em->createQuery( "SELECT m FROM AppBundle\Entity\Maison m WHERE m.nom LIKE :searchinput or m.description like :searchinput " ); 
				$query->setParameter( 'searchinput' , '%'.$searchinput.'%' );

				$maisons = $query->getResult();
			}
		}
	
		return $this->render('OmgSearchBundle:Search:results.html.twig', 
							  array( 'maisons' => $maisons, 
							         'personnages' => $personnages, 
									 'competences' => $competences ) );
	}
}
