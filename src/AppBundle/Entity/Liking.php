<?php
/**
 * Created by PhpStorm.
 * User: Damian1
 * Date: 2016-11-14
 * Time: 14:09
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Liking")
 */
class Liking
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="likings")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;

    /**
     * @ORM\ManyToOne(targetEntity="Image", inversedBy="likings")
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




}
