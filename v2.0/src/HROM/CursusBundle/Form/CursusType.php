<?php

namespace HROM\CursusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use HROM\ContactsBundle\Entity\ContactRepository;

/**
 * Cursus form builder
 * 
 * @author François Dupire
 */
class CursusType extends AbstractType
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
            ->add('teachers', 'entity', array(
                'label' => 'Professeur(s)',
                'multiple' => true,
                'class' => 'HROMContactsBundle:Contact',
                'query_builder' => function(ContactRepository $er) {
                    return $er->queryFindByRole('ROLE_TEACHER');
                },
                'property' => 'fullName'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HROM\CursusBundle\Entity\Cursus'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hrom_cursusbundle_cursus';
    }
}
