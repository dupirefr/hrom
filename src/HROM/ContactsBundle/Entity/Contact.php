<?php

namespace HROM\ContactsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use HROM\ContactsBundle\Validator\ExistingRole;
use HROM\ContactsBundle\Validator\ExistingCommitteeRole;

use HROM\CoreBundle\Entity\Address;
use HROM\CoreBundle\Validator\UniqueCollectionItem;

use \HROM\CursusBundle\Entity\Cursus;

/**
 * Contact entity
 * 
 * @author François Dupire
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
     * @var array
     * 
     * @ORM\Column(name="roles", type="array")
     * 
     * @ExistingRole() 
     */
    private $roles;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="committeeRole", type="string", length=255, nullable=true)
     * 
     * @ExistingCommitteeRole()
     */
    private $committeeRole;
    
    /**
     * @ORM\ManyToMany(targetEntity="HROM\CursusBundle\Entity\Cursus", mappedBy="teachers")
     */
    private $courses;
    
    
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
     * Get full name (surname + given name)
     * 
     * @return string
     */
    public function getFullName() {
        return $this->surname . ' ' . $this->givenName;
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

    /**
     * Set roles
     *
     * @param array $roles
     * @return Contact
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    
        return $this;
    }

    /**
     * Get roles
     *
     * @return array 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Add emailAddresses
     *
     * @param \HROM\ContactsBundle\Entity\Email $emailAddresses
     * @return Contact
     */
    public function addEmailAddresse(\HROM\ContactsBundle\Entity\Email $emailAddresses)
    {
        $this->emailAddresses[] = $emailAddresses;
    
        return $this;
    }

    /**
     * Remove emailAddresses
     *
     * @param \HROM\ContactsBundle\Entity\Email $emailAddresses
     */
    public function removeEmailAddresse(\HROM\ContactsBundle\Entity\Email $emailAddresses)
    {
        $this->emailAddresses->removeElement($emailAddresses);
    }

    /**
     * Set committeeRole
     *
     * @param string $committeeRole
     * @return Contact
     */
    public function setCommitteeRole($committeeRole)
    {
        $this->committeeRole = $committeeRole;
    
        return $this;
    }

    /**
     * Get committeeRole
     *
     * @return string 
     */
    public function getCommitteeRole()
    {
        return $this->committeeRole;
    }

    /**
     * Add cursus
     *
     * @param Cursus $cursus
     * @return Contact
     */
    public function addCourse(Cursus $cursus)
    {
        $this->courses[] = $cursus;
    
        return $this;
    }

    /**
     * Remove cursus
     *
     * @param Cursus $cursus
     */
    public function removeCourse(Cursus $cursus)
    {
        $this->courses->removeElement($cursus);
    }

    /**
     * Get cursus
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCourses()
    {
        return $this->courses;
    }
}