<?php

namespace HROM\ContactsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use HROM\CoreBundle\Entity\Address;
use HROM\CoreBundle\Validator\UniqueCollectionItem;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="HROM\ContactsBundle\Entity\ContactRepository")
 */
class Contact
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
     * @ORM\Column(name="surname", type="string", length=100)
     * 
     * @Assert\NotBlank(message="Le nom est obligatoire.")
     * @Assert\Length(max=100, maxMessage="Le nom doit faire au plus {{ limit }} caractère.|Le nom doit faire au plus {{ limit }} caractères.")
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="givenName", type="string", length=100)
     * 
     * @Assert\NotBlank(message="Le prénom est obligatoire.")
     * @Assert\Length(max=100, maxMessage="Le prénom doit faire au plus {{ limit }} caractère.|Le prénom doit faire au plus {{ limit }} caractères.")
     */
    private $givenName;
    
    /**
     * @ORM\OneToMany(targetEntity="HROM\ContactsBundle\Entity\Phone", mappedBy="contact", cascade={"persist", "remove"})
     * 
     * @Assert\Count(min=1, minMessage="Vous devez spécifier au moins {{ limit }} numéro de téléphone.|Vous devez spécifier au moins {{ limit }} numéros de téléphone.")
     * @Assert\Valid()
     * @Assert\All(constraints={
     *      @UniqueCollectionItem(propertyPath="number", message="Il ne peut y avoir plusieurs fois le même numéro de téléphone.")
     * })
     */
    private $phoneNumbers;
    
    /**
     * @ORM\OneToMany(targetEntity="HROM\ContactsBundle\Entity\Email", mappedBy="contact", cascade={"persist", "remove"})
     * 
     * @Assert\Valid()
     * @Assert\All(constraints={
     *      @UniqueCollectionItem(propertyPath="address", message="Il ne peut y avoir plusieurs fois la même adresse email.")
     * })
     */
    private $emailAddresses;
    
    /**
     * @ORM\OneToOne(targetEntity="HROM\CoreBundle\Entity\Address", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Assert\Valid()
     */
    private $address;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->phoneNumbers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->emailAddresses = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set surname
     *
     * @param string $surname
     * @return Contact
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    
        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set givenName
     *
     * @param string $givenName
     * @return Contact
     */
    public function setGivenName($givenName)
    {
        $this->givenName = $givenName;
    
        return $this;
    }

    /**
     * Get givenName
     *
     * @return string 
     */
    public function getGivenName()
    {
        return $this->givenName;
    }
    
    /**
     * Add phoneNumber
     *
     * @param Phone $phoneNumber
     * @return Contact
     */
    public function addPhoneNumber(Phone $phoneNumber)
    {
        if($phoneNumber !== NULL) {
            $phoneNumber->setContact($this);
            $this->phoneNumbers[] = $phoneNumber;
        }
    
        return $this;
    }

    /**
     * Remove phoneNumber
     *
     * @param Phone $phoneNumber
     */
    public function removePhoneNumber(Phone $phoneNumber)
    {
        $this->phoneNumbers->removeElement($phoneNumber);
    }

    /**
     * Get phoneNumbers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    /**
     * Add emailAddress
     *
     * @param Email $emailAddress
     * @return Contact
     */
    public function addEmailAddress(Email $emailAddress)
    {
        if($emailAddress !== null) {
            $emailAddress->setContact($this);
            $this->emailAddresses[] = $emailAddress;
        }

        return $this;
    }

    /**
     * Remove emailAddress
     *
     * @param Email $emailAddress
     */
    public function removeEmailAddress(Email $emailAddress)
    {
        $this->emailAddresses->removeElement($emailAddress);
    }

    /**
     * Get emailAddresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmailAddresses()
    {
        return $this->emailAddresses;
    }

    /**
     * Set address
     *
     * @param Address $address
     * @return Contact
     */
    public function setAddress(Address $address)
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
}