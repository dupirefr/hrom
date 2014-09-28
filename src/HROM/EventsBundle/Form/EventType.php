<?php

namespace HROM\EventsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use HROM\CoreBundle\Form\AddressType;
use HROM\CoreBundle\Form\PictureType;

/**
 * Events form builder
 * 
 * @author François Dupire
 */
class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('object', 'text', array(
                'label' => 'Objet',
                'attr' => array(
                    'size' => 50
                )
            ))
            ->add('description', 'textarea', array(
                'label' => 'Description',
                'required' => false,
                'attr' => array(
                    'cols' => 50,
                    'rows' => 10
                )
            ))
            ->add('date', 'date', array(
                'years' => range(date('Y'), date('Y') + 10),
                'label' => 'Date'
            ))
            ->add('time', 'time', array(
                'label' => 'Heure',
                'required' => false
            ))
            ->add('address', new AddressType(), array(
                'label' => 'Adresse',
                'required' => false,
                'attr' => array(
                    'help' => 'Donnez le plus d\'information possible'
                )
            ))
            ->add('picture', new PictureType(), array(
                'label' => 'Image',
                'required' => false
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HROM\EventsBundle\Entity\Event'
        ));
    }

    public function getName()
    {
        return 'hrom_eventsbundle_eventtype';
    }
}
