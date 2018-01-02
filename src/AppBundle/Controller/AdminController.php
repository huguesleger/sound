<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of AdminController
 *
 * @author hugues
 */
class AdminController extends Controller {
    
    /**
     * @Route("/admin", name="admin_index");
     */ 
    public function homeAdmin(){
        
         $em = $this->getDoctrine()->getManager();
         $locationRepo = $em->getRepository('AppBundle:Sound');
         $locationRepos = $em->getRepository('AppBundle:Genre');
         $nb = $locationRepo->getNb();
         $nbStat = $locationRepo->getNbStat();
         $nbGenre = $locationRepos->getNbGenre();
         $nbLabel = $locationRepo->getNbLabel();
         $nbBrouillon = $locationRepo->getNbBrouillon();
         $nbTotal = $locationRepo->getNbTotal();
         
        $sounds = $em->getRepository('AppBundle:Sound')->findByPublier(1,array('date'=>'DESC'),6);
        $stats  = $em->getRepository('AppBundle:Sound')->findByPublier(1,array('date'=>'DESC'),3);
        $genre = $em->getRepository('AppBundle:Genre')->findAll();
        
        return $this->render('back/homeAdmin.html.twig', array(
            'sounds' => $sounds,
            'stats' => $stats,
            'genre'=> $genre,
            'nb' => $nb,
            'nbStat'=> $nbStat,
            'nbGenre' => $nbGenre,
            'nbLabel' => $nbLabel,
            'nbBrouillon' => $nbBrouillon,
            'nbTotal' => $nbTotal,
        ));
        
    }
    
     /**
     * @Route("/admin/ressources", name= "ressources");
     */    
    public function ressources(){
           return $this->render('back/ressources.html.twig');
            
    }
}
