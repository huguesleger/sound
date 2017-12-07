<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * HeaderTexte
 *
 * @ORM\Table(name="header_texte")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HeaderTexteRepository")
 */
class HeaderTexte
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
     * @ORM\Column(name="texte", type="string", length=255)
     */
    private $texte;
    
      /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity = "AnimationTexte")
     * @ORM\JoinColumn(name = "fk_animation_texte", referencedColumnName = "id")
     */
    private $animationTexte;
    
    
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
     * @return HeaderTexte
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
    
    public function getAnimationTexte() {
        return $this->animationTexte;
    }

    public function setAnimationTexte($animationTexte) {
        $this->animationTexte = $animationTexte;
    }
    
    
        /**
     * Set date
     *
     * @param DateTime $date
     *
     * @return HeaderTexte
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
        return $this->getTexte();
    }
}

