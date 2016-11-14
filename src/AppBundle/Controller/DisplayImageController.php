<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Liking;
use AppBundle\Form\ImageLiking;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Image;
use AppBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use AppBundle\Form\CommentType;

class DisplayImageController extends Controller
{
    /**
     * Matches /DisplayImage*
     * @Route("/DisplayImage{id}", defaults={"id" = NULL}, name="display_image")
     */
    public function DisplayImageAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getRepository('AppBundle:Image');
        $image=$em->find($id);

        $last_username=$this->getUser()->getUsername();

        $User=$this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findOneBy( array('username' => $last_username));



        $comments=NULL;

        $comment=new Comment();


        $em = $this->getDoctrine()->getRepository('AppBundle:Liking');
        $likings = $em->findBy(array('image' => $image));

        $em = $this->getDoctrine()->getRepository('AppBundle:Comment');

        $is_liked=false;

        for($i=0;$i<count($likings);$i++)
        {
            if($likings[$i]->user==$User)
            {
                $is_liked=true;
            }
        }

        if($em->findBy(array('image' => $image)))
        {
            $comments = $em->findBy(array('image' => $image));
        }


        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        $form2 = $this->createForm(ImageLiking::class);
        $form2->handleRequest($request);


        if ($form2->isSubmitted()) {
            $liking=new Liking();

            $image->likeImage();

            $liking->user=$User;
            $liking->image=$image;

            $em = $this->getDoctrine()->getManager();

            $em->persist($liking);
            $em->persist($image);
            $em->flush();

            return $this->redirect($this->generateUrl('page'));


        }

        if ($form->isSubmitted() ) {



            $comment->user=$User;
            $comment->image=$image;

            $comment->setDate(new \DateTime("now"));


            $em = $this->getDoctrine()->getManager();

            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('page'));
        }





        return $this->render('AppBundle:DisplayImage:display_image.html.twig', array(
            'image'=>$image,
            'last_username'=>$last_username,
            'comments'=>$comments,
            'form' => $form->createView(),
            'form2' =>$form2->createView(),
            'likings'=>$likings,
            'is_liked'=>$is_liked
        ));
    }

}
