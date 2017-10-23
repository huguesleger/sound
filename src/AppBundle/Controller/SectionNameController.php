<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SectionName;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Sectionname controller.
 *
 * @Route("admin/sectionname")
 */
class SectionNameController extends Controller
{
    /**
     * Lists all sectionName entities.
     *
     * @Route("/", name="sectionname_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sectionNames = $em->getRepository('AppBundle:SectionName')->findAll();

        return $this->render('back/sectionname/index.html.twig', array(
            'sectionNames' => $sectionNames,
        ));
    }

    /**
     * Creates a new sectionName entity.
     *
     * @Route("/", name="sectionname_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sectionName = new Sectionname();
        $form = $this->createForm('AppBundle\Form\SectionNameType', $sectionName);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('succes',
                             null );
            $em = $this->getDoctrine()->getManager();
            $em->persist($sectionName);
            $em->flush();
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            return $this->redirectToRoute('sectionname_index',array( new JsonResponse($response)));
        }

        return $this->render('back/sectionname/new.html.twig', array(
            'sectionName' => $sectionName,
            'form' => $form->createView(),
             $this->addFlash('error',
                             null ),
        ));
    }

    /**
     * Finds and displays a sectionName entity.
     *
     * @Route("/{id}", name="sectionname_show")
     * @Method("GET")
     */
    public function showAction(SectionName $sectionName)
    {
        $deleteForm = $this->createDeleteForm($sectionName);

        return $this->render('back/sectionname/show.html.twig', array(
            'sectionName' => $sectionName,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sectionName entity.
     *
     * @Route("/{id}/edit", name="sectionname_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SectionName $sectionName)
    {
        $deleteForm = $this->createDeleteForm($sectionName);
        $editForm = $this->createForm('AppBundle\Form\SectionNameType', $sectionName);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->addFlash('update',
                             null );
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sectionname_edit', array('id' => $sectionName->getId()));
        }

        return $this->render('back/sectionname/edit.html.twig', array(
            'sectionName' => $sectionName,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            $this->addFlash('error',
                             null ),
        ));
    }

    /**
     * Deletes a sectionName entity.
     *
     * @Route("/{id}", name="sectionname_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SectionName $sectionName)
    {
        $form = $this->createDeleteForm($sectionName);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sectionName);
            $em->flush();
        }

        return $this->redirectToRoute('sectionname_index');
    }

    /**
     * Creates a form to delete a sectionName entity.
     *
     * @param SectionName $sectionName The sectionName entity
     *
     * @return Form The form
     */
    private function createDeleteForm(SectionName $sectionName)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sectionname_delete', array('id' => $sectionName->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
    * delete a section name list
    * @Route("/{id}/delete", name="sectionname_delete")
    */
    public function deleteSectionNameList($id) {
        $em = $this->getDoctrine()->getManager();
        $sectionname = $em->find('AppBundle:SectionName', $id);
        
        $this->addFlash('delete',
                             null );
        
        $em->remove($sectionname);
        $em->flush();
        
       return $this->redirectToRoute('sectionname_index');
    }
}
