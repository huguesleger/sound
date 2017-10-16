<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sound;
use AppBundle\Form\SoundType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sound controller.
 *
 * @Route("admin/sound")
 */
class SoundController extends Controller
{
    /**
     * Lists all sound entities.
     *
     * @Route("/", name="sound_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sounds = $em->getRepository('AppBundle:Sound')->findAll();
     
        
        return $this->render('back/sound/index.html.twig', array(
            'sounds' => $sounds,
            'genres' => $this->getDoctrine()->getRepository('AppBundle:Genre')->findAll(),
            new JsonResponse($sounds)
        ));
    }
    /**
     * Creates a new sound entity.
     *
     * @Route("/new", name="sound_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sound = new Sound();
        $form = $this->createForm('AppBundle\Form\SoundType', $sound);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $this->addFlash('succes',
                             null );
             
                if($sound->getMorceau()){
                    
            // recupere le nom du sound, supprime tous les espaces et les remplacent par un "_"
            $nomDuFichier = str_replace(' ','_',$sound) .".". $sound->getMorceau()->getClientOriginalExtension();
            // l'enregistre dans le dossier upload/dossier  
            $sound->getMorceau()->move('uploads/music', $nomDuFichier);
            $sound->setMorceau($nomDuFichier);
            }
            
            
             if($sound->getImage()){
            $nomDuFichier = str_replace(' ','_',$sound) .".". $sound->getImage()->getClientOriginalExtension();
            $sound->getImage()->move('uploads/image', $nomDuFichier);
            $sound->setImage($nomDuFichier);
            }
            
            
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($sound);
            $em->flush();

            return $this->redirectToRoute('sound_index');
           
        }
        
       
        return $this->render('back/sound/new.html.twig', array(
            'sound' => $sound,
            'form' => $form->createView(),
            $this->addFlash('error',
                             null )
        ));
    }

    /**
     * Finds and displays a sound entity.
     *
     * @Route("/{id}", name="sound_show")
     * @Method("GET")
     */
    public function showAction(Sound $sound)
    {
        $deleteForm = $this->createDeleteForm($sound);

        return $this->render('back/sound/show.html.twig', array(
            'sound' => $sound,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sound entity.
     *
     * @Route("/{id}/edit", name="sound_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sound $sound, $id)
    {    
        $em = $this->getDoctrine()->getManager();
        $soundUploaded = $sound->getMorceau();
        $imageUploaded = $sound->getImage();
    
        $deleteForm = $this->createDeleteForm($sound);
        $editForm = $this->createForm('AppBundle\Form\SoundType', $sound);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $this->addFlash('update',
                             null );
  
            
            $soundNew = $em->find('AppBundle:Sound', $id);
            $f = $this->createForm(SoundType::class, $soundNew);
            
            $f->handleRequest($request);
            
            if ($soundNew->getMorceau() == null) { //on change pas de morceau
                $soundNew->setMorceau($soundUploaded); //On garde celui déja uploader
                
             }else{ //sinon on upload a nouveau
              
                
                $nomDuFichier = $sound . '.' . $soundNew->getMorceau()->getClientOriginalExtension();
                $soundNew->getMorceau()->move('uploads/music', $nomDuFichier);
                
                $soundNew->setMorceau($nomDuFichier);
            }
            
            if ($soundNew->getImage() == null) { //on change pas d'images
                $soundNew->setImage($imageUploaded); //On garde celle déja uploader
                               
                
            }else{ //sinon on upload a nouveau
              
                
                $nomDuFichier = $sound . '.' . $soundNew->getImage()->getClientOriginalExtension();
                $soundNew->getImage()->move('uploads/image', $nomDuFichier);
                $soundNew->setImage($nomDuFichier);
            }
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sound_edit', array('id' => $sound->getId()));
        }

        return $this->render('back/sound/edit.html.twig', array(
            'sound' => $sound,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            $this->addFlash('error',
                             null )
        ));
    }

    /**
     * Deletes a sound entity.
     *
     * @Route("/{id}", name="sound_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sound $sound)
    {
        $form = $this->createDeleteForm($sound);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sound);
            $em->flush();
        }

        return $this->redirectToRoute('sound_index');
    }

    /**
     * Creates a form to delete a sound entity.
     *
     * @param Sound $sound The sound entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Sound $sound)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sound_delete', array('id' => $sound->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /*supprime musique dans la liste*/
    
   /**
    *@Route("/{id}/delete", name="sound_delete")
    */
    public function deleteSound($id) {
        $em = $this->getDoctrine()->getManager();
        $sound = $em->find('AppBundle:Sound', $id);
        
        $this->addFlash('delete',
                             null );
        
        $em->remove($sound);
        $em->flush();
        
       return $this->redirectToRoute('sound_index');
    }
    

  
}
