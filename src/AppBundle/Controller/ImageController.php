<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Image;

class ImageController extends Controller
{

    /**
     * Matches /page*
     * @Route("/page{number}", defaults={"number" = 1}, name="page")
     */
    public function DisplayPageAction($number)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();


        $em = $this->getDoctrine()->getRepository('AppBundle:Image');
        $query = $em->createQueryBuilder('i')
            ->orderBy('i.date', 'DESC')
            ->getQuery()
        ;


        $images = $query->getResult();


        $images2 = array();


        for ($i=(($number-1)*10);$i<($number*10);$i++)
        {
            if($i <sizeof($images))
            {
                if($images[$i]!=null)
                {
                    array_push($images2,$images[$i]);
                }
            }

        }


        return $this->render('AppBundle:ImageController:show_default_image.html.twig', array(
            'images' => $images,
            'images2'=> $images2,
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }



}
