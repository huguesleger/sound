<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoundType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $date = date('Y-m-d');
        $builder->add('titre')
                ->add('auteur')
                ->add('description',null, array('attr'=> array(
                      'placeholder' => 'description du morceau en quelques lignes ...',
                      'rows'=>3,
                      'onkeyup'=>'reste(this.value);')))
                ->add('annee', null, array(
                    'widget' => 'single_text',
                     'html5' => false, 
                   'attr'=>array('placeholder'=>$date ,'class'=>'has-feedback-left')))
                ->add('morceau', FileType::class, array('data_class' => null,'required' => false, 'label'=>false))
                ->add('image', FileType::class, array('data_class' => null,'required' => false, 'label'=>false))
                ->add('label')
                ->add('link',null, array ('label'=>'Lien SoundCloud','required' => false))
                ->add('linkSpotify',null, array ('label'=>'Lien Spotify','required' => false))
                ->add('linkDeezer',null, array ('label'=>'Lien Deezer','required' => false))
                ->add('genre', null, array('attr'=>array('class'=>'select2_multiple')))
                ->add('publier', null, array('attr'=> array('class'=> 'js-switch')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Sound'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_sound';
    }


}
