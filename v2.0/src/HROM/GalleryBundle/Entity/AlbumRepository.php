<?php

namespace HROM\GalleryBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Albums repository
 * 
 * @author François Dupire
 */
class AlbumRepository extends EntityRepository
{
    /**
     * Counts albums
     * 
     * @return integer
     */
    public function count() {
        $qb = $this->_em->createQueryBuilder();

        $qb
                ->select('count(album)')
                ->from('HROMGalleryBundle:Album', 'album');

        return $qb->getQuery()->getSingleScalarResult();
    }
}
