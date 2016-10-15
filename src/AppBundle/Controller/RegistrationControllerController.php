<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RegistrationControllerController extends Controller
{
    /**
     * @Route("/Registration", name="registration")
     */
    public function RegistrationAction()
    {
        return $this->render('AppBundle:RegistrationController:registration.html.twig', array(
            // ...
        ));
    }

}
