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
     
//    /**
//     * @Route("/admin", name="index_genre");
//     */ 
//    public function homeGenre($nom){
//         $em = $this->getDoctrine()->getManager();
//       $genres = $em->getRepository('AppBundle:Genre')->findByNom($nom);
//       // ici on recupere tous les sons par genre
//       $sounds = $em->getRepository('AppBundle:Sound')->getSoundsWithGenre($genres);
//       
//       return $this->render('back/index.html.twig', array(
//            'genres'=> $genres,
//            'sounds'=> $sounds,
//            
//        ));
//    }
    
    
//    /**
//     * @Route("/admin", name= "indexgenre");
//     */
//    public function homeGenres($id){
//        
//       $em = $this->getDoctrine()->getManager();
//       $genres = $em->find('AppBundle:Genre', $id);
//       // ici on recupere tous les sons par genre
//       $sounds = $em->getRepository('AppBundle:Sound')->getSoundsWithGenre($genres);
//        // je recupere paginator
//       
//       return $this->render('front/productionsGenre.html.twig', array(
//            'genres'=> $genres,
//            'sounds'=> $sounds,
//            
//        ));
//    }
    
//    /**
//     * @Route("/admin/aide", name= "aide");
//     */    
//     public function aideSite(){
//        return $this->render('back/aide.html.twig');
//    }
    
    
//    /**
//    * @Route("/admin", name= "stat_show");
//    */ 
//    public function getStat($id) {
//        
//    $em = $this->getDoctrine()->getManager();
//    $sound = $locationRepository = $em->getRepository('AppBundle:Sound',$id);
//    $nbStat = $locationRepository->getNbStat();
//    
//  
//     
//    return $this->render('back/index.html.twig', array(
//            'nbStat'=> $nbStat,
//            'sound'=> $sound,
//            
//        ));
//    }
    
     /**
     * @Route("/admin/ressources", name= "ressources");
     */    
    public function ressources(){
           return $this->render('back/ressources.html.twig');
            
    }
}
