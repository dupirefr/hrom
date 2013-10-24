<?php

namespace HROM\EventsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use HROM\CoreBundle\Entity\Address;
use HROM\CoreBundle\Entity\Picture;
use HROM\CoreBundle\Validator\FutureDate;

/**
 * Event
 *
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="HROM\EventsBundle\Entity\EventRepository")
 */
class Event
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
     * @ORM\Column(name="object", type="string", length=255)
     * 
     * @Assert\Length(min=10, minMessage="L'objet doit faire au moins {{ limit }} caractère.|L'objet doit faire au moins {{ limit }} caractères.", max=255, maxMessage="L'objet doit faire au plus {{ limit }} caractère.|L'objet doit faire au plus {{ limit }} caractères.")
     */
    private $object;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     * 
     * @Assert\Date(message="La date n'est pas valide.")
     * @FutureDate(message="La date doit être postérieure à aujourd'hui.")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time", nullable=true)
     * 
     * @Assert\Time(message="L'heure n'est pas valide.")
     */
    private $time;
    
    /**
     * @ORM\OneToOne(targetEntity="HROM\CoreBundle\Entity\Address", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * 
     * @Assert\Valid() 
     */
    private $address;
    
    /**
     * @ORM\OneToOne(targetEntity="HROM\CoreBundle\Entity\Picture", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * 
     * @Assert\Valid() 
     */
    private $picture;


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
     * Set object
     *
     * @param string $object
     * @return Event
     */
    public function setObject($object)
    {
        $this->object = $object;
    
        return $this;
    }

    /**
     * Get object
     *
     * @return string 
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Event
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     * @return Event
     */
    public function setTime($time)
    {
        $this->time = $time;
    
        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set address
     *
     * @param Address $address
     * @return Event
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return Address 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set picture
     *
     * @param Picture $picture
     * @return Event
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    
        return $this;
    }

    /**
     * Get picture
     *
     * @return Picture 
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
