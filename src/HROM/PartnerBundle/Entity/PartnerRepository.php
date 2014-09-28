<?php

namespace HROM\PartnerBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Partners repository
 * 
 * @author François Dupire
 */
class PartnerRepository extends EntityRepository
{
    /**
     * Count contacts
     * 
     * @return integer
     */
    public function count() {
        $qb = $this->_em->createQueryBuilder();

        $qb
                ->select('count(partner)')
                ->from('HROMPartnerBundle:Partner', 'partner');

        return $qb->getQuery()->getSingleScalarResult();
    }
}
