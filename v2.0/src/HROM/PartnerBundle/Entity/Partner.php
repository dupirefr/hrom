<?php

namespace HROM\PartnerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use HROM\CoreBundle\Entity\Picture;

/**
 * Partner entity
 * 
 * @author François Dupire
 *
 * @ORM\Table(name="partner")
 * @ORM\Entity(repositoryClass="HROM\PartnerBundle\Entity\PartnerRepository")
 */
class Partner
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
     * @Assert\NotBlank(message="Le nom ne peut pas être vide.")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     * 
     * @Assert\URL(message="L'URL n'est pas valide.")
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * 
     * @Assert\NotBlank(message="La description ne peut pas être vide.")
     */
    private $description;
    
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
     * Set name
     *
     * @param string $name
     * @return Partner
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
     * Set link
     *
     * @param string $link
     * @return Partner
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Partner
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
     * Set picture
     *
     * @param \HROM\CoreBundle\Entity\Picture $picture
     * @return Partner
     */
    public function setPicture(\HROM\CoreBundle\Entity\Picture $picture = null)
    {
        $this->picture = $picture;
    
        return $this;
    }

    /**
     * Get picture
     *
     * @return \HROM\CoreBundle\Entity\Picture 
     */
    public function getPicture()
    {
        return $this->picture;
    }
}