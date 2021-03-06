<?php

namespace HROM\EventsBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Events repository
 *
 * @author François Dupire
 */
class EventRepository extends EntityRepository
{
    /**
     * Counts events
     * 
     * @return integer
     */
    public function count() {
        $qb = $this->_em->createQueryBuilder();

        $qb
                ->select('count(event)')
                ->from('HROMEventsBundle:Event', 'event');

        return $qb->getQuery()->getSingleScalarResult();
    }
    
    /**
     * Gives events of $date
     * 
     * @param \DateTime $date
     * @param int $monthDaysNumber
     */
    public function findMonthEvents(\DateTime $date, $monthDaysNumber)
    {
        $firstDay = date('Y-m-d', mktime(0, 0, 0, $date->format('m'), 1, $date->format('Y')));
        $lastDay = date('Y-m-d', mktime(0, 0, 0, $date->format('m'), $monthDaysNumber, $date->format('Y')));
        
        $qb = $this->_em->createQueryBuilder();
        
        $qb
                ->select('event')
                ->from('HROMEventsBundle:Event', 'event')
                ->where('event.date >= :firstDay')
                    ->setParameter('firstDay', $firstDay)
                ->andWhere('event.date <= :lastDay')
                    ->setParameter('lastDay', $lastDay)
                ->addOrderBy('event.date', 'ASC')
                ->addOrderBy('event.time', 'ASC');

        
        return $qb->getQuery()->getResult();
    }
}
