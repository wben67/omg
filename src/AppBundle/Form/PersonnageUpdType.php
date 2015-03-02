<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use AppBundle\Form\PersonnageType;

class PersonnageUpdType extends PersonnageType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->remove('Créer')
			->add('Modifier', 'submit')
			->add('nom', 'text', array( 'read_only' => true ) )
        ;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_personnage_upd';
    }

	public function getParent()
	{
		return new PersonnageType();
	}
}
