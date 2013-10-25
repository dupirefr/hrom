<?php

namespace HROM\EventsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\EventsBundle\Entity\Calendar;

class EventsController extends Controller
{
    public function calendarAction()
    {
        $calendar = new Calendar(new \DateTime(), $this->getDoctrine()->getManager()->getRepository('HROMEventsBundle:Event'));
        
        return $this->render('HROMEventsBundle:Events:calendar.html.twig', array('calendar' => $calendar));
    }

}
