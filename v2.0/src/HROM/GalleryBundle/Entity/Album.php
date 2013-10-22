<?php

namespace HROM\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Album
 *
 * @ORM\Table()
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
     */
    private $name;
    
    /**
     * @var date
     * 
     * @ORM\Column(name="year", type="date", nullable=true)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="googleAlbumID", type="string", length=255)
     */
    private $googleAlbumID;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="googleAuthenticationKey", type="string", length=255)
     */
    private $googleAuthenticationKey;

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
     * Set googleAuthenticationKey
     *
     * @param string $googleAuthenticationKey
     * @return Album
     */
    public function setGoogleAuthenticationKey($googleAuthenticationKey)
    {
        $this->googleAuthenticationKey = $googleAuthenticationKey;
    
        return $this;
    }

    /**
     * Get googleAuthenticationKey
     *
     * @return string 
     */
    public function getGoogleAuthenticationKey()
    {
        return $this->googleAuthenticationKey;
    }

    /**
     * Set year
     *
     * @param \DateTime $year
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
     * @return \DateTime 
     */
    public function getYear()
    {
        return $this->year;
    }
}