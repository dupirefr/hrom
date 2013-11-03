<?php
namespace HROM\ContactsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\Configuration;

use HROM\ContactsBundle\Entity\Contact;
use HROM\ContactsBundle\Form\ContactType;

/**
 * Controller for showing and managing news.
 *
 * @author François Dupire
 */
class ContactAdminController extends Controller {
    public function listAction($page) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMContactsBundle:Contact');

        $limit = Configuration::ADMIN_CONTACTS_PER_PAGE;

        $contactsList = $repository->findBy(array(), array('surname' => 'asc', 'givenName' => 'asc'), $limit, ($page - 1)*$limit);

        $contactsCount = $repository->count();
        $pageCount = ceil($contactsCount / $limit);

        return $this->render('HROMContactsBundle:ContactAdmin:list.html.twig', array('contactsList' => $contactsList, 'pageCount' => $pageCount));
    }
    
    public function addAction() {
        $contact = new Contact();

        $form = $this->createForm(new ContactType(), $contact);

        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($contact);
                $em->flush();

                $session = $this->get('session');
                $session->getFlashBag()->add('succeed', 'Le contact a bien été ajoutée.');

                return $this->redirect($this->generateUrl('contacts_list'));
            }
        }

        return $this->render('HROMContactsBundle:ContactAdmin:add.html.twig', array('form' => $form->createView(), 'actionRoute' => 'contact_add'));
    }
    
    public function editAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMContactsBundle:Contact');
        $contact = $repository->find($id);

        $form = $this->createForm(new ContactType(), $contact);

        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($contact);
                $em->flush();

                $session = $this->get('session');
                $session->getFlashBag()->add('succeed', 'Le contact a bien été modifié.');

                return $this->redirect($this->generateUrl('contacts_list'));
            }
        }

        return $this->render('HROMContactsBundle:ContactAdmin:edit.html.twig', array('form' => $form->createView(), 'actionRoute' => 'contact_edit'));
    }
    
    public function deleteAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMContactsBundle:Contact');
        $contact = $repository->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($contact);
        $em->flush();

        $session = $this->get('session');
        $session->getFlashBag()->add('succeed', 'Le contact a bien été supprimé.');

        return $this->redirect($this->generateUrl('contacts_list'));
    }
}

?>
