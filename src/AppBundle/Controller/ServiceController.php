<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Service controller.
 *
 * @Route("admin/section/service")
 */
class ServiceController extends Controller
{
    /**
     * Lists all service entities.
     *
     * @Route("/", name="service_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $services = $em->getRepository('AppBundle:Service')->findAll();

        return $this->render('back/service/index.html.twig', array(
            'services' => $services,
            
        ));
    }

    /**
     * Creates a new service entity.
     *
     * @Route("/new", name="service_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $service = new Service();
        $form = $this->createForm('AppBundle\Form\ServiceType', $service);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('succes',
                             null );
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();

            return $this->redirectToRoute('section_index');
        }
        $icons = $em->getRepository('AppBundle:Icon')->findAll();
        return $this->render('back/service/new.html.twig', array(
            'service' => $service,
            'form' => $form->createView(),
             'icons' => $icons,
            $this->addFlash('error',
                             null ),
        ));
    }

    /**
     * Finds and displays a service entity.
     *
     * @Route("/{id}", name="service_show")
     * @Method("GET")
     */
    public function showAction(Service $service)
    {
        $deleteForm = $this->createDeleteForm($service);

        return $this->render('back/service/show.html.twig', array(
            'service' => $service,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing service entity.
     *
     * @Route("/{id}/edit", name="service_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Service $service)
    {
        $deleteForm = $this->createDeleteForm($service);
        $editForm = $this->createForm('AppBundle\Form\ServiceType', $service);
        $em = $this->getDoctrine()->getManager();
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
             $this->addFlash('update',
                             null );
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('service_edit', array('id' => $service->getId()));
        }
         $icons = $em->getRepository('AppBundle:Icon')->findAll();
        return $this->render('back/service/edit.html.twig', array(
            'service' => $service,
             'icons' => $icons,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
             $this->addFlash('error',
                             null ),
        ));
    }

    /**
     * Deletes a service entity.
     *
     * @Route("/{id}", name="service_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Service $service)
    {
        $form = $this->createDeleteForm($service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($service);
            $em->flush();
        }

        return $this->redirectToRoute('service_index');
    }

    /**
     * Creates a form to delete a service entity.
     *
     * @param Service $service The service entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Service $service)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('service_delete', array('id' => $service->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
    * delete a service list
    * @Route("/{id}/delete", name="service_delete")
    */
    public function deleteServiceList($id) {
        $em = $this->getDoctrine()->getManager();
        $service = $em->find('AppBundle:Service', $id);
        
        $this->addFlash('delete',
                             null );
        
        $em->remove($service);
        $em->flush();
        
       return $this->redirectToRoute('section_index');
    }
    
}
