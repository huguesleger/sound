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
     * @ORM\Column(name="image", type="string", length=255)
     * @File(mimeTypes={"image/jpeg", "image/png"},
     * maxSize = "800k",
     * maxSizeMessage = "La taille maximum autorisée est de (800ko).")
     */
    private $image;

    /**
     * @var bool
     *
     * @ORM\Column(name="isDefault", type="boolean", nullable= true)
     */
    private $isDefault;
    
    
      /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity = "HeaderTexte", cascade={"persist", "remove"})
     * @JoinTable(name = "fk_texte_list")
     */
    private $headerTexte;


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
     * Set isDefault
     *
     * @param boolean $isDefault
     *
     * @return Header
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return bool
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }
    
    public function getHeaderTexte() {
        return $this->headerTexte;
    }

    public function setHeaderTexte($headerTexte) {
        $this->headerTexte = $headerTexte;
    }


}

