<?php

namespace HROM\GalleryBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;

class CategorizedPictureType extends PictureType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
	$builder->add('category');
    }

    public function getName()
    {
        return 'hrom_gallerybundle_categorizedpicturetype';
    }
}
