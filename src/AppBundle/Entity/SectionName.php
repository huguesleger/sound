<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SectionName
 *
 * @ORM\Table(name="section_name")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SectionNameRepository")
 */
class SectionName
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    
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
     * Set name
     *
     * @param string $name
     *
     * @return SectionName
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
     * Set date
     *
     * @param DateTime $date
     *
     * @return SectionName
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
        return $this->getName();
    }
}

