<?php


namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Icon;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadIcon
 *
 * @author hugues
 */
class LoadIcon implements FixtureInterface {
   
    public function load(ObjectManager $manager){
        
        $noms = array ('acoustic-guitar',
                      'amplifier-1',
                      'amplifier' ,
                      'cassette',  
                      'cd',
                      'computer',
                      'drum',
                      'electric-guitar',
                      'guitar-pedal-1',
                      'guitar-pedal',
                      'headphones',
                      'heavy-metal',
                      'metronome',
                      'microphone-1',
                      'microphone',
                      'mixer',
                      'piano',
                      'radio',
                      'sampler',
                      'speaker-1',
                      'spaecker',
                      'synthesizer',
                      'turntable',
                      'vinyl');
        
        foreach ($noms as $nom){
            $icon = new Icon();
            $icon->setNom($nom);
            
            $manager->persist($icon);
            
        }
        $manager->flush();
        
    }
            
}
