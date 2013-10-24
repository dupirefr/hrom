<?php

namespace HROM\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use HROM\CoreBundle\Entity\Picture;
use HROM\UserBundle\Entity\User;


/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="HROM\NewsBundle\Entity\NewsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class News
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
     * @ORM\Column(name="title", type="string", length=255)
     * 
     * @Assert\Length(min=10, minMessage="Le titre doit faire au moins {{ limit }} caractère.|Le titre doit faire au moins {{ limit }} caractères.", max=255, maxMessage="Le titre doit faire au plus {{ limit }} caractère.|Le titre doit faire au plus {{ limit }} caractères.")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * 
     * @Assert\NotBlank(message="Le contenu ne peut être vide.")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="instant", type="datetime")
     */
    private $instant;
    
    /**
     * @ORM\ManyToOne(targetEntity="HROM\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Assert\Valid()
     */
    private $author;
    
    /**
     * @ORM\OneToOne(targetEntity="HROM\CoreBundle\Entity\Picture", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * 
     * @Assert\Valid() 
     */
    private $picture;

    public function __construct(User $author) {
        $this->author = $author;
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
     * Set title
     *
     * @param string $title
     * @return News
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return News
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get instant
     *
     * @return \DateTime 
     */
    public function getInstant()
    {
        return $this->instant;
    }

    /**
     * Set author
     *
     * @param User $author
     * @return News
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;
    
        return $this;
    }

    /**
     * Get author
     *
     * @return User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set picture
     *
     * @param Picture $picture
     * @return News
     */
    public function setPicture(Picture $picture = null)
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
	
    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->instant = new \DateTime();
    }
}