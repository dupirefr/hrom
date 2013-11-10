<?php

namespace HROM\ContactsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use HROM\ContactsBundle\Entity\Contact;

/**
 * Email
 *
 * @ORM\Table(name="email")
 * @ORM\Entity(repositoryClass="HROM\ContactsBundle\Entity\EmailRepository")
 */
class Email
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
     * @ORM\Column(name="address", type="string", length=255)
     * 
     * @Assert\NotBlank(message="L'adresse est obligatoire.")
     * @Assert\Email(message="L'adresse email n'est pas valide.")
     */
    private $address;
    
    /**
     * @ORM\ManyToOne(targetEntity="HROM\ContactsBundle\Entity\Contact", inversedBy="emailAddresses")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Assert\Valid()
     */
    private $contact;
    

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
     * Set address
     *
     * @param string $address
     * @return Email
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set contact
     *
     * @param Contact $contact
     * @return Email
     */
    public function setContact(Contact $contact)
    {
        $this->contact = $contact;
    
        return $this;
    }

    /**
     * Get contact
     *
     * @return Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }
}