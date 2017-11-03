<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Social;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Social controller.
 *
 * @Route("admin/social")
 */
class SocialController extends Controller
{
    /**
     * Lists all social entities.
     *
     * @Route("/", name="social_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $socials = $em->getRepository('AppBundle:Social')->findAll();

        return $this->render('back/social/index.html.twig', array(
            'socials' => $socials,
        ));
    }

    /**
     * Creates a new social entity.
     *
     * @Route("/", name="social_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $social = new Social();
        $form = $this->createForm('AppBundle\Form\SocialType', $social);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('succes',
                             null );
            $em = $this->getDoctrine()->getManager();
            $em->persist($social);
            $em->flush();
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            return $this->redirectToRoute('social_index',array( new JsonResponse($response)));
        }

        return $this->render('back/social/new.html.twig', array(
            'social' => $social,
            'form' => $form->createView(),
            $this->addFlash('error',
                             null ),
        ));
    }

    /**
     * Finds and displays a social entity.
     *
     * @Route("/{id}", name="social_show")
     * @Method("GET")
     */
    public function showAction(Social $social)
    {
        $deleteForm = $this->createDeleteForm($social);

        return $this->render('back/social/show.html.twig', array(
            'social' => $social,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing social entity.
     *
     * @Route("/{id}/edit", name="social_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Social $social)
    {
        
        $deleteForm = $this->createDeleteForm($social);
        $editForm = $this->createForm('AppBundle\Form\SocialType', $social);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
             $this->addFlash('update',
                             null );

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('social_edit', array('id' => $social->getId()));

        }

        return $this->render('back/social/edit.html.twig', array(
            'social' => $social,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            $this->addFlash('error',
                             null ),
        ));
    }

    /**
     * Deletes a social entity.
     *
     * @Route("/{id}", name="social_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Social $social)
    {
        $form = $this->createDeleteForm($social);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($social);
            $em->flush();
        }

        return $this->redirectToRoute('social_index');
    }

    /**
     * Creates a form to delete a social entity.
     *
     * @param Social $social The social entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Social $social)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('social_delete', array('id' => $social->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
