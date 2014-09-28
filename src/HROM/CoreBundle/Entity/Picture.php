<?php

namespace HROM\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Picture entity
 * 
 * @author François Dupire
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity(repositoryClass="HROM\CoreBundle\Entity\PictureRepository")
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\Column(name="url", type="string", length=4)
     */
    private $extension;

    /**
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;
    
    
    /**
     * @Assert\Image(mimeTypesMessage="Le fichier n'est pas une image valide.")
     */
    private $file;
    
    private $temp;

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
     * Get extension
     * 
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
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
     * Set file
     * 
     * @param UploadedFile $file)
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        if ($this->extension !== null) {
            $this->temp = $this->extension;

            $this->extension = null;
            $this->alt = null;
        }
    }
    
    /**
     * Get file
     */
    public function getFile() {
        return $this->file;
    }
      
    /**
     * Defines picture properties
     * 
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if ($this->file !== null) {
            $this->extension = $this->file->guessExtension();
            $this->alt = $this->file->getClientOriginalName();
        }
    }

    /**
     * Saves file
     * 
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if($this->file !== null) {
            if ($this->temp !== null) {
                $oldFile = $this->getAbsoluteDir().'/'.$this->id.'.'.$this->temp;
                
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $this->file->move($this->getAbsoluteDir(), $this->id.'.'.$this->extension);
        }
    }
    
    /**
     * Gets filename
     * 
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->temp = $this->getUploadRootDir().'/'.$this->id.'.'.$this->extension;
    }

    /**
     * Removes saved file
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (file_exists($this->temp)) {
            unlink($this->temp);
        }
    }

    /**
     * Gives relative dir to file
     * 
     * @return string
     */
    public function getRelativeDir()
    {
        return 'images/uploads';
    }

    /**
     * Gives absolute dir to file
     * 
     * @return string
     */
    protected function getAbsoluteDir()
    {
        return __DIR__.'/../../../../web/'.$this->getRelativeDir();
    }
    
    /**
     * Gives path to file
     * 
     * @return string
     */
    public function getPath() {
        return $this->getRelativeDir() . '/' . $this->id . '.' . $this->extension;
    }
}
