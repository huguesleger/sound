<?php

namespace AppBundle\Controller\Header;

use AppBundle\Entity\AnimationTexte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Animationtexte controller.
 *
 * @Route("admin/animationtexte")
 */
class AnimationTexteController extends Controller
{
    /**
     * Lists all animationTexte entities.
     *
     * @Route("/", name="animationtexte_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $animationTextes = $em->getRepository('AppBundle:AnimationTexte')->findAll();

        return $this->render('back/animationtexte/index.html.twig', array(
            'animationTextes' => $animationTextes,
        ));
    }

    /**
     * Creates a new animationTexte entity.
     *
     * @Route("/new", name="animationtexte_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $animationTexte = new Animationtexte();
        $form = $this->createForm('AppBundle\Form\AnimationTexteType', $animationTexte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($animationTexte);
            $em->flush();

            return $this->redirectToRoute('animationtexte_show', array('id' => $animationTexte->getId()));
        }

        return $this->render('back/animationtexte/new.html.twig', array(
            'animationTexte' => $animationTexte,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a animationTexte entity.
     *
     * @Route("/{id}", name="animationtexte_show")
     * @Method("GET")
     */
    public function showAction(AnimationTexte $animationTexte)
    {
        $deleteForm = $this->createDeleteForm($animationTexte);

        return $this->render('back/animationtexte/show.html.twig', array(
            'animationTexte' => $animationTexte,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing animationTexte entity.
     *
     * @Route("/{id}/edit", name="animationtexte_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AnimationTexte $animationTexte)
    {
        $deleteForm = $this->createDeleteForm($animationTexte);
        $editForm = $this->createForm('AppBundle\Form\AnimationTexteType', $animationTexte);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('animationtexte_edit', array('id' => $animationTexte->getId()));
        }

        return $this->render('back/animationtexte/edit.html.twig', array(
            'animationTexte' => $animationTexte,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a animationTexte entity.
     *
     * @Route("/{id}", name="animationtexte_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AnimationTexte $animationTexte)
    {
        $form = $this->createDeleteForm($animationTexte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($animationTexte);
            $em->flush();
        }

        return $this->redirectToRoute('animationtexte_index');
    }

    /**
     * Creates a form to delete a animationTexte entity.
     *
     * @param AnimationTexte $animationTexte The animationTexte entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AnimationTexte $animationTexte)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('animationtexte_delete', array('id' => $animationTexte->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
