<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Production;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Production controller.
 *
 * @Route("admin/production")
 */
class ProductionController extends Controller
{
    /**
     * Lists all production entities.
     *
     * @Route("/", name="production_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productions = $em->getRepository('AppBundle:Production')->findAll();

        return $this->render('back/production/index.html.twig', array(
            'productions' => $productions,
        ));
    }

    /**
     * Creates a new production entity.
     *
     * @Route("/new", name="production_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $production = new Production();
        $form = $this->createForm('AppBundle\Form\ProductionType', $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($production);
            $em->flush();

            return $this->redirectToRoute('production_show', array('id' => $production->getId()));
        }

        return $this->render('back/production/new.html.twig', array(
            'production' => $production,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a production entity.
     *
     * @Route("/{id}", name="production_show")
     * @Method("GET")
     */
    public function showAction(Production $production)
    {
        $deleteForm = $this->createDeleteForm($production);

        return $this->render('back/production/show.html.twig', array(
            'production' => $production,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing production entity.
     *
     * @Route("/{id}/edit", name="production_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Production $production)
    {
        $deleteForm = $this->createDeleteForm($production);
        $editForm = $this->createForm('AppBundle\Form\ProductionType', $production);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('production_edit', array('id' => $production->getId()));
        }

        return $this->render('back/production/edit.html.twig', array(
            'production' => $production,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a production entity.
     *
     * @Route("/{id}", name="production_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Production $production)
    {
        $form = $this->createDeleteForm($production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($production);
            $em->flush();
        }

        return $this->redirectToRoute('production_index');
    }

    /**
     * Creates a form to delete a production entity.
     *
     * @param Production $production The production entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Production $production)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('production_delete', array('id' => $production->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}