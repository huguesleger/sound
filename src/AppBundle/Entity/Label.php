<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Label
 *
 * @ORM\Table(name="label")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LabelRepository")
 */
class Label
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
     * @return Label
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
     * @return Label
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

