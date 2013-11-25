<?php

namespace HROM\CursusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\Configuration;

use HROM\CursusBundle\Entity\Cursus;
use HROM\CursusBundle\Form\CursusType;

class CursusAdminController extends Controller
{
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
