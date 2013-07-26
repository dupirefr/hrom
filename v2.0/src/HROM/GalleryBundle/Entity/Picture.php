<?php

namespace HROM\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Picture
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity(repositoryClass="HROM\GalleryBundle\Entity\PictureRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Picture
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
     * @ORM\Column(name="extension", type="string", length=4)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;
    
    /**
     * @ORM\ManyToOne(targetEntity="HROM\GalleryBundle\Entity\Category")
     * @ORM\JoinColumn(nullable=true)
     * 
     * @Assert\Valid()
     */
    private $category;
    
    /**
     * @Assert\Image(maxSize="1M")
     */
    private $file;
    
    private $tempFilename;
	
	
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
     * Set alt
     *
     * @param string $alt
     * @return Picture
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    
        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set category
     *
     * @param Category $category
     * @return Picture
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * Set file
     * 
     * @param UploadedFile $file
     * @return Picture
     */
    public function setFile(UploadedFile $file)
    {
		$this->file = $file;

		if($this->extension !== null) {
			$this->tempFilename = $this->extension;

			$this->alt = null;
			$this->extension = null;
		}

		return $this;
    }
    
    /**
     * Get file
     * 
     * @return UploadedFile
     */
    public function getFile()
    {
		return $this->file;
    }

    /**
     * Set extension
     *
     * @param string $extension
     * @return Picture
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    
        return $this;
    }

    /**
     * Get extension
     *
     * @return string 
     */
    public function getExtension()
    {
        return $this->extension;
    }
    
    
    /**
     * Permet l'obtention du répertoire de l'image.
     * 
     * @return string le répertoire de l'image.
     */
    public function getPictureDir() {
		return 'images/';
    }
    
    /**
     * Permet l'obtention du répertoire relatif de l'image.
     * 
     * @return string le répertoire relatif de l'image.
     */
    public function getRootPictureDir() {
		return __DIR__ . '../../../../web/' . $this->getPictureDir();
    }
    
    /**
     * Opérations à effectuer avant de persister/mettre à jour l'image.
     * 
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
		if($this->file === null) {
			return;

		} else {
			$this->extension = $this->file->guessExtension();
			$this->alt = $this->file->getClientOriginalName();
		}
    }
    
    /**
     * Opérations à effectuer après avoir persisté/mis à jour l'image.
     * 
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
		if($this->file === null) {
			return;

		} else {
			if($this->tempFilename !== null) {
			$oldFile = $this->getRootPictureDir() . '/' . $this->id;

			if(file_exists($oldFile)) {
				unlink($oldFile);
			}
			}

			$this->file->move($this->getRootPictureDir(), $this->id . '.' . $this->extension);
		}
    }
    
    /**
     * Opérations à effectuer avant de supprimer l'image.
     * 
     * @ORM\PreRemove()
     */
    public function preRemove() {
		$this->tempFilename = $this->getRootPictureDir() . '/' . $this->id . '.' . $this->extension;
    }
    
    /**
     * Opérations à effectuer après avoir supprimé l'image.
     * 
     * @ORM\PostRemove()
     */
    public function postRemove() {
		if(file_exists($this->tempFilename)) {
			unlink($this->tempFilename);
		}
    }
}