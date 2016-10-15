<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SignUpController extends Controller
{
    /**
     * @Route("/SignUp", name="signup")
     */
    public function SignUpAction()
    {
        return $this->render('AppBundle:SignUpController:sign_up.html.twig', array(
            // ...
        ));
    }

}
