<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Genre;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Genre controller.
 *
 * @Route("admin/genre")
 */
class GenreController extends Controller
{
    /**
     * Lists all genre entities.
     *
     * @Route("/", name="genre_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $genres = $em->getRepository('AppBundle:Genre')->findAll();

        return $this->render('back/genre/index.html.twig', array(
            'genres' => $genres,
        ));
    }

    /**
     * Creates a new genre entity.
     *
     * @Route("/", name="genre_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $genre = new Genre();
        $form = $this->createForm('AppBundle\Form\GenreType', $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('succes',
                             null );
            $em = $this->getDoctrine()->getManager();
            $em->persist($genre);
            $em->flush();
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            return $this->redirectToRoute('genre_index',array( new JsonResponse($response)));
        }

        return $this->render('back/genre/new.html.twig', array(
            'genre' => $genre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a genre entity.
     *
     * @Route("/{id}", name="genre_show")
     * @Method("GET")
     */
    public function showAction(Genre $genre)
    {
        $deleteForm = $this->createDeleteForm($genre);

        return $this->render('back/genre/show.html.twig', array(
            'genre' => $genre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing genre entity.
     *
     * @Route("/{id}/edit", name="genre_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Genre $genre)
    {
        $deleteForm = $this->createDeleteForm($genre);
        $editForm = $this->createForm('AppBundle\Form\GenreType', $genre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
             $this->addFlash('update',
                             null );
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('genre_edit', array('id' => $genre->getId()));
        }

        return $this->render('back/genre/edit.html.twig', array(
            'genre' => $genre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
             $this->addFlash('error',
                             null )
        ));
    }

    /**
     * Deletes a genre entity.
     *
     * @Route("/{id}", name="genre_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Genre $genre)
    {
        $form = $this->createDeleteForm($genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($genre);
            $em->flush();
        }

        return $this->redirectToRoute('genre_index');
    }

    /**
     * Creates a form to delete a genre entity.
     *
     * @param Genre $genre The genre entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Genre $genre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('genre_delete', array('id' => $genre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
    * delete a genre list
    * @Route("/{id}/delete", name="genre_delete")
    */
    public function deleteGenreList($id) {
        $em = $this->getDoctrine()->getManager();
        $genre = $em->find('AppBundle:Genre', $id);
        
        $this->addFlash('delete',
                             null );
        
        $em->remove($genre);
        $em->flush();
        
       return $this->redirectToRoute('genre_index');
    }
}
