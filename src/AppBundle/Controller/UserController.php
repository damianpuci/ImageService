<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Image;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Matches /UserImages*
     * @Route("/UserImages{number}", defaults={"number" = 1, "last_user"=NULL}, name="user_images")
     */

    public function UserImagesAction(Request $request, $number, $last_user)
    {

        if($request->get('last_username')!=NULL)
        {
            $last_username=$request->get('last_username');
        }
        else
        {
            $last_username=$last_user;
        }

        $User=$this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findOneBy( array('username' => $last_username));


        $id=$User->getId();



        $em = $this->getDoctrine()->getRepository('AppBundle:Image');



        $images=$em->findBy(
            array('user' => $id)
        );

        $images2=array();

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

        return $this->render('AppBundle:User:user_images.html.twig', array(
            'images'=> $images,
            'images2'=>$images2,
            'last_username'=>$last_username,
        ));
    }

}
