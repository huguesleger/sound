<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Description of HomePageController
 *
 * @author hugues
 */
class HomePageController extends Controller {
    
     /**
     * @Route("/admin/homepage", name="homepage_index");
     * @Method("GET")
     */
    public function LoadSections(){
        
        
         $em = $this->getDoctrine()->getManager();

        $items = $em->getRepository('AppBundle:Item')->findAll();
        
        
        
        return $this->render('back/homepage/index.html.twig', array(
            'items' => $items
        ));
    }
    



        
    }
    
    
    
    
    

