<?php

namespace HROM\EventsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use HROM\CoreBundle\Form\AddressType;
use HROM\CoreBundle\Form\PictureType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('object', 'text')
            ->add('description', 'textarea', array('required' => false))
            ->add('date', 'date', array('years' => range(date('Y'), date('Y') + 10)))
            ->add('time', 'time', array('required' => false))
            ->add('address', new AddressType(), array('required' => false))
            ->add('picture', new PictureType(), array('required' => false))
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
