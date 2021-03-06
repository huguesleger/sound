<?php



namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $imageMobiles = $em->getRepository('AppBundle:ImageMobile')->findByPublier(1,array('date'=>'DESC'),1);
        $presents = $em->getRepository('AppBundle:Present')->findByPublier(1,array('date'=>'DESC'),1);
        $services = $em->getRepository('AppBundle:Service')->findByPublier(1,array('date'=>'ASC'),9);
        $promotions = $em->getRepository('AppBundle:Promotion')->findByPublier(1,array('date'=>'DESC'),1);
        $socials = $em->getRepository('AppBundle:Social')->findAll();

        return $this->render('front/index.html.twig', array(
            'headers' => $headers,
            'imageMobiles'=> $imageMobiles,
            'presents'=> $presents,
            'services'=> $services,
            'promotions'=> $promotions,
            'socials'=> $socials,
        ));
     
   
    }
    
    /**
     * @Route("/productions/{page}", name= "productions", requirements={"page" = "\d+"}, defaults={"page" = 1});
     * @Template(":front:productions.html.twig");
     */
    public function productions(Request $request, $page = 1){
        
       $em = $this->getDoctrine()->getManager();
       $sounds= $em->getRepository('AppBundle:Sound')->findByPublier(1,array('date'=>'DESC'));
       // je recupere paginator
       $pagination = $this->get('knp_paginator')->paginate($sounds, 
       $request->query->get('page', $page)/*le numéro de la page à afficher*/,
          4/*nbre d'éléments par page*/);

          
       
       $genres = $em->getRepository('AppBundle:Genre')->findAll();
       $productions = $em->getRepository('AppBundle:Production')->findByPublier(1);
       $labels = $em->getRepository('AppBundle:Label')->findAll();
       $socials = $em->getRepository('AppBundle:Social')->findAll();
       
        return $this->render('front/productions.html.twig', array(
            'sounds'=> $sounds,
            'pagination'=> $pagination,
            'genres'=> $genres,
            'labels'=> $labels,
            'socials'=> $socials,
            'productions'=> $productions,
            
        ));
        
        
    }
    
        /**
        * @Route("/updateStat/{id}", name= "update_stat");
        */
        public function updateStat($id){
         $em = $this->getDoctrine()->getManager();
         $sound = $em->find('AppBundle:Sound', $id);
         $incr = $sound->getStat();
         $sound->setStat($incr+1);

         $em->persist($sound);
         $em->flush();
            
         return  new JsonResponse('ok');
    }
    
        /**
        * @Route("/productions/updateStat/{id}", name= "update_stat_page");
        */
        public function updateStatPage($id){
         $em = $this->getDoctrine()->getManager();
         $sound = $em->find('AppBundle:Sound', $id);
         $incr = $sound->getStat();
         $sound->setStat($incr+1);

         $em->persist($sound);
         $em->flush();
            
         return  new JsonResponse('ok');
    }
    
  
   
    
     /**
     * @Route("/productions/recherche/{page}", name= "productionsrecherche");
     */
    public function soundRecherche(Request $request, $page = 1) {
        
       
        $em = $this->getDoctrine()->getManager();
        
        
        
        $motcle = $request->get('motcle');
        $sounds = $em->getRepository('AppBundle:Sound')->findSoundBytitre($motcle);
         // je recupere paginator
        $pagination = $this->get('knp_paginator')->paginate($sounds,
                  $request->query->get('page', $page)/*le numéro de la page à afficher*/,
          4/*nbre d'éléments par page*/);
        $genres = $em->getRepository('AppBundle:Genre')->findAll();
        $socials = $em->getRepository('AppBundle:Social')->findAll();
        
        

        return $this->render('front/productionsRecherche.html.twig', array(
            'sounds' => $sounds,
            'genres'=> $genres,
            'pagination'=> $pagination,
            'socials'=> $socials,
        ));
    }

    
     /**
     * @Route("/productions/{nom}/{page}", name= "productionsgenre");
     */
    public function genreProductions(Request $request,$nom, $page = 1){
        
       $em = $this->getDoctrine()->getManager();
       $genres = $em->getRepository('AppBundle:Genre')->findByNom($nom);
       // ici on recupere tous les sons par genre
       $sounds = $em->getRepository('AppBundle:Sound')->getSoundsWithGenre($genres);
        // je recupere paginator
         $pagination = $this->get('knp_paginator')->paginate($sounds,
                  $request->query->get('page', $page)/*le numéro de la page à afficher*/,
          4/*nbre d'éléments par page*/);
       $socials = $em->getRepository('AppBundle:Social')->findAll();
       
       return $this->render('front/productionsGenre.html.twig', array(
            'genres'=> $genres,
            'sounds'=> $sounds,
            'pagination'=> $pagination,
            'socials'=> $socials,
            
        ));
    }
    
     /**
     * @Route("/contact", name= "contact");
     */
    public function contactAction(Request $request){
        
        $em = $this->getDoctrine()->getManager();
        $socials = $em->getRepository('AppBundle:Social')->findAll();

           if ($request->getMethod()=='POST')
      {
        
          
        $nom = $request->get('nom');
        $email = $request->get('email');
        $message = $request->get('message');
          
        $contact = Swift_Message::newInstance();
        $contact->toString();
        $contact->setSubject($nom);
        $contact->setFrom($email);
        $contact->setTo('contact@easymusicproject.com');
        $contact->setReplyTo($email);
        $contact->setBody($message);
                    
    $this->get('mailer')->send($contact);
    
        
    $this->addFlash(
            'succesmail',
            'Email envoyé avec succés'
        );
    
        
}

 return $this->render('front/contact.html.twig',

                array(

                    'socials'=> $socials,

                ));
    }
    

    
    
}

