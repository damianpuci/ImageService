<?php

namespace AppBundle\Controller;

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

        $em = $this->getDoctrine()->getRepository('AppBundle:Comment');

        $comments=NULL;

        $comment=new Comment();

        if($em->findBy(array('image' => $image)))
        {
            $comments = $em->findBy(array('image' => $image));
        }


        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



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
            'form' => $form->createView()
        ));
    }

}
