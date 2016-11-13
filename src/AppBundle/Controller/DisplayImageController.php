<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Image;

class DisplayImageController extends Controller
{
    /**
     * Matches /DisplayImage*
     * @Route("/DisplayImage{id}", defaults={"id" = NULL}, name="display_image")
     */
    public function DisplayImageAction($id)
    {
        $em = $this->getDoctrine()->getRepository('AppBundle:Image');
        $image=$em->find($id);


        $last_username=$this->getUser()->getUsername();

        return $this->render('AppBundle:DisplayImage:display_image.html.twig', array(
            'image'=>$image,
            'last_username'=>$last_username
        ));
    }

}
