<?php

namespace HROM\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controller for website main page
 * 
 * @author François Dupire
 */
class CoreController extends Controller {
    /**
     * Handles root requests
     */
    public function rootAction()
    {
        return $this->redirect($this->generateUrl('home'));
    }
	
    /**
     * Handles main page requests
     */
    public function indexAction()
    {
        return $this->render('HROMCoreBundle:Core:index.html.twig');
    }
}
