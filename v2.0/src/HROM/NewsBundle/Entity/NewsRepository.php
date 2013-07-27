<?php

namespace HROM\NewsBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * NewsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NewsRepository extends EntityRepository {
	public function count() {
		$qb = $this->_em->createQueryBuilder();
		
		$qb
			->select('count(news)')
			->from('HROMNewsBundle:News', 'news');
                
                return $qb->getQuery()->getSingleScalarResult();
	}
}
