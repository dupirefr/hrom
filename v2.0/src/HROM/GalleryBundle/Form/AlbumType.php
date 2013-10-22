<?php

namespace HROM\GalleryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AlbumType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('year', 'choice',
                    array(
                        'required' => false,
                        'choices' => $this->buildYearChoices()
                   )
            )
            ->add('googleAlbumID', 'text')
            ->add('googleAuthenticationKey', 'text')
        ;
    }
    
    public function buildYearChoices()
    {
        $yearsBefore = date('Y', mktime(0, 0, 0, 1, 1, 2000));
        $yearsAfter = date('Y', mktime(0, 0, 0, date("m"), date("d"), date("Y")));
        return array_combine(range($yearsBefore, $yearsAfter), range($yearsBefore, $yearsAfter));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HROM\GalleryBundle\Entity\Album'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hrom_gallerybundle_album';
    }
}
