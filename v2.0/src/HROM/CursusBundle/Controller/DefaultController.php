<?php

namespace HROM\CursusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HROMCursusBundle:Default:index.html.twig', array('name' => $name));
    }
}
