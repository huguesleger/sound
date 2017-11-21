<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of AdminController
 *
 * @author hugues
 */
class AdminController extends Controller {
    
    /**
     * @Route("/admin", name="admin_index");
     * @Template(":back:index.html.twig");
     */ 
    public function homeAdmin(){
        
         $em = $this->getDoctrine()->getManager();

        $sounds = $em->getRepository('AppBundle:Sound')->findByPublier(1,array('date'=>'DESC'));

        return $this->render('back/index.html.twig', array(
            'sounds' => $sounds,
        ));
        
    }
}
