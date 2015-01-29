<?php

namespace HROM\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\Configuration;

use HROM\GalleryBundle\Entity\Album;
use HROM\GalleryBundle\Form\AlbumType;

/**
 * Controller for galleries management
 * 
 * @author François Dupire
 */
class GalleryAdminController extends Controller {
    /**
     * Handles galleries list demands
     */
    public function listAction($page) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMGalleryBundle:Album');

        $limit = Configuration::ADMIN_CATEGORY_PER_PAGE;

        $albumList = $repository->findBy(array(), array('name' => 'asc'), $limit, ($page - 1)*$limit);

        $albumCount = $repository->count();
        $pageCount = ceil($albumCount / $limit);

        return $this->render('HROMGalleryBundle:GalleryAdmin:list.html.twig', array('albumList' => $albumList, 'pageCount' => $pageCount));
    }
    
    /**
     * Handles gallery addition demands
     */
    public function addAction() {
        $album = new Album();

        $form = $this->createForm(new AlbumType(), $album);

        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($album);
                $em->flush();

                $session = $this->get('session');
                $session->getFlashBag()->add('succeed', 'L\'album news a bien été ajouté.');

                return $this->redirect($this->generateUrl('album_list'));
            }
        }

        return $this->render('HROMGalleryBundle:GalleryAdmin:add.html.twig', array('form' => $form->createView(), 'actionRoute' => 'category_add'));
    }
    
    /**
     * Handles gallery modification demands
     */
    public function editAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMGalleryBundle:Album');
        $album = $repository->find($id);

        $form = $this->createForm(new AlbumType(), $album);

        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($album);
                $em->flush();

                $session = $this->get('session');
                $session->getFlashBag()->add('succeed', 'L\'album a bien été modifié.');

                return $this->redirect($this->generateUrl('album_list'));
            }
        }

        return $this->render('HROMGalleryBundle:GalleryAdmin:edit.html.twig', array('form' => $form->createView(), 'actionRoute' => 'category_edit'));
    }
    
    /**
     * Handles gallery deletion demands
     */
    public function deleteAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMGalleryBundle:Album');
        $album = $repository->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($album);
        $em->flush();

        $session = $this->get('session');
        $session->getFlashBag()->add('succeed', 'L\'album a bien été supprimé.');

        return $this->redirect($this->generateUrl('category_list'));
    }
}
