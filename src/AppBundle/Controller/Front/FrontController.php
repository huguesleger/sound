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
        $presents = $em->getRepository('AppBundle:Present')->findByPublier(1);
         $services = $em->getRepository('AppBundle:Service')->findByPublier(1,array('date'=>'ASC'),6);

        return $this->render('front/index.html.twig', array(
            'headers' => $headers,
            'headerTextes' => $headerTextes,
            'presents'=> $presents,
            'services'=> $services,
        ));
     
   
    }
}
