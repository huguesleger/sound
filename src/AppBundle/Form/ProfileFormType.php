<?php


namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;


class ProfileFormType extends AbstractType
{
   
 public function buildForm(FormBuilderInterface $builder, array $options)
    {
     
     
     
       $builder->add('avatar', FileType::class, array('data_class' => null,'required' => false));

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';


    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

    // For Symfony 2.x
    public function getAvatar()
    {
        return $this->getBlockPrefix();
    }
  
}
