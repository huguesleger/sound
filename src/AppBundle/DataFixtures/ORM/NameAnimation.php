<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\AnimationTexte;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Description of NameAnimation
 *
 * @author hugues
 */
class NameAnimation implements FixtureInterface {
    
    public function load(ObjectManager $manager){
        
     $noms = array ('bounce',
                      'flash',
                      'pulse' ,
                      'rubberBand',  
                      'shake',
                      'swing',
                      'tada',
                      'wobble',
                      'jello',
                      'bounceIn',
                      'bounceInDown',
                      'bounceInLeft',
                      'bounceInRight',
                      'bounceInUp',
                      'bounceOut',
                      'bounceOutDown',
                      'bounceOutLeft',
                      'bounceOutRight',
                      'bounceOutUp',
                      'fadeIn',
                      'fadeInDown',
                      'fadeInDownBig',
                      'fadeInLeft',
                      'fadeInLeftBig',
                      'fadeInRight',
                      'fadeInRightBig',
                      'fadeInUp',
                      'fadeInUpBig',
                      'fadeOut',
                      'fadeOutDown',
                      'fadeOutDownBig',
                      'fadeOutLeft',
                      'fadeOutLeftBig',
                      'fadeOutRight',
                      'fadeOutRightBig',
                      'fadeOutUp',
                      'fadeOutUpBig',
                      'flip',
                      'flipInX',
                      'flipInY',
                      'flipOutX',
                      'flipOutY',
                      'lightSpeedIn',
                      'lightSpeedOut',
                      'rotateIn',
                      'rotateInDownLeft',
                      'rotateInDownRight',
                      'rotateInUpLeft',
                      'rotateInUpRight',
                      'rotateOut',
                      'rotateOutDownLeft',
                      'rotateOutDownRight',
                      'rotateOutUpLeft',
                      'rotateOutUpRight',
                      'slideInUp',
                      'slideInDown',
                      'slideInLeft',
                      'slideInRight',
                      'slideOutUp',
                      'slideOutDown',
                      'slideOutLeft',
                      'slideOutRight',
                      'zoomIn',
                      'zoomInDown',
                      'zoomInLeft',
                      'zoomInRight',
                      'zoomInUp',
                      'zoomOut',
                      'zoomOutDown',
                      'zoomOutLeft',
                      'zoomOutRight',
                      'zoomOutUp',
                      'hinge',
                      'jackInTheBox',
                      'rollIn',
                      'rollOut');
        
        foreach ($noms as $nom){
            $nameanim = new AnimationTexte();
            $nameanim->setNom($nom);
            
            $manager->persist($nameanim);
            
        }
        $manager->flush();
}

    

}
