<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\File;

/**
 * ImageMobile
 *
 * @ORM\Table(name="image_mobile")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageMobileRepository")
 */
class ImageMobile
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var UploadedFile
     *
     * @ORM\Column(name="image", type="string", length=255)
     * @File(mimeTypes={"image/jpeg", "image/png"},
     * maxSize = "500k",
     * maxSizeMessage = "La taille maximum autorisée est de (500ko).")
     */
    private $image;
    
     /**
     * @var bool
     *
     * @ORM\Column(name="publier", type="boolean")
     */
    private $publier;


     
    /**
    *
    * @var DateTime
    * @ORM\Column(name="date", type="datetime")
    */
    private $date;
    
    
     
    public function __construct()
{
    $this->date = new DateTime();
}
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return ImageMobile
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * Set publier
     *
     * @param boolean $publier
     *
     * @return ImageMobile
     */
    public function setPublier($publier)
    {
        $this->publier = $publier;

        return $this;
    }

    /**
     * Get publier
     *
     * @return bool
     */
    public function getPublier()
    {
        return $this->publier;
    }
    
    /**
     * Set date
     *
     * @param DateTime $date
     *
     * @return ImageMobile
     */
     public function setDate(DateTime $date) {
        $this->date = $date;
        
        return $this;
    }
    
    
    /**
     * Get date
     *
     * @return DateTime
     */
    public function getDate() {
        return $this->date;
    }
}

