<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type
 *
 * @ORM\Table(name="type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeRepository")
 */
class Type
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
     * @var bool
     *
     * @ORM\Column(name="labeliser", type="boolean")
     */
    private $labeliser;


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
     * Set labeliser
     *
     * @param boolean $labeliser
     *
     * @return Type
     */
    public function setLabeliser($labeliser)
    {
        $this->labeliser = $labeliser;

        return $this;
    }

    /**
     * Get labeliser
     *
     * @return boolean
     */
    public function getLabeliser()
    {
        return $this->labeliser;
    }
}
