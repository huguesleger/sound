<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\File;

/**
 * Sound
 *
 * @ORM\Table(name="sound")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoundRepository")
 * @UniqueEntity("titre", message="Ce nom existe déjà.")
 */
class Sound
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
     * @ORM\Column(name="titre", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Assert\Length(
     *  max = 250,
     *  maxMessage = "le texte doit avoir maximum {{ limit }} caratères")
     */
    private $description;
    /**
     *
     * @var UploadedFile
     * @ORM\Column(name="morceau", type="string")
     * @File(mimeTypes={"audio/mpeg", "audio/mp3"},
     * maxSize = "2M",
     * maxSizeMessage = "La taille maximum autorisée est de (2M).") 
     */
    private $morceau;
    
    
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
     * @var DateTime
     *
     * @ORM\Column(name="annee", type="date")
     */
    private $annee;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

    /**
     * @var bool
     *
     * @ORM\Column(name="publier", type="boolean")
     */
    private $publier;
    
    
     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity = "Label")
     * @ORM\JoinColumn(name = "fk_label", referencedColumnName = "id")
     */
    private $label;
    
    
     /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;
    
    
     /**
     *
     * @var array
     * @ORM\ManyToMany(targetEntity = "Genre", cascade={"persist", "remove"})
     * @JoinTable(name="genre_list")
     */
    private $genre;
    
    
    
     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity = "Category")
     * @ORM\JoinColumn(name = "fk_category", referencedColumnName = "id")
     */
    private $category;
    
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Sound
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
     * @return Sound
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
     * Set morceau
     *
     * @param string $morceau
     *
     * @return Sound
     */
    public function setMorceau($morceau) {
        
        $this->morceau = $morceau;
        
        return $this;
    }
    
     /**
     * Get morceau
     *
     * @return string
     */
    public function getMorceau() {
        
        return $this->morceau;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Sound
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
     * Set annee
     *
     * @param DateTime $annee
     *
     * @return Sound
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return DateTime
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Sound
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set publier
     *
     * @param boolean $publier
     *
     * @return Sound
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
     * Set label
     *
     * @param array $label
     *
     * @return Sound
     */
    public function setLabel($label) {
        $this->label = $label;
        
        return $this;
    }
    
     /**
     * Get label
     *
     * @return array
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Sound
     */
    public function setLink($link) {
        
        $this->link = $link;
        
        return $this;
    }
    
     
     /**
     * Get link
     *
     * @return string
     */
    public function getLink() {
        return $this->link;
    }

    /**
     * Set genre
     *
     * @param array $genre
     *
     * @return Sound
     */
    public function setGenre($genre) {
        $this->genre = $genre;
        
        return $this;
    }
    
     /**
     * Get genre
     *
     * @return array
     */
    public function getGenre() {
        return $this->genre;
    }

    /**
     * Set date
     *
     * @param DateTime $date
     *
     * @return Sound
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

     /**
     * Set category
     *
     * @param string $category
     *
     * @return Sound
     */
    public function setCategory($category) {
        $this->category = $category;
        
        return $this;
    }
    
    /**
     * Get category
     *
     * @return string
     */
    public function getCategory() {
        return $this->category;
    }

    

        
    
        
    public function __toString() {
        return $this->getTitre();
    }
}
