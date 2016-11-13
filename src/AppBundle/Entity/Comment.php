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
 * @ORM\Table(name="Comment")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CommentRepository")
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
    * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
    public $user;

    /**
     * @ORM\ManyToOne(targetEntity="Image", inversedBy="comments")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    public $image;
}
