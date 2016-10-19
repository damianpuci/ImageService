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
        return $this->render('base.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }



    /**
     * @Route("/add_image", name="adding_image_row")
     */
    public function createImageAction()
    {
        $em = $this->getDoctrine()->getManager();

        $Image = new Image();
        $Image->setName('mem');
        $Image->setPath('images/mem.jpg');
        $Image->setDate(new \DateTime("now"));

        $Image2 = new Image();
        $Image2->setName('mem2');
        $Image2->setPath('images/mem2.jpg');
        $Image2->setDate(new \DateTime("now"));

        $em->persist($Image);
        $em->persist($Image2);
        $em->flush();

        return new Response('Last image id: '.$Image2->getId());
    }

    /**
     * @Route("/add_user", name="adding_user_row")
     */
    public function createDefaultUserAction()
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
}
