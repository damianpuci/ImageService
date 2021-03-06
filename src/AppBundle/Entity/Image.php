<?php
/**
 * Created by PhpStorm.
 * User: Damian1
 * Date: 2016-10-14
 * Time: 01:21
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="Image")
 */
class Image
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=300)
     */
    public $path;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    public $number_of_likings;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set path
     *
     * @param string path
     *
     * @return Image
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function __construct()
    {
        $this->number_of_likings =0;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }

    public function likeImage()
    {
        $this->number_of_likings++;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }


    /**
     * Set name
     *
     * @param string name
     *
     * @return Image
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
     * @param datetime date
     *
     * @return Image
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
    *Get date
    *
    * @return string
    */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="images")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="image")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="Liking", mappedBy="image")
     */
    private $likings;


}