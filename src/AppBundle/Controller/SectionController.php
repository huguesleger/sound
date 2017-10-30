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
     
        
        return $this->render('back/section/index.html.twig', array(
            'presents' => $presents,
            'services' => $services,
            'sectionNames' => $sectionNames,
            'promotions'=> $promotions,
        ));
        
    }
    
   
//    /**
//    * delete a service list
//    * @Route("/{id}/delete", name="service_delete")
//    */
//    public function deleteServiceList($id) {
//        $em = $this->getDoctrine()->getManager();
//        $service = $em->find('AppBundle:Service', $id);
//        
//        $this->addFlash('delete',
//                             null );
//        
//        $em->remove($service);
//        $em->flush();
//        
//       return $this->redirectToRoute('section_index');
//    }
   
}
