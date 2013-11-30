<?php

namespace HROM\EventsBundle\Entity;

use HROM\EventsBundle\Entity\EventRepository;

use HROM\EventsBundle\Entity\CalendarDay;

/**
 * Calendar object
 *
 * @author François Dupire
 */
class Calendar
{
    /**
     * @var \DateTime 
     */
    private $date;
    
    private $calendar;
    
    /**
     * @var EventRepository 
     */
    private $repository;
    
    public function __construct(\DateTime $date, EventRepository $repository)
    {
        $this->date = $date;
        $this->repository = $repository;
        
        $this->fillCalendar();
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
     * Gives calendar for date's month
     * 
     * @return array;
     */
    public function getCalendar()
    {
        return $this->calendar;
    }
    
    /**
     * Gives date's CalendarDay
     * 
     * @return CalendarDay
     */
    public function getSelectedDay()
    {
        $monthFirstDay = $this->getMonthFirstDay();
        
        $cell = $this->date->format('d') + $monthFirstDay - 2;
        
        return $this->calendar[$cell / 7][$cell % 7];
    }
    
    /**
     * Gives the first day of date's month
     * 
     * @return date
     */
    private function getMonthFirstDay()
    {
        return date('N', mktime(0, 0, 0, $this->date->format('m'), 1, $this->date->format('Y')));
    }
    
    /**
     * Gives the number of days in date's month
     * 
     * @return date
     */
    private function getMonthDaysNumber()
    {
        return date('t', mktime(0, 0, 0, $this->date->format('m'), 1, $this->date->format('Y')));
    }
    
    /**
     * Fills $this->calendar with days and events
     */
    private function fillCalendar()
    {        
        $monthFirstDay = $this->getMonthFirstDay();
        $monthDaysNumber = $this->getMonthDaysNumber();
        
        $eventsList = $this->repository->findMonthEvents($this->date, $monthDaysNumber);
        
        $this->calendar = array();
        
        for($d = 1; $d < $monthFirstDay; $d++) {
            $this->calendar[0][$d - 1] = NULL;
        }
        
        for($d = 1, $i = $monthFirstDay - 1; $d <= $monthDaysNumber; $d++, $i++) {
            $this->calendar[$i / 7][$i % 7] = new CalendarDay(new \DateTime(date('m/d/Y', mktime(0, 0, 0, $this->date->format('m'), $d, $this->date->format('Y')))), $eventsList);
            
            while($d == $monthDaysNumber && ($i + 1) % 7 != 0) {      
                $i++;
                
                $this->calendar[$i / 7][$i % 7] = NULL;
            }
        }
    }
}

?>
