<?php

namespace HROM\ContactsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HROMContactsBundle:Default:index.html.twig', array('name' => $name));
    }
}
