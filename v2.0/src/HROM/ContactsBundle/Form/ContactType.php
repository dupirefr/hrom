<?php

namespace HROM\ContactsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use HROM\CoreBundle\Form\AddressType;
use HROM\ContactsBundle\Form\PhoneType;
use HROM\ContactsBundle\Form\EmailType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname', 'text', array(
                'label' => 'Nom',
                'attr' => array(
                    'size' => 20
                )
            ))
            ->add('givenName', 'text', array(
                'label' => 'Prénom',
                'attr' => array(
                    'size' => 20
                )
            ))
            ->add('address', new AddressType(), array(
                'label' => 'Adresse'
            ))
            ->add('phoneNumbers', 'collection', array(
                'type' => new PhoneType(),
                'label' => 'Téléphone(s)',
                'attr' => array(
                    'help' => 'Au moins un numéro de téléphone'
                ),
                'options' => array(
                    'label' => 'Numéro'
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'error_bubbling' => false,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__phone_proto__'
            ))
            ->add('emailAddresses', 'collection', array(
                'type' => new EmailType(),
                'required' => false,
                'label' => 'Email(s)',
                'options' => array(
                    'label' => 'Adresse'
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'error_bubbling' => false,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__email_proto__'
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
