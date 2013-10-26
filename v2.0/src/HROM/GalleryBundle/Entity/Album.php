<?php

namespace HROM\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="HROM\GalleryBundle\Entity\AlbumRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Album
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="name", type="string", length=255) 
     * 
     * @Assert\Length(min=4, minMessage="Le nom doit faire au moins {{ limit }} caractère.|Le nom doit faire au moins {{ limit }} caractères.", max=255, maxMessage="Le nom doit faire au plus {{ limit }} caractère.|Le nom doit faire au plus {{ limit }} caractères.")
     */
    private $name;
    
    /**
     * @var date
     * 
     * @ORM\Column(name="year", type="integer", nullable=true)
     * 
     * @Assert\Range(min=2000, minMessage="L'année doit être au moins 2000.")
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="googleAlbumID", type="string", length=255)
     */
    private $googleAlbumID;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Album
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set googleAlbumID
     *
     * @param string $googleAlbumID
     * @return Album
     */
    public function setGoogleAlbumID($googleAlbumID)
    {
        $this->googleAlbumID = $googleAlbumID;
    
        return $this;
    }

    /**
     * Get googleAlbumID
     *
     * @return string 
     */
    public function getGoogleAlbumID()
    {
        return $this->googleAlbumID;
    }

    /**
     * Set year
     *
     * @param Integer $year
     * @return Album
     */
    public function setYear($year)
    {
        $this->year = $year;
    
        return $this;
    }

    /**
     * Get year
     *
     * @return \Integer
     */
    public function getYear()
    {
        return $this->year;
    }
}