<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Label;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Label controller.
 *
 * @Route("admin/label")
 */
class LabelController extends Controller
{
    /**
     * Lists all label entities.
     *
     * @Route("/", name="label_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $labels = $em->getRepository('AppBundle:Label')->findAll();

        return $this->render('back/label/index.html.twig', array(
            'labels' => $labels,
        ));
    }

    /**
     * Creates a new label entity.
     *
     * @Route("/", name="label_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $label = new Label();
        $form = $this->createForm('AppBundle\Form\LabelType', $label);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $this->addFlash('succes',
                             null );
            $em = $this->getDoctrine()->getManager();
            $em->persist($label);
            $em->flush();
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            return $this->redirectToRoute('label_index',array( new JsonResponse($response)));
        }

        return $this->render('back/label/new.html.twig', array(
            'label' => $label,
            'form' => $form->createView(),
             $this->addFlash('error',
                             null ),
        ));
    }

    /**
     * Finds and displays a label entity.
     *
     * @Route("/{id}", name="label_show")
     * @Method("GET")
     */
    public function showAction(Label $label)
    {
        $deleteForm = $this->createDeleteForm($label);

        return $this->render('back/label/show.html.twig', array(
            'label' => $label,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing label entity.
     *
     * @Route("/{id}/edit", name="label_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Label $label)
    {
        $deleteForm = $this->createDeleteForm($label);
        $editForm = $this->createForm('AppBundle\Form\LabelType', $label);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
           
           $this->addFlash('update',
                             null );
            $this->getDoctrine()->getManager()->flush();
      

            return $this->redirectToRoute('label_edit', array('id' => $label->getId()));
        }

        return $this->render('back/label/edit.html.twig', array(
            'label' => $label,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            $this->addFlash('error',
                             null ),
        ));
    }

    /**
     * Deletes a label entity.
     *
     * @Route("/{id}", name="label_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Label $label)
    {
        $form = $this->createDeleteForm($label);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($label);
            $em->flush();
        }

        return $this->redirectToRoute('label_index');
    }

    /**
     * Creates a form to delete a label entity.
     *
     * @param Label $label The label entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Label $label)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('label_delete', array('id' => $label->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
     /**
    * delete a label list
    * @Route("/{id}/delete", name="label_delete")
    */
    public function deletelabelList($id) {
        $em = $this->getDoctrine()->getManager();
        $label = $em->find('AppBundle:Label', $id);
        
        $this->addFlash('delete',
                             null );
        
        $em->remove($label);
        $em->flush();
        
       return $this->redirectToRoute('label_index');
    }
}
