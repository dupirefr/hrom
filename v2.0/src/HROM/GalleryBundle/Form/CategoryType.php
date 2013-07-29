<?php

namespace HROM\GalleryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('date', 'date', array(
                'required' => false,
                'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'),
                'years' => range(2000, date('Y')),
                'invalid_message' => 'La date n\'est pas valide'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HROM\GalleryBundle\Entity\Category'
        ));
    }

    public function getName()
    {
        return 'hrom_gallerybundle_categorytype';
    }
}
