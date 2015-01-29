<?php

namespace HROM\WebmasterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WebmasterController extends Controller
{
    public function indexAction()
    {
        return $this->render('HROMWebmasterBundle:Webmaster:index.html.twig');
    }
}
