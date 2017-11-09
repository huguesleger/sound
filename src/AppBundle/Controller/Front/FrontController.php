<?php



namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;




/**
 * Description of FrontController
 *
 * @author hugues
 */
class FrontController  extends Controller {
    
    /**
     * @Route("/", name= "home");
     * @Template(":front:index.html.twig");
     */
    public function home(){
        
        $em = $this->getDoctrine()->getManager();

        $headers = $em->getRepository('AppBundle:Header')->findAll();
        $headerTextes = $em->getRepository('AppBundle:HeaderTexte')->findAll();
        $imageMobiles = $em->getRepository('AppBundle:ImageMobile')->findByPublier(1,array('date'=>'DESC'),1);
        $presents = $em->getRepository('AppBundle:Present')->findByPublier(1,array('date'=>'DESC'),1);
        $services = $em->getRepository('AppBundle:Service')->findByPublier(1,array('date'=>'ASC'),9);
        $promotions = $em->getRepository('AppBundle:Promotion')->findByPublier(1,array('date'=>'DESC'),1);
        $socials = $em->getRepository('AppBundle:Social')->findAll();

        return $this->render('front/index.html.twig', array(
            'headers' => $headers,
            'headerTextes' => $headerTextes,
            'imageMobiles'=> $imageMobiles,
            'presents'=> $presents,
            'services'=> $services,
            'promotions'=> $promotions,
            'socials'=> $socials,
        ));
     
   
    }
    
    /**
     * @Route("/productions", name= "productions");
     * @Template(":front:productions.html.twig");
     */
    public function productions(Request $request){
        
       $em = $this->getDoctrine()->getManager();
       $sounds= $em->getRepository('AppBundle:Sound')->findByPublier(1,array('date'=>'DESC'));
       $pagination = $this->get('knp_paginator')->paginate($sounds,
                  $request->query->get('page', 1)/*le numéro de la page à afficher*/,
          4/*nbre d'éléments par page*/);
       $genres = $em->getRepository('AppBundle:Genre')->findAll();
       $labels = $em->getRepository('AppBundle:Label')->findAll();
       $socials = $em->getRepository('AppBundle:Social')->findAll();
       
        return $this->render('front/productions.html.twig', array(
            'sounds'=> $sounds,
            'pagination'=> $pagination,
            'genres'=> $genres,
            'labels'=> $labels,
            'socials'=> $socials,
            
        ));
        
        
    }
  
     /**
     * @Route("/productions/genre/{id}", name= "productionsgenre");
     */
    public function genreProductions(Request $request,$id){
        
       $em = $this->getDoctrine()->getManager();
       $genres = $em->getRepository('AppBundle:Genre')->findById($id);
       // ici on recupere tous les sons par genre
       $sounds = $em->getRepository('AppBundle:Sound')->getSoundsWithGenre($genres);
         $pagination = $this->get('knp_paginator')->paginate($sounds,
                  $request->query->get('page', 1)/*le numéro de la page à afficher*/,
          4/*nbre d'éléments par page*/);
       $socials = $em->getRepository('AppBundle:Social')->findAll();
       
       return $this->render('front/productionsGenre.html.twig', array(
            'genres' => $genres,
            'sounds'=> $sounds,
            'pagination'=> $pagination,
            'socials'=> $socials,
        ));
    }  
    
     /**
     * @Route("/productions/recherche", name= "productionsrecherche");
     */
    public function soundRecherche(Request $request) {
        
       
        $em = $this->getDoctrine()->getManager();
        $motcle = $request->get('motcle');
        $sounds = $em->getRepository('AppBundle:Sound')->findSoundBytitre($motcle);
        $genres = $em->getRepository('AppBundle:Genre')->findAll();
        $socials = $em->getRepository('AppBundle:Social')->findAll();
        
        

        return $this->render('front/productions.html.twig', array(
            'sounds' => $sounds,
            'genres'=> $genres,
            'socials'=> $socials,
        ));
    } 

}
