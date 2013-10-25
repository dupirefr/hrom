<?php

namespace HROM\EventsBundle\Entity;

use HROM\EventsBundle\Entity\EventRepository;

/**
 * Day of a calendar
 *
 * @author François Dupire
 */
class CalendarDay
{
    /**
     * @var \DateTime 
     */
    private $date;
    
    private $eventsList;
    
    public function __construct(\DateTime $date, EventRepository $repository)
    {
        $this->date = $date;
        
        $this->eventsList = $repository->findBy(array('date' => $date), array('time' => 'asc', 'object' => 'asc'));
    }
    
    /**
     * Get date
     * 
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * Get eventsList
     * @return list
     */
    public function getEventsList()
    {
        return $this->eventsList;
    }
    
    /**
     * True if date is before today
     * 
     * @return boolean
     */
    public function isPast()
    {
        return $this->date < new \DateTime(date('m/d/Y'));
    }
   
    /**
     * True if date is today
     * 
     * @return boolean
     */
    public function isToday()
    {
        return $this->date == new \DateTime(date('m/d/Y'));
    }
    
    /**
     * True if date is after today
     * 
     * @return boolean
     */
    public function isFuture()
    {
        return $this->date > new \DateTime(date('m/d/Y'));
    }
}

?>
