<?php

namespace HROM\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use HROM\GalleryBundle\Form\PictureType;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',		'text')
            ->add('content',	'textarea')
			->add('picture',	new PictureType(),	array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HROM\NewsBundle\Entity\News'
        ));
    }

    public function getName()
    {
        return 'hrom_newsbundle_newstype';
    }
}
