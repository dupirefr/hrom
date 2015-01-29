<?php

namespace HROM\ContactsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use HROM\CoreBundle\Form\AddressType;
use HROM\ContactsBundle\Form\PhoneType;
use HROM\ContactsBundle\Form\EmailType;

use HROM\ContactsBundle\Validator\ExistingRole;
use HROM\ContactsBundle\Validator\ExistingCommitteeRole;

/**
 * Contacts form builder
 * 
 * @author François Dupire
 */
class ContactType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $rolesChoices = ExistingRole::getAuthorizedRoles();
        $committeeRolesChoices = ExistingCommitteeRole::getAuthorizedRoles();
        
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
            ))
            ->add('roles', 'choice', array(
                'label' => 'Rôle(s)',
                'multiple' => true,
                'choices' => $rolesChoices,
                'attr' => array(
                    'size' => count($rolesChoices)
                )
            ))
            ->add('committeeRole', 'choice', array(
                'label' => 'Fonction',
                'choices' => $committeeRolesChoices
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
