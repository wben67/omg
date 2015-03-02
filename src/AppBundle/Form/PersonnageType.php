<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonnageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text')
            ->add('description', 'textarea')
            ->add('experience','entity', array( 
					'class' => 'AppBundle:Experience',
					'property' => 'age') )
            ->add('maison', 'entity', array( 
					'class' => 'AppBundle:Maison',
					'property' => 'nom' ) )
            ->add('competences', 'entity', array(
					'class' => 'AppBundle:Competences',
					'property' => 'nom',
					'multiple' => true,
					'expanded' => true ) )
			->add('Créer', 'submit' )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Personnage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_personnage';
    }
}
