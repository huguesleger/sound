<?php


namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * SectionController
 *
 * @Route("admin/section")
 */
class SectionController extends Controller {
    
    /**
     * @Route("/", name="section_index")
     * @Method("GET")
     */
    public function IndexAction(){
        
        $em = $this->getDoctrine()->getManager();
        $presents = $em->getRepository('AppBundle:Present')->findAll();
        $services = $em->getRepository('AppBundle:Service')->findAll();
        $promotions = $em->getRepository('AppBundle:Promotion')->findAll();
        $sectionNames = $em->getRepository('AppBundle:SectionName')->findAll();
        
        $locationRepo = $em->getRepository('AppBundle:Present');
        $locationRepos = $em->getRepository('AppBundle:Promotion');
        $nb = $locationRepo->getNbPublish();
        $nbPromo = $locationRepos->getNbPublish();
     
        
        return $this->render('back/section/index.html.twig', array(
            'presents' => $presents,
            'services' => $services,
            'nb' => $nb,
            'nbPromo' => $nbPromo,
            'sectionNames' => $sectionNames,
            'promotions'=> $promotions,
        ));
        
    }
    
   
}
