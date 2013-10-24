<?php

namespace HROM\EventsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\Configuration;

use HROM\EventsBundle\Entity\Event;
use HROM\EventsBundle\Form\EventType;

class EventsAdminController extends Controller
{
    public function listAction($page) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMEventsBundle:Event');

        $limit = Configuration::ADMIN_EVENTS_PER_PAGE;

        $eventsList = $repository->findBy(array(), array('date' => 'desc', 'time' => 'desc', 'object' => 'asc'), $limit, ($page - 1)*$limit);

        $eventsCount = $repository->count();
        $pageCount = ceil($eventsCount / $limit);

        return $this->render('HROMEventsBundle:EventsAdmin:list.html.twig', array('eventsList' => $eventsList, 'pageCount' => $pageCount));
    }
    
    public function addAction() {
        $event = new Event();

        $form = $this->createForm(new EventType(), $event);

        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($event);
                $em->flush();

                $session = $this->get('session');
                $session->getFlashBag()->add('succeed', 'L\'événement a bien été ajouté.');

                return $this->redirect($this->generateUrl('events_list'));
            }
        }

        return $this->render('HROMEventsBundle:EventsAdmin:add.html.twig', array('form' => $form->createView(), 'actionRoute' => 'event_add'));
    }
    
    public function editAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMEventsBundle:Event');
        $event = $repository->find($id);

        $form = $this->createForm(new EventType(), $event);

        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($event);
                $em->flush();

                $session = $this->get('session');
                $session->getFlashBag()->add('succeed', 'L\'événement a bien été modifié.');

                return $this->redirect($this->generateUrl('events_list'));
            }
        }

        return $this->render('HROMEventsBundle:EventsAdmin:edit.html.twig', array('form' => $form->createView(), 'actionRoute' => 'event_edit'));
    }
    
    public function deleteAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMEventsBundle:Event');
        $event = $repository->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();

        $session = $this->get('session');
        $session->getFlashBag()->add('succeed', 'L\'événement a bien été supprimé.');

        return $this->redirect($this->generateUrl('events_list'));
    }
}
