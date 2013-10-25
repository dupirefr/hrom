<?php

namespace HROM\EventsBundle\Entity;

use HROM\EventsBundle\Entity\EventRepository;

use HROM\EventsBundle\Entity\CalendarDay;

/**
 * Provides a calendar
 *
 * @author François Dupire
 */
class Calendar
{
    /**
     * @var \DateTime 
     */
    private $date;
    
    /**
     * @var EventRepository 
     */
    private $repository;
    
    public function __construct(\DateTime $date, EventRepository $repository)
    {
        $this->date = $date;
        $this->repository = $repository;
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
        $monthFirstDay = $this->getMonthFirstDay();
        $monthDaysNumber = $this->getMonthDaysNumber();
        
        $calendar = array();
        
        for($d = 1; $d < $monthFirstDay; $d++) {
            $calendar[0][$d - 1] = NULL;
        }
        
        for($d = 1, $i = $monthFirstDay - 1; $d <= $monthDaysNumber; $d++, $i++) {
            $calendar[$i / 7][$i % 7] = new CalendarDay(new \DateTime(date('m/d/Y', mktime(0, 0, 0, $this->date->format('m'), $d, $this->date->format('Y')))), $this->repository);
            
            while($d == $monthDaysNumber && ($i + 1) % 7 != 0) {      
                $i++;
                
                $calendar[$i / 7][$i % 7] = NULL;
            }
        }
        
        return $calendar;
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
}

?>
