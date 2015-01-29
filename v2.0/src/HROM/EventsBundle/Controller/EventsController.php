<?php

namespace HROM\EventsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\EventsBundle\Entity\Calendar;

/**
 * Controller for showing events
 * 
 * @author François Dupire
 */
class EventsController extends Controller
{
    /**
     * Shows the calendar for the current month of current year
     */
    public function calendarAction()
    {
        $calendar = new Calendar(new \DateTime(), $this->getDoctrine()->getManager()->getRepository('HROMEventsBundle:Event'));
        
        return $this->render('HROMEventsBundle:Events:agenda.html.twig', array('calendar' => $calendar));
    }
    
    /**
     * Shows the calendar for $month and $year
     */
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
    
    /**
     * Shows calendar for $month and $year and the events of the $day
     */
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
    
    /**
     * Shows a minature calendar for current month and year
     */
    public function miniCalendarAction()
    {
        $calendar = new Calendar(new \DateTime(), $this->getDoctrine()->getManager()->getRepository('HROMEventsBundle:Event'));
        
        return $this->render('HROMEventsBundle:Events:mini_agenda.html.twig', array('calendar' => $calendar));
    }
}
