<?php

namespace HROM\NewsBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * News repository
 * 
 * @author François Dupire
 */
class NewsRepository extends EntityRepository
{
    /**
     * Count news
     * 
     * @return integer
     */
    public function count() {
        $qb = $this->_em->createQueryBuilder();

        $qb
                ->select('count(news)')
                ->from('HROMNewsBundle:News', 'news');

        return $qb->getQuery()->getSingleScalarResult();
    }
}
