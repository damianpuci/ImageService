<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Image;
use AppBundle\Entity\User;
use AppBundle\Form\ImageType;
use Symfony\Component\HttpFoundation\Request;

class AddImageController extends Controller
{
    /**
     * @Route("/AddImage", name="add_image")
     */
    public function AddImageAction(Request $request)
    {
        $image=new Image();

        $last_username=$this->getUser()->getUsername();

        $User=$this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findOneBy( array('username' => $last_username));



        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



            $file = $image->getPath();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();




            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $image->setName($fileName);

            $image->setPath("images/{$fileName}");

            $image->setDate(new \DateTime("now"));

            $image->user=$User;
            echo $User->getUsername();
            $em = $this->getDoctrine()->getManager();

            $em->persist($image);
            $em->flush();

            return $this->redirect($this->generateUrl('page'));
        }

        return $this->render('@App/AddImage/add_image.html.twig', array(
            'form' => $form->createView(),
            'last_username' => $last_username,
        ));
    }

}
