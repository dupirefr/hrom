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
            ->add('street', 'text')
            ->add('number', 'text')
            ->add('postalCode', 'text')
            ->add('city', 'text')
            ->add('box', 'text', array(
                'required' => false
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
