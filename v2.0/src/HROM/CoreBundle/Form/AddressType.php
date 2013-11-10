<?php

namespace HROM\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('street', 'text', array(
                'label' => 'Rue',
                'attr' => array(
                    'size' => 50
                )
            ))
            ->add('number', 'text', array(
                'label' => 'Numéro',
                'attr' => array(
                    'size' => 2
                )
            ))
            ->add('postalCode', 'text', array(
                'label' => 'Code postal',
                'attr' => array(
                    'size' => 6
                )
            ))
            ->add('city', 'text', array(
                'label' => 'Ville',
                'attr' => array(
                    'size' => 3
                )
            ))
            ->add('box', 'text', array(
                'required' => false,
                'label' => 'Boîte',
                'attr' => array(
                    'size' => 10
                )
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HROM\CoreBundle\Entity\Address'
        ));
    }

    public function getName()
    {
        return 'hrom_corebundle_addresstype';
    }
}
