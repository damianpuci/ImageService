<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TopRatedController extends Controller
{
    /**
     * @Route("/ShowTopRated", name="show_top_rated")
     */
    public function ShowTopRatedAction()
    {
        $last_username=$this->getUser()->getUsername();

        $em = $this->getDoctrine()->getRepository('AppBundle:Image');

        $query = $em->createQueryBuilder('i')
            ->where('i.number_of_likings > 0')
            ->orderBy('i.number_of_likings', 'DESC')
            ->getQuery();

        $images=$query->getResult();



        return $this->render('AppBundle:TopRated:show_top_rated.html.twig', array(
            'images' => $images,
            'last_username' => $last_username
        ));
    }

}
