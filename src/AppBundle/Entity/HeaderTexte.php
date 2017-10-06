<?php

namespace AppBundle\Entity;

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
     * @ORM\JoinColumn(name = "fk_name_animation", referencedColumnName = "id")
     */
    private $nomAnimation;


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
    
    public function getNomAnimation() {
        return $this->nomAnimation;
    }

    public function setNomAnimation($nomAnimation) {
        $this->nomAnimation = $nomAnimation;
    }

      public function __toString() {
        return $this->getTexte();
    }
}

