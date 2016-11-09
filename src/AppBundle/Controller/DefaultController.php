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
     * @Route("/add_image", name="ImageAdding")
     */
    public function createImageAction()
    {
        $em = $this->getDoctrine()->getManager();

        $el = $this->getDoctrine()->getRepository('AppBundle:User');
        $user=$el->findOneById(2);

        $Image = new Image();
        $Image->setName('mem');
        $Image->setPath('images/mem.jpg');
        $Image->setDate(new \DateTime("now"));
        $Image->user=$user;

        $Image2 = new Image();
        $Image2->setName('mem2');
        $Image2->setPath('images/mem2.jpg');
        $Image2->setDate(new \DateTime("now"));
        $Image2->user=$user;

        $em->persist($Image);
        $em->persist($Image2);
        $em->flush();

        return new Response('Last image id: '.$Image2->getId());
    }

    /**
     * @Route("/add_user", name="UserAdding")
     */
    public function createDefaultUserAction()
    {
        $User = new User();
        $User->setEmail('ja21s@o2.pl');
        $User->setPassword('admin1');
        $User->setUsername('admin1');

        $em = $this->getDoctrine()->getManager();

        $em->persist($User);

        $em->flush();

        return new Response('Saved new user with id '.$User->getId());
    }
}
