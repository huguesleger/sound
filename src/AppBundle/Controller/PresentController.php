<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Present;
use AppBundle\Form\PresentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Present controller.
 *
 * @Route("admin/section/present")
 */
class PresentController extends Controller
{
//    /**
//     * Lists all present entities.
//     *
//     * @Route("/", name="present_index")
//     * @Method("GET")
//     */
//    public function indexAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $presents = $em->getRepository('AppBundle:Present')->findAll();
//
//        return $this->render('back/present/index.html.twig', array(
//            'presents' => $presents,
//        ));
//    }

    /**
     * Creates a new present entity.
     *
     * @Route("/new", name="present_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $present = new Present();
        $form = $this->createForm('AppBundle\Form\PresentType', $present);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('succes',
                             null );
            
             if($present->getImage()){
            $nomDuFichier = md5(uniqid()) .".". $present->getImage()->getClientOriginalExtension();
            $present->getImage()->move('uploads/image', $nomDuFichier);
            $present->setImage($nomDuFichier);
            }
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($present);
            $em->flush();

            return $this->redirectToRoute('section_index');
        }

        return $this->render('back/present/new.html.twig', array(
            'present' => $present,
            'form' => $form->createView(),
             $this->addFlash('error',
                             null ),
        ));
    }

    /**
     * Finds and displays a present entity.
     *
     * @Route("/{id}", name="present_show")
     * @Method("GET")
     */
    public function showAction(Present $present)
    {
        $deleteForm = $this->createDeleteForm($present);

        return $this->render('back/present/show.html.twig', array(
            'present' => $present,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing present entity.
     *
     * @Route("/{id}/edit", name="present_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Present $present, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $imageUploaded = $present->getImage();
        
        $deleteForm = $this->createDeleteForm($present);
        $editForm = $this->createForm('AppBundle\Form\PresentType', $present);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->addFlash('update',
                             null );
            
            $presentNew = $em->find('AppBundle:Present', $id);
            $f = $this->createForm(PresentType::class, $presentNew);
            $f->handleRequest($request);
            
            if ($presentNew->getImage() == null) { //on change pas d'images
                $presentNew->setImage($imageUploaded); //On garde celle déja uploader
                               
                
            }else{ //sinon on upload a nouveau
              
                
                $nomDuFichier = md5(uniqid()) . '.' . $presentNew->getImage()->getClientOriginalExtension();
                $presentNew->getImage()->move('uploads/image', $nomDuFichier);
                $presentNew->setImage($nomDuFichier);
            }
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('present_edit', array('id' => $present->getId()));
        }

        return $this->render('back/present/edit.html.twig', array(
            'present' => $present,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
             $this->addFlash('error',
                             null ),
        ));
    }

    /**
     * Deletes a present entity.
     *
     * @Route("/{id}", name="present_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Present $present)
    {
        $form = $this->createDeleteForm($present);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($present);
            $em->flush();
        }

        return $this->redirectToRoute('section_index');
    }

    /**
     * Creates a form to delete a present entity.
     *
     * @param Present $present The present entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Present $present)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('present_delete', array('id' => $present->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
     /**
    * delete a present list
    * @Route("/{id}/delete", name="present_delete")
    */
    public function deletePresentList($id) {
        $em = $this->getDoctrine()->getManager();
        $present = $em->find('AppBundle:Present', $id);
        
        $this->addFlash('delete',
                             null );
        
        $em->remove($present);
        $em->flush();
        
       return $this->redirectToRoute('section_index');
    }
    
//     /**
//     * add a view present select for publish is true
//     * @Route("/publish/{id}", name="present_publish")
//     */
//     public function publishPresent($id){
//         $em = $this->getDoctrine()->getManager();
//         $present = $em->find('AppBundle:Present', $id);
//         $this->createForm(PresentType::class, $present);
//         
//         $present->setPublier(1);
//         
//         $em->merge($present);
//         $em->flush();
//         return $this->redirectToRoute('section_index');
//        
//     }
}
