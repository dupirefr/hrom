<?php

namespace HROM\CursusBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Cursus respository
 *
 * @author François Dupire
 */
class CursusRepository extends EntityRepository
{
    /**
     * Count cursus
     * 
     * @return integer
     */
    public function count() {
        $qb = $this->_em->createQueryBuilder();

        $qb
                ->select('count(cursus)')
                ->from('HROMCursusBundle:Cursus', 'cursus');

        return $qb->getQuery()->getSingleScalarResult();
    }
}
