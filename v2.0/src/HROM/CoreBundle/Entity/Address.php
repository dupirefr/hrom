<?php

namespace HROM\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="HROM\CoreBundle\Entity\AddressRepository")
 */
class Address
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
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     * 
     * @Assert\NotBlank(message="La rue est obligatoire.")
     * @Assert\Length(max=255, maxMessage="La rue doit faire au plus {{ limit }} caractère.|La rue doit faire au plus {{ limit }} caractères.")
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=6, nullable=true)
     * 
     * @Assert\NotBlank(message="Le numéro est obligatoire.")
     * @Assert\Regex(pattern="/^[1-9][0-9]{0,3}[a-zA-Z]{0,2}$/", message="Le numéro n'est pas valide.")
     */
    private $number;

    /**
     * @var integer
     *
     * @ORM\Column(name="postalCode", type="integer", nullable=true)
     * 
     * @Assert\NotBlank(message="Le code postal est obligatoire.")
     * @Assert\Range(min=1000, minMessage="Le code postal n'est pas valide.", max=9999, maxMessage="Le code postal n'est pas valide.")
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100, nullable=true)
     * 
     * @Assert\NotBlank(message="La ville est obligatoire.")
     * @Assert\Length(max=100, maxMessage="La ville doit faire au plus {{ limit }} caractère.|La ville doit faire au plus {{ limit }} caractères.")
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="box", type="string", length=10, nullable=true)
     * 
     * @Assert\Length(max=10, maxMessage="La boîte doit faire au plus {{ limit }} caractère.|La boîte doit faire au plus {{ limit }} caractères.")
     */
    private $box;


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
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;
    
        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Address
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set postalCode
     *
     * @param integer $postalCode
     * @return Address
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    
        return $this;
    }

    /**
     * Get postalCode
     *
     * @return integer 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set box
     *
     * @param string $box
     * @return Address
     */
    public function setBox($box)
    {
        $this->box = $box;
    
        return $this;
    }

    /**
     * Get box
     *
     * @return string 
     */
    public function getBox()
    {
        return $this->box;
    }
}
