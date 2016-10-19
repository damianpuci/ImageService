<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Image;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    /**
     * @Route("/ShowDefaultImage")
     */
    public function ShowDefaultImageAction()
    {

        $em = $this->getDoctrine()->getRepository('AppBundle:Image');
        $query = $em->createQueryBuilder('i')
            ->orderBy('i.date', 'DESC')
            ->getQuery()
        ;

        $images = $query->getResult();



        return $this->render('AppBundle:ImageController:show_default_image.html.twig', array(
            "images" => $images
        ));
    }

    /**
     * Matches /page*
     * @Route("/page{number}", defaults={"number" = 1}, name="page")
     */
    public function DisplayPageAction($number)
    {
        $em = $this->getDoctrine()->getRepository('AppBundle:Image');
        $query = $em->createQueryBuilder('i')
            ->orderBy('i.date', 'DESC')
            ->getQuery()
        ;

        $images = $query->getResult();




        for ($i=(($number-1)*10);$i<($number*10);$i++)
        {
            if($images[i]!=null)
            {
                array_push($images2,$images[i]);
            }

        }

        return $this->render('AppBundle:ImageController:show_default_image.html.twig', array(
            "images" => $images2
        ));
    }



}
