<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ImageController extends Controller
{
    /**
     * @Route("/ShowDefaultImage")
     */
    public function ShowDefaultImageAction()
    {
        return $this->render('AppBundle:ImageController:show_default_image.html.twig', array(
            // ...
        ));
    }

}
