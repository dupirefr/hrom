<?php

namespace HROM\CursusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use HROM\ContactsBundle\Entity\Contact;

/**
 * Cursus entity
 * 
 * @author François Dupire
 *
 * @ORM\Table(name="cursus")
 * @ORM\Entity(repositoryClass="HROM\CursusBundle\Entity\CursusRepository")
 */
class Cursus
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
     * @ORM\ManyToMany(targetEntity="HROM\ContactsBundle\Entity\Contact", inversedBy="courses")
     * @ORM\JoinColumn(nullable=true)
     */
    private $teachers;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teachers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Cursus
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
     * Add teachers
     *
     * @param Contact $teachers
     * @return Cursus
     */
    public function addTeacher(Contact $teachers)
    {
        $this->teachers[] = $teachers;
    
        return $this;
    }

    /**
     * Remove teachers
     *
     * @param Contact $teachers
     */
    public function removeTeacher(Contact $teachers)
    {
        $this->teachers->removeElement($teachers);
    }

    /**
     * Get teachers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeachers()
    {
        return $this->teachers;
    }
}