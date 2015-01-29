<?php

namespace HROM\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HROMUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
