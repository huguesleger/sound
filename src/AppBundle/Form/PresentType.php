<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('texte',null, array('attr'=> array(
                      'placeholder' => 'votre présentation ...',
                      'rows'=>6,
                      'onkeyup'=>'saisiePresent(this.value);')))
                ->add('image', FileType::class, array('data_class' => null,'required' => false, 'label'=>false))
                ->add('publier', null, array('attr'=> array('class'=> 'js-switch')))
                ->add('name',null, array('label'=>'Nom de la section'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Present'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_present';
    }


}
