<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\File;


/**
 * Header
 *
 * @ORM\Table(name="header")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HeaderRepository")
 */
class Header
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
     * @ORM\Column(name="image", type="string", length=255, nullable= true)
     * @File(mimeTypes={"image/jpeg", "image/png"},
     * maxSize = "900k",
     * maxSizeMessage = "La taille maximum autorisée est de (900ko).")
     */
    private $image;

    /**
     * @var bool
     *
     * @ORM\Column(name="styleDefault", type="boolean", nullable= true)
     */
    private $styleDefault;
    
    
     /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity = "HeaderTexte", cascade={"persist"})
     * @JoinTable(name = "fk_texte_list")
     */
    private $headerTexte;
    
  


//    public function addApplication(HeaderTexte $animationTexte)
//  {
//    $this->headerTexte[] = $animationTexte;
//
//    // On lie l'annonce à la candidature
//    $animationTexte->setHeaderTexte($this);
//
//    return $this;
//  }
//
//  public function removeApplication(HeaderTexte $animationTexte)
//  {
//    $this->headerTexte->removeElement($animationTexte);
//
//    // Et si notre relation était facultative (nullable=true, ce qui n'est pas notre cas ici attention) :        
//    // $application->setAdvert(null);
//  }
    
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
     * @return Header
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
     * Set styleDefault
     *
     * @param boolean $styleDefault
     *
     * @return Header
     */
    public function setStyleDefault($styleDefault)
    {
        $this->styleDefault = $styleDefault;

        return $this;
    }

    /**
     * Get styleDefault
     *
     * @return bool
     */
    public function getStyleDefault()
    {
        return $this->styleDefault;
    }
    
    public function getHeaderTexte() {
        return $this->headerTexte;
    }

    public function setHeaderTexte($headerTexte) {
        $this->headerTexte = $headerTexte;
        
        return $this;
    }
    
    public function __toString() {
        return $this->getHeaderTexte();
    }




}

