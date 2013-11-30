<?php

namespace HROM\ContactsBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Contacts repository
 * 
 * @author François Dupire
 */
class ContactRepository extends EntityRepository
{
    /**
     * Counts contacts
     * 
     * @return integer
     */
    public function count() {
        $qb = $this->_em->createQueryBuilder();

        $qb
                ->select('count(contact)')
                ->from('HROMContactsBundle:Contact', 'contact');

        return $qb->getQuery()->getSingleScalarResult();
    }
    
    /**
     * Builds query for searching contact granted with $role
     * 
     * @param string $role
     * @return QueryBuilder
     */
    public function queryFindByRole($role) {
        $qb = $this->_em->createQueryBuilder();
        
        $qb
                ->select('contact')
                ->from('HROMContactsBundle:Contact', 'contact')
                ->where('contact.roles LIKE :role')
                    ->setParameter('role', '%' . $role . '%');
        
        return $qb;
    }
    
    /**
     * Gets contacts granted with $role
     * 
     * @param string $role
     * @return array
     */
    public function findByRole($role) {
        $qb = $this->queryFindByRole($role);
        
        return $qb->getQuery()->getResult();
    }
}
