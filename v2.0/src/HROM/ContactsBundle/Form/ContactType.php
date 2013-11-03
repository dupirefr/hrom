<?php

namespace HROM\ContactsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use HROM\ContactsBundle\Form\PhoneType;
use HROM\ContactsBundle\Form\EmailType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname', 'text')
            ->add('givenName', 'text')
            ->add('phoneNumbers', 'collection', array(
                'type' => new PhoneType(),
                'allow_add'    => true,
                'allow_delete' => true
            ))
            ->add('emailAddresses', 'collection', array(
                'type' => new EmailType(),
                'allow_add'    => true,
                'allow_delete' => true  
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HROM\ContactsBundle\Entity\Contact'
        ));
    }

    public function getName()
    {
        return 'hrom_contactsbundle_contacttype';
    }
}
