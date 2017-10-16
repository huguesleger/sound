<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServiceRepository")
 */
class Service
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="publier", type="boolean")
     */
    private $publier;
    
    
     /**
     *
     * @var string
     * @ORM\ManyToOne(targetEntity = "SectionName")
     * @ORM\JoinColumn(name="fk_name", referencedColumnName = "id")
     */
    private $name;
    
     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity = "Icon")
     * @ORM\JoinColumn(name = "fk_icon", referencedColumnName = "id")
     */
    private $icon;


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
     * Set name
     *
     * @param string $name
     *
     * @return Service
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Service
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Service
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
     * Set publier
     *
     * @param boolean $publier
     *
     * @return Service
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
     * Set icon
     *
     * @param boolean $icon
     *
     * @return Service
     */
    public function setIcon($icon) {
        $this->icon = $icon;
        
        return $this;
    }
    
    
     /**
     * Get icon
     *
     * @return string
     */
    public function getIcon() {
        return $this->icon;
    }

    
    
   


}

