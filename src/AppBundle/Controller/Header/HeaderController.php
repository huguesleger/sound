<?php

namespace AppBundle\Controller\Header;

use AppBundle\Entity\Header;
use AppBundle\Form\HeaderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Header controller.
 *
 * @Route("admin/header")
 */
class HeaderController extends Controller
{
    /**
     * Lists all header entities.
     *
     * @Route("/", name="header_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $headers = $em->getRepository('AppBundle:Header')->findAll();
      
        
        return $this->render('back/header/index.html.twig', array(
            'headers' => $headers,
        ));
    }

    /**
     * Creates a new header entity.
     *
     * @Route("/new", name="header_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $header = new Header();
        $form = $this->createForm('AppBundle\Form\HeaderType', $header);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
              $this->addFlash('succes',
                             null );

             if($header->getImage()){
            $nomDuFichier = md5(uniqid()).".".$header->getImage()->getClientOriginalExtension();
            $header->getImage()->move('uploads/header', $nomDuFichier);
            $header->setImage($nomDuFichier);
            }
            

             
            $em = $this->getDoctrine()->getManager();
            $em->persist($header);
            $em->flush();

            return $this->redirectToRoute('header_index');
        }

        return $this->render('back/header/new.html.twig', array(
            'header' => $header,
            'form' => $form->createView(),
             $this->addFlash('error',
                             null )
        ));
    }

    /**
     * Finds and displays a header entity.
     *
     * @Route("/{id}", name="header_show")
     * @Method("GET")
     */
    public function showAction(Header $header)
    {
        $deleteForm = $this->createDeleteForm($header);

        return $this->render('back/header/show.html.twig', array(
            'header' => $header,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing header entity.
     *
     * @Route("/{id}/edit", name="header_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Header $header, $id)
    {
         $em = $this->getDoctrine()->getManager();
        $imageUploaded = $header->getImage();
        
        $deleteForm = $this->createDeleteForm($header);
        $editForm = $this->createForm('AppBundle\Form\HeaderType', $header);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $this->addFlash('update',
                             null );
            
            $headerNew = $em->find('AppBundle:Header', $id);
            $f = $this->createForm(HeaderType::class, $headerNew);
            
            $f->handleRequest($request);

            if ($headerNew->getImage() == null) { //on change pas d'images
                $headerNew->setImage($imageUploaded); //On garde celle déja uploader
                               
                
            }else{ //sinon on upload a nouveau
              
                
                $nomDuFichier = md5(uniqid()). '.' . $headerNew->getImage()->getClientOriginalExtension();
                $headerNew->getImage()->move('uploads/header', $nomDuFichier);
                $headerNew->setImage($nomDuFichier);
            }    
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('header_edit', array('id' => $header->getId()));
            
        }
       
        return $this->render('back/header/edit.html.twig', array(
            'header' => $header,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
    }

    /**
     * Deletes a header entity.
     *
     * @Route("/{id}", name="header_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Header $header)
    {
        $form = $this->createDeleteForm($header);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($header);
            $em->flush();
        }

        return $this->redirectToRoute('header_index');
    }

    /**
     * Creates a form to delete a header entity.
     *
     * @param Header $header The header entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Header $header)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('header_delete', array('id' => $header->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
     /*supprime header/default ou header/carousel  dans la rubrique header*/
    
   /**
    *@Route("/{id}/delete", name="header_delete")
    */
    public function deleteHeader($id) {
        $em = $this->getDoctrine()->getManager();
        $header = $em->find('AppBundle:Header', $id);
        
        $this->addFlash('delete',
                             null );
        
        $em->remove($header);
        $em->flush();
        
       return $this->redirectToRoute('header_index');
    }
    
    
    
}
