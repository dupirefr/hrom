<?php

namespace HROM\ContactsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use HROM\ContactsBundle\Entity\Contact;

/**
 * Phone
 *
 * @ORM\Table(name="phone")
 * @ORM\Entity(repositoryClass="HROM\ContactsBundle\Entity\PhoneRepository")
 */
class Phone
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
     * @ORM\Column(name="number", type="string", length=20)
     * 
     * @Assert\NotBlank(message="Le numéro est obligatoire.")
     * @Assert\Length(min=9, minMessage="Le numéro de téléphone n'est pas valide.", max=20, maxMessage="Le numéro de téléphone n'est pas valide.")
     */
    private $number;
    
    /**
     * @ORM\ManyToOne(targetEntity="HROM\ContactsBundle\Entity\Contact", inversedBy="phoneNumbers")
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
     * Set number
     *
     * @param string $number
     * @return Phone
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
     * Set contact
     *
     * @param Contact $contact
     * @return Phone
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