<?php

namespace HROM\EventsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\EventsBundle\Entity\Calendar;

class EventsController extends Controller
{
    public function calendarAction()
    {
        $calendar = new Calendar(new \DateTime(), $this->getDoctrine()->getManager()->getRepository('HROMEventsBundle:Event'));
        
        return $this->render('HROMEventsBundle:Events:agenda.html.twig', array('calendar' => $calendar));
    }
    
    public function calendarSpecifiedAction($month, $year)
    {
        if($month < 1 || $month > 12 or $year < 1970) {
            $session = $this->get('session');
            $session->getFlashBag()->add('error', 'La date demandée n\'existe pas ou n\'est pas disponible.');
            
            $calendar = new Calendar(new \DateTime(), $this->getDoctrine()->getManager()->getRepository('HROMEventsBundle:Event'));
            
        } else {
            $calendar = new Calendar(new \DateTime(date('m/d/Y', mktime(0, 0, 0, $month, 1, $year))), $this->getDoctrine()->getManager()->getRepository('HROMEventsBundle:Event'));
        }
        
        return $this->render('HROMEventsBundle:Events:agenda.html.twig', array('calendar' => $calendar));
    }
    
    public function calendarDayAction($day, $month, $year)
    {
        if($day < 1 || $day > 31 || $month < 1 || $month > 12 or $year < 1970) {
            $session = $this->get('session');
            $session->getFlashBag()->add('error', 'La date demandée n\'existe pas ou n\'est pas disponible.');
            
            $calendar = new Calendar(new \DateTime(), $this->getDoctrine()->getManager()->getRepository('HROMEventsBundle:Event'));
            
        } else {
            $calendar = new Calendar(new \DateTime(date('m/d/Y', mktime(0, 0, 0, $month, $day, $year))), $this->getDoctrine()->getManager()->getRepository('HROMEventsBundle:Event'));
            
            $eventsList = $calendar->getSelectedDay()->getEventsList();
        }
        
        return $this->render('HROMEventsBundle:Events:agenda.html.twig', array('calendar' => $calendar, 'eventsList' => $eventsList));
    }
    
    public function miniCalendarAction()
    {
        $calendar = new Calendar(new \DateTime(), $this->getDoctrine()->getManager()->getRepository('HROMEventsBundle:Event'));
        
        return $this->render('HROMEventsBundle:Events:mini_agenda.html.twig', array('calendar' => $calendar));
    }
}
