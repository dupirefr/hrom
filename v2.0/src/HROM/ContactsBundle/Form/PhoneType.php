<?php

namespace HROM\ContactsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Phones form builder
 * 
 * @author François Dupire
 */
class PhoneType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', 'text')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HROM\ContactsBundle\Entity\Phone'
        ));
    }

    public function getName()
    {
        return 'hrom_contactsbundle_phonetype';
    }
}
