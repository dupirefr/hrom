<?php

namespace HROM\PartnerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use HROM\CoreBundle\Form\PictureType;

/**
 * Partners form builder
 * 
 * @author François Dupire
 */
class PartnerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'Nom',
                'attr' => array(
                    'size' => 20
                )
            ))
            ->add('link', 'text', array(
                'label' => 'Lien',
                'attr' => array(
                    'size' => 50
                )
            ))
            ->add('description', 'textarea', array(
                'label' => 'Description',
                'attr' => array(
                    'cols' => 50,
                    'rows' => 10
                )
            ))
            ->add('picture', new PictureType(), array(
                'required' => false
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HROM\PartnerBundle\Entity\Partner'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hrom_partnerbundle_partner';
    }
}
