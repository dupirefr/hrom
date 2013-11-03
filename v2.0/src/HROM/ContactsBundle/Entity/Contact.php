<?php

namespace HROM\ContactsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Length(max=100, maxMessage="Le nom doit faire au plus {{ limit }} caractère.|Le nom doit faire au plus {{ limit }} caractères.")
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="givenName", type="string", length=100)
     * 
     * @Assert\Length(max=100, maxMessage="Le prénom doit faire au plus {{ limit }} caractère.|Le prénom doit faire au plus {{ limit }} caractères.")
     */
    private $givenName;
    
    /**
     * @ORM\OneToMany(targetEntity="HROM\ContactsBundle\Entity\Phone", mappedBy="contact")
     */
    private $phoneNumbers;
    
    /**
     * @ORM\OneToMany(targetEntity="HROM\ContactsBundle\Entity\Email", mappedBy="contact")
     */
    private $emailAddresses;
    
    
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
        $this->phoneNumbers[] = $phoneNumber;
        $phoneNumber->setContact($this);
    
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
    public function addEmailAddresse(Email $emailAddress)
    {
        $this->emailAddresses[] = $emailAddress;
        $emailAddress->setContact($this);
    
        return $this;
    }

    /**
     * Remove emailAddress
     *
     * @param Email $emailAddress
     */
    public function removeEmailAddresse(Email $emailAddress)
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
}