<?php



namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


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

        return $this->render('front/index.html.twig', array(
            'headers' => $headers,
            'headerTextes' => $headerTextes,
        ));
     
   
    }
}
