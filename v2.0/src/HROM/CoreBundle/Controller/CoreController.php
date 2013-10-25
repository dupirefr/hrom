<?php

namespace HROM\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author François Dupire <dupire.francois@gmail.com>
 */
class CoreController extends Controller {
    public function rootAction()
    {
            return $this->redirect($this->generateUrl("home"));
    }
	
    public function indexAction()
    {
        return $this->render('HROMCoreBundle:Core:index.html.twig');
    }
}
