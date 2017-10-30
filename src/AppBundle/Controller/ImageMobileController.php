<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ImageMobile;
use AppBundle\Form\ImageMobileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Imagemobile controller.
 *
 * @Route("admin/imagemobile")
 */
class ImageMobileController extends Controller
{
    /**
     * Lists all imageMobile entities.
     *
     * @Route("/", name="imagemobile_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imageMobiles = $em->getRepository('AppBundle:ImageMobile')->findAll();

        return $this->render('back/imagemobile/index.html.twig', array(
            'imageMobiles' => $imageMobiles,
          
        ));
    }

    /**
     * Creates a new imageMobile entity.
     *
     * @Route("/new", name="imagemobile_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $imageMobile = new Imagemobile();
        $form = $this->createForm('AppBundle\Form\ImageMobileType', $imageMobile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $this->addFlash('succes',
                             null );
             
            if($imageMobile->getImage()){
            $nomDuFichier = md5(uniqid()) .".". $imageMobile->getImage()->getClientOriginalExtension();
            $imageMobile->getImage()->move('uploads/header', $nomDuFichier);
            $imageMobile->setImage($nomDuFichier);
            }
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($imageMobile);
            $em->flush();

            return $this->redirectToRoute('imagemobile_show', array('id' => $imageMobile->getId()));
        }

        return $this->render('back/imagemobile/new.html.twig', array(
            'imageMobile' => $imageMobile,
            'form' => $form->createView(),
             $this->addFlash('error',
                             null ),
        ));
    }

    /**
     * Finds and displays a imageMobile entity.
     *
     * @Route("/{id}", name="imagemobile_show")
     * @Method("GET")
     */
    public function showAction(ImageMobile $imageMobile)
    {
        $deleteForm = $this->createDeleteForm($imageMobile);

        return $this->render('back/imagemobile/show.html.twig', array(
            'imageMobile' => $imageMobile,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing imageMobile entity.
     *
     * @Route("/{id}/edit", name="imagemobile_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ImageMobile $imageMobile, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $imageUploaded = $imageMobile->getImage();
        
        $deleteForm = $this->createDeleteForm($imageMobile);
        $editForm = $this->createForm('AppBundle\Form\ImageMobileType', $imageMobile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
             $this->addFlash('update',
                             null );
             
            $imgNew = $em->find('AppBundle:ImageMobile', $id);
            $f = $this->createForm(ImageMobileType::class, $imgNew);
            $f->handleRequest($request);
            
             if ($imgNew->getImage() == null) { //on change pas d'images
                $imgNew->setImage($imageUploaded); //On garde celle déja uploader
                               
                
            }else{ //sinon on upload a nouveau
              
                
                
                $nomDuFichier = md5(uniqid()) . '.' . $imgNew->getImage()->getClientOriginalExtension();
                $imgNew->getImage()->move('uploads/header', $nomDuFichier);
                $imgNew->setImage($nomDuFichier);
            }
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('imagemobile_edit', array('id' => $imageMobile->getId()));
            
        }

        return $this->render('back/imagemobile/edit.html.twig', array(
            'imageMobile' => $imageMobile,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            $this->addFlash('error',
                             null ),
        ));
    }

    /**
     * Deletes a imageMobile entity.
     *
     * @Route("/{id}", name="imagemobile_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ImageMobile $imageMobile)
    {
        $form = $this->createDeleteForm($imageMobile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($imageMobile);
            $em->flush();
        }

        return $this->redirectToRoute('imagemobile_index');
    }

    /**
     * Creates a form to delete a imageMobile entity.
     *
     * @param ImageMobile $imageMobile The imageMobile entity
     *
     * @return Form The form
     */
    private function createDeleteForm(ImageMobile $imageMobile)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('imagemobile_delete', array('id' => $imageMobile->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
