<?php
/**
 * Created by PhpStorm.
 * User: Damian1
 * Date: 2016-11-13
 * Time: 21:49
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="Comment")
 */
class Comment
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200, unique=true)
     */
    private $content;


    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
    * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
    public $user;

    /**
     * @ORM\ManyToOne(targetEntity="Image", inversedBy="comments")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    public $image;


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
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * Get path
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
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
     * Set content
     *
     * @param string content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->date;
    }



}
