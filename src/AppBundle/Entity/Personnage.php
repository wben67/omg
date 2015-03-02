<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Personnage
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Personnage
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
     * @ORM\ManyToOne(targetEntity="Maison", inversedBy="personnages")
     * @ORM\JoinColumn(name="maison_id", referencedColumnName="id")
     **/

    private $maison;

    /**
     * @ORM\ManyToOne(targetEntity="Experience")
     * @ORM\JoinColumn(name="experience_id", referencedColumnName="id")
     **/

    private $experience;

    /**
     * @ORM\ManyToMany(targetEntity="Competences", inversedBy="Personnage")
     * @ORM\JoinTable(name="Personnages_Competences")
     **/

    private $competences;

    public function __construct() {
        $this->competences = new ArrayCollection();
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
     * @return Personnage
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
     * @return Personnage
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
     * Set maison
     *
     * @param string $maison
     * @return Personnage
     */
    public function setMaison($maison)
    {
        $this->maison = $maison;

        return $this;
    }

    /**
     * Get maison
     *
     * @return string 
     */
    public function getMaison()
    {
        return $this->maison;
    }

    /**
     * Set experience
     *
     * @param string $experience
     * @return Personnage
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return string 
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set competences
     *
     * @param string $competences
     * @return Personnage
     */
    public function setCompetences($competences)
    {
        $this->competences = $competences;

        return $this;
    }

    /**
     * Get competences
     *
     * @return string 
     */
    public function getCompetences()
    {
        return $this->competences;
    }

    /**
     * Add competences
     *
     * @param \AppBundle\Entity\Competences $competences
     * @return Personnage
     */
    public function addCompetence(\AppBundle\Entity\Competences $competences)
    {
        $this->competences[] = $competences;

        return $this;
    }

    /**
     * Remove competences
     *
     * @param \AppBundle\Entity\Competences $competences
     */
    public function removeCompetence(\AppBundle\Entity\Competences $competences)
    {
        $this->competences->removeElement($competences);
    }

    private $bErr = false;

    /**
     * @Assert\Callback()
     **/
    public function isCompetencesValid(ExecutionContextInterface $context)
    {
        if ( $this->competences->count()  > $this->experience->getExperience() / 30 )
        {
            if ( ! $this->bErr )
            {
                $context ->buildViolation( "Le personnage ne peut avoir que %competencesmax% competences au lieu %nbcompetences% actuellement" )
                     ->setParameters( array ( '%competencesmax%' => $this->experience->getExperience() / 30,
                                              '%nbcompetences%' => $this->competences->count())) // message
                     ->atPath('competences') // attribut de l'objet qui est violé
                     ->addViolation();
                $this->bErr=true;
            }
        }
    }

}
