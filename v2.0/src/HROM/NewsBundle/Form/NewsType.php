<?php

namespace HROM\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use HROM\CoreBundle\Form\PictureType;

/**
 * News form builder
 * 
 * @author François Dupire
 */
class NewsType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', 'text', array(
                    'label' => 'Titre',
                    'attr' => array(
                        'size' => 50
                    )
                ))
                ->add('content', 'textarea', array(
                    'label' => 'Contenu',
                    'attr' => array(
                        'cols' => 50,
                        'rows' => 10
                    )
                ))
                ->add('picture', new PictureType(), array(
                    'label' => 'Image',
                    'required' => false
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'HROM\NewsBundle\Entity\News'
        ));
    }

    public function getName() {
        return 'hrom_newsbundle_newstype';
    }
}
