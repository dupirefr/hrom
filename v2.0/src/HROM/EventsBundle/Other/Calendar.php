<?php

namespace HROM\EventsBundle\Other;

/**
 * Provides calendar functions
 *
 * @author François Dupire
 */
class Calendar
{
    /**
     * @var \DateTime 
     */
    private $date;
    
    public function __construct(\DateTime $date)
    {
        $this->date = $date;
    }
    
    public function getCalendar()
    {
        $monthFirstDay = $this->getMonthFirstDay();
        $monthDaysNumber = $this->getMonthDaysNumber();
        
        $calendar = array();
        
        for($d = 1; $d < $monthFirstDay; $d++) {
            $calendar[0][$d - 1] = NULL;
        }
        
        for($d = $monthFirstDay; $d < $monthDaysNumber; $d++) {
            $calendar[($d - 1) / 7][($d - 1) % 7] = new \DateTime(mktime(0, 0, 0, $this->date('m'), $d, $this->date('Y')));
        }
    }
    
    private function getMonthFirstDay()
    {
        return date('N', mktime(0, 0, 0, $this->date->format('m'), 1, $this->date->format('Y')));
    }
    
    private function getMonthDaysNumber()
    {
        return date('t', $this->date);
    }
}

?>
