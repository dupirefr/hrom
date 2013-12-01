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
    public function queryFindTeachers() {
        $qb = $this->_em->createQueryBuilder();
        
        $qb
                ->select('contact')
                ->from('HROMContactsBundle:Contact', 'contact')
                ->where('contact.roles LIKE :role')
                    ->setParameter('role', '%ROLE_TEACHER%');
        
        return $qb;
    }
    
    public function findTeachers() {
        $qb = $this->queryFindTeachers();
        
        $qb
                ->join('contact.courses', 'courses')
                    ->addSelect('courses')
                ->leftJoin('contact.phoneNumbers', 'phones')
                    ->addSelect('phones')
                ->leftJoin('contact.emailAddresses', 'emails')
                    ->addSelect('emails');
        
        return $qb->getQuery()->getResult();
    }
    
    /**
     * Gets contacts granter with at least one role from $roles
     * 
     * @param array $roles
     * @return array
     */
    public function findByRoles($roles) {
        $qb = $this->_em->createQueryBuilder();
        
        $qb
                ->select('contact')
                ->from('HROMContactsBundle:Contact', 'contact');
        
        $qb
                ->leftJoin('contact.phoneNumbers', 'phones')
                    ->addSelect('phones')
                ->leftJoin('contact.emailAddresses', 'emails')
                    ->addSelect('emails')
                ->leftJoin('contact.courses', 'courses')
                    ->addSelect('courses');
        
        $qb
                ->where('0 < 1');
        
        foreach($roles as $role) {
            $qb
                    ->orWhere('contact.roles LIKE :role')
                        ->setParameter('role', '%' . $role . '%');
        }
        
        return $qb->getQuery()->getResult();
    }
}
