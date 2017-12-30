<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * User
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
    * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
   /**
     * @ORM\Column(name="avatarPath", type="string", length=255, nullable=true)
     */
    protected $avatarPath;
 
    /**
     * @Assert\File(
     *     maxSize = "150k",
     *     mimeTypes = {"image/jpeg", "image/png"},
     *     maxSizeMessage = "The maxmimum allowed file size is 150ko.",
     *     mimeTypesMessage = "Only the filetypes image are allowed.")
     */
    protected $avatar;
 
    protected $avatarTemp;
    

    
        public function __construct() {
        parent::__construct();
    }
    
    
     /*
    ******************** Profile Avatar upload ********************
    */
 
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->avatar) {
            $filename = sha1(uniqid(mt_rand(), true));
            $this->avatarPath = $filename.'.'.$this->getAvatar()->guessExtension();
        }
    }
 
    /**
     * Called after entity persistence
     *
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // The file property can be empty if the field is not required
        if (null === $this->avatar) {
            return;
        }
 
        // check if we have an old image
        if (isset($this->avatarTemp)) {
            // delete the old image
            // unlink($this->avatarTemp);
            // clear the temp image path
            $this->avatarTemp = null;
        }
 
        $this->getAvatar()->move(
            $this->getUploadRootDir(),
            $this->avatarPath
        );
 
        // Clean up the file property as you won't need it anymore
        $this->avatar = null;
    }
    
    
    
    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar() {
        return $this->avatar;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return User
     */
    public function setAvatar(UploadedFile $avatar = null)
    {
        $this->avatar = $avatar;
        // check if we have an old image path
        if (isset($this->avatarPath)) {
            // store the old name to delete after the update
            $this->avatarTemp = $this->avatarPath;
            $this->avatarPath = null;
        } else {
            $this->avatarPath = 'initial';
        }
    }
    
     public function getAbsolutePath()
    {
        return null === $this->avatarPath
            ? null
            : $this->getUploadRootDir().'/'.$this->avatarPath;
    }
 
    public function getWebPath()
    {
        return null === $this->avatarPath
            ? null
            : $this->getUploadDir().'/'.$this->avatarPath;
    }
 
    public function getUploadDir()
    {
        return 'uploads/avatar';
    }
 
    protected function getUploadRootDir()
    {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }
 
    public function __toString()
    {
        return $this->getAvatarPath();
    }
 
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }
 
 
    public function getFull()
    {
        return $this->surname." ".$this->name;
    }

    public function getAvatarPath() {
        return $this->avatarPath;
    }

    public function setAvatarPath($avatarPath) {
        $this->avatarPath = $avatarPath;
    }


  
    
    
    
 
  
    

    
}
