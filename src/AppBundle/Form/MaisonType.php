<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MaisonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text')
            ->add('description', 'textarea')
            ->add('devise', 'text')
            ->add('blason', 'textarea', array( 'label' => 'Blason' ))
            /*->add('blasonImg')*/
			->add('Créer', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Maison'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_maison';
    }
}
