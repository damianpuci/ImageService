<?php

namespace AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Monolog\Handler\ElasticSearchHandler;
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

        $images2=new ArrayCollection();

        $number_of_iteration=NULL;

        if(sizeof($images)>10)
        {
            $number_of_iteration=10;
        }
        else
        {
            $number_of_iteration=sizeof($images);
        }

        for($i=0;$i<$number_of_iteration;$i++)
        {
            $images2[$i]=$images[$i];
        }

        return $this->render('AppBundle:TopRated:show_top_rated.html.twig', array(
            'images' => $images2,
            'last_username' => $last_username
        ));
    }

}
