<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\File;


/**
 * Present
 *
 * @ORM\Table(name="present")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PresentRepository")
 */
class Present
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
     * @var string
     *
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var UploadedFile
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     * @File(mimeTypes={"image/jpeg", "image/png"},
     * maxSize = "800k",
     * maxSizeMessage = "La taille maximum autorisée est de (800ko).")
     */
    private $image;
    
    
    /**
     *
     * @var bool
     * @ORM\Column(name="publier", type="boolean")
     */
    private $publier;
    
     /**
     *
     * @var string
     * @ORM\ManyToOne(targetEntity = "SectionName")
     * @ORM\JoinColumn(name="fk_section_name", referencedColumnName = "id",onDelete="SET NULL")
     * @Assert\NotBlank()
     *  
     */
    private $name;


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
     * Set texte
     *
     * @param string $texte
     *
     * @return Present
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Present
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
     * Set name
     *
     * @param string $name
     *
     * @return Present
     */
     public function setName($name) {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
     /**
     * Set publier
     *
     * @param boolean $publier
     *
     * @return Present
     */
     public function setPublier($publier) {
        $this->publier = $publier;
        
        return $this;
    }
    
/**
     * Get publier
     *
     * @return bool
     */
    public function getPublier() {
        return $this->publier;
    }

        
//    public function __toString() {
//        return $this->getName();
//    }

    /**
     * Set date
     *
     * @param DateTime $date
     *
     * @return Present
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

