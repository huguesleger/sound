<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenreRepository")
 */
class Genre
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
    
    

    
    
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Genre
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
    
    
     /**
     * Set date
     *
     * @param DateTime $date
     *
     * @return Genre
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
    

    
    public function __toString() {
        return $this->getNom();
    }
}

