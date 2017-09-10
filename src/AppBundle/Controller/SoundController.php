<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sound;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
                if($sound->getMorceau()){
            $nomDuFichier = $sound .".". $sound->getMorceau()->getClientOriginalExtension();
            $sound->getMorceau()->move('uploads/music', $nomDuFichier);
            $sound->setMorceau($nomDuFichier);
            
            $nomDuFichier = $sound .".". $sound->getImage()->getClientOriginalExtension();
            $sound->getImage()->move('uploads/image', $nomDuFichier);
            $sound->setImage($nomDuFichier);
            }
            
            
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($sound);
            $em->flush();

            return $this->redirectToRoute('sound_show', array('id' => $sound->getId()));
           
        }

        return $this->render('back/sound/new.html.twig', array(
            'sound' => $sound,
            'form' => $form->createView(),
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
    public function editAction(Request $request, Sound $sound)
    {
        $deleteForm = $this->createDeleteForm($sound);
        $editForm = $this->createForm('AppBundle\Form\SoundType', $sound);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sound_edit', array('id' => $sound->getId()));
        }

        return $this->render('back/sound/edit.html.twig', array(
            'sound' => $sound,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sound $sound)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sound_delete', array('id' => $sound->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
