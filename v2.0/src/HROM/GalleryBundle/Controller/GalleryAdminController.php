<?php

namespace HROM\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\Configuration;

use HROM\GalleryBundle\Entity\Category;
use HROM\GalleryBundle\Form\CategoryType;

class GalleryAdminController extends Controller {
    public function listAction($page) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMGalleryBundle:Category');

        $limit = Configuration::ADMIN_CATEGORY_PER_PAGE;

        $categoryList = $repository->findBy(array(), array('name' => 'asc'), $limit, ($page - 1)*$limit);

        $categoryCount = $repository->count();
        $pageCount = max(floor($categoryCount / $limit), 1);

        return $this->render('HROMGalleryBundle:GalleryAdmin:list.html.twig', array('categoryList' => $categoryList, 'pageCount' => $pageCount));
    }
    
    public function addAction() {
        $category = new Category();

        $form = $this->createForm(new CategoryType(), $category);

        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($category);
                $em->flush();

                $session = $this->get('session');
                $session->getFlashBag()->add('succeed', 'L\'album news a bien été ajouté.');

                return $this->redirect($this->generateUrl('category_list'));
            }
        }

        return $this->render('HROMGalleryBundle:GalleryAdmin:add.html.twig', array('form' => $form->createView(), 'actionRoute' => 'category_add'));
    }
    
    public function editAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMGalleryBundle:Category');
        $category = $repository->find($id);

        $form = $this->createForm(new CategoryType(), $category);

        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($category);
                $em->flush();

                $session = $this->get('session');
                $session->getFlashBag()->add('succeed', 'L\'album a bien été modifié.');

                return $this->redirect($this->generateUrl('category_list'));
            }
        }

        return $this->render('HROMGalleryBundle:GalleryAdmin:edit.html.twig', array('form' => $form->createView(), 'actionRoute' => 'category_edit'));
    }
    
    public function deleteAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMGalleryBundle:Category');
        $category = $repository->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        $session = $this->get('session');
        $session->getFlashBag()->add('succeed', 'L\'album a bien été supprimé.');

        return $this->redirect($this->generateUrl('category_list'));
    }
}
