<?php

namespace HROM\CursusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\Configuration;

use HROM\CursusBundle\Entity\Cursus;
use HROM\CursusBundle\Form\CursusType;

/**
 * Controller for cursus management
 * 
 * @author François Dupire
 */
class CursusAdminController extends Controller
{
    /**
     * Handles cursus' list demands
     */
    public function listAction($page) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMCursusBundle:Cursus');

        $limit = Configuration::ADMIN_CURSUS_PER_PAGE;

        $cursusList = $repository->findBy(array(), array('name' => 'asc'), $limit, ($page - 1)*$limit);

        $cursusCount = $repository->count();
        $pageCount = ceil($cursusCount / $limit);

        return $this->render('HROMCursusBundle:CursusAdmin:list.html.twig', array(
            'cursusList' => $cursusList,
            'pageCount' => $pageCount
        ));
    }
    
    /**
     * Handles cursus addition demands
     */
    public function addAction() {
        $cursus = new Cursus();

        $form = $this->createForm(new CursusType(), $cursus);

        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($cursus);
                $em->flush();

                $session = $this->get('session');
                $session->getFlashBag()->add('succeed', 'Le cours a bien été ajouté.');

                return $this->redirect($this->generateUrl('cursus_list'));
            }
        }

        return $this->render('HROMCursusBundle:CursusAdmin:add.html.twig', array('form' => $form->createView(), 'actionRoute' => 'cursus_add'));
    }
    
    /**
     * Handles cursus modification demands
     */
    public function editAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMCursusBundle:Cursus');
        $cursus = $repository->find($id);
        
        $form = $this->createForm(new CursusType(), $cursus);
        
        $request = $this->getRequest();
        if($request->isMethod('POST')) {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                
                $em->persist($cursus);
                $em->flush();

                $session = $this->get('session');
                $session->getFlashBag()->add('succeed', 'Le cours a bien été modifié.');

                return $this->redirect($this->generateUrl('cursus_list'));
            }
        }

        return $this->render('HROMCursusBundle:CursusAdmin:edit.html.twig', array('form' => $form->createView(), 'actionRoute' => 'cursus_edit'));
    }
    
    /**
     * Handles cursus deletion demands
     */
    public function deleteAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMCursusBundle:Cursus');
        $cursus = $repository->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($cursus);
        $em->flush();

        $session = $this->get('session');
        $session->getFlashBag()->add('succeed', 'Le cours a bien été supprimé.');

        return $this->redirect($this->generateUrl('cursus_list'));
    }
}
