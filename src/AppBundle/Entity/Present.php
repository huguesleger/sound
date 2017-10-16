<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Present
 *
 * @ORM\Table(name="present")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PresentRepository")
 * @UniqueEntity("publier", message="Une  section avec ce titre est déjà publiée.")
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
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;
    
    
    /**
     *
     * @var bool
     * @ORM\Column(name="publier", type="boolean", unique=true)
     */
    private $publier;
    
     /**
     *
     * @var string
     * @ORM\ManyToOne(targetEntity = "SectionName")
     * @ORM\JoinColumn(name="fk_section_name", referencedColumnName = "id", nullable=true)
     */
    private $name;


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

        
    public function __toString() {
        return $this->getName();
    }


    

}

