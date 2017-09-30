<?php



namespace AppBundle\Controller;

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
     * @Template(":front:home.html.twig");
     */
    public function home(){
   
    }
}
