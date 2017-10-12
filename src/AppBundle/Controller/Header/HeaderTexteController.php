<?php

namespace AppBundle\Controller\Header;

use AppBundle\Entity\HeaderTexte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Headertexte controller.
 *
 * @Route("admin/headertexte")
 */
class HeaderTexteController extends Controller
{
    /**
     * Lists all headerTexte entities.
     *
     * @Route("/", name="headertexte_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $headerTextes = $em->getRepository('AppBundle:HeaderTexte')->findAll();

        return $this->render('back/headertexte/index.html.twig', array(
            'headerTextes' => $headerTextes,
        ));
    }

    /**
     * Creates a new headerTexte entity.
     *
     * @Route("/new", name="headertexte_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $headerTexte = new Headertexte();
        $form = $this->createForm('AppBundle\Form\HeaderTexteType', $headerTexte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('succes',
                             null );
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($headerTexte);
            $em->flush();

            return $this->redirectToRoute('headertexte_index');
        }

        return $this->render('back/headertexte/new.html.twig', array(
            'headerTexte' => $headerTexte,
            'form' => $form->createView(),
             $this->addFlash('error',
                             null )
        ));
    }

    /**
     * Finds and displays a headerTexte entity.
     *
     * @Route("/{id}", name="headertexte_show")
     * @Method("GET")
     */
    public function showAction(HeaderTexte $headerTexte)
    {
        $deleteForm = $this->createDeleteForm($headerTexte);

        return $this->render('back/headertexte/show.html.twig', array(
            'headerTexte' => $headerTexte,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing headerTexte entity.
     *
     * @Route("/{id}/edit", name="headertexte_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, HeaderTexte $headerTexte)
    {
        $deleteForm = $this->createDeleteForm($headerTexte);
        $editForm = $this->createForm('AppBundle\Form\HeaderTexteType', $headerTexte);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
             $this->addFlash('update',
                             null );
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('headertexte_edit', array('id' => $headerTexte->getId()));
        }

        return $this->render('back/headertexte/edit.html.twig', array(
            'headerTexte' => $headerTexte,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            $this->addFlash('error',
                             null )
        ));
    }

    /**
     * Deletes a headerTexte entity.
     *
     * @Route("/{id}", name="headertexte_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, HeaderTexte $headerTexte)
    {
        $form = $this->createDeleteForm($headerTexte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($headerTexte);
            $em->flush();
        }

        return $this->redirectToRoute('headertexte_index');
    }

    /**
     * Creates a form to delete a headerTexte entity.
     *
     * @param HeaderTexte $headerTexte The headerTexte entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(HeaderTexte $headerTexte)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('headertexte_delete', array('id' => $headerTexte->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
