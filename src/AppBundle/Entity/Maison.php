<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Maison
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity( fields="nom", message="Une maison avec ce nom existe déjà" )
 */
class Maison
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Devise", type="string", length=255)
     */
    private $devise;

    /**
     * @var string
     *
     * @ORM\Column(name="Blason", type="string", length=255)
     */
    private $blason;


    /**
     * @ORM\OneToMany(targetEntity="Personnage", mappedBy="maison")
     **/
	private $personnages;

    public function __construct() {
		$this->personnages = new ArrayCollection();
	}



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Maison
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Maison
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set devise
     *
     * @param string $devise
     * @return Maison
     */
    public function setDevise($devise)
    {
        $this->devise = $devise;

        return $this;
    }

    /**
     * Get devise
     *
     * @return string 
     */
    public function getDevise()
    {
        return $this->devise;
    }

    /**
     * Set blason
     *
     * @param string $blason
     * @return Maison
     */
    public function setBlason($blason)
    {
        $this->blason = $blason;

        return $this;
    }

    /**
     * Get blason
     *
     * @return string 
     */
    public function getBlason()
    {
        return $this->blason;
    }

    /**
     * Add personnages
     *
     * @param \AppBundle\Entity\Personnage $personnages
     * @return Maison
     */
    public function addPersonnage(\AppBundle\Entity\Personnage $personnages)
    {
        $this->personnages[] = $personnages;

        return $this;
    }

    /**
     * Remove personnages
     *
     * @param \AppBundle\Entity\Personnage $personnages
     */
    public function removePersonnage(\AppBundle\Entity\Personnage $personnages)
    {
        $this->personnages->removeElement($personnages);
    }

    /**
     * Get personnages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersonnages()
    {
        return $this->personnages;
    }
}
