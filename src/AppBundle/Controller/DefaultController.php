<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Image;
use Symfony\Component\HttpFoundation\Response;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/add_user", name="adding_user_row")
     */
    public function createAction()
    {
        $User = new User();
        $User->setEmail('jas@o2.pl');
        $User->setPassword('1234');

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($User);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new product with id '.$User->getId());
    }

    /**
     * @Route("/add_image", name="adding_image_row")
     */
    public function createImageAction()
    {
        $Image = new Image();
        $Image->setName('mem');
        $Image->setPath('ImageService/images/mem.jpg');
        $Image->setDate('13.10.2016');

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($Image);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new product with id '.$Image->getId());
    }

    /**
     * @Route("/display_image", name="displaying image")
     */
    public function showAction()
    {
        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->find(1);

        if (!$user) {
            throw $this->createNotFoundException(
                'No product found'
            );
        }

        return $this->render('image.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}
