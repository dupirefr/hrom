<?php

namespace HROM\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controller for administration main panel
 * 
 * @author François Dupire
 */
class AdminController extends Controller {
    public function indexAction() {
        return $this->render('HROMAdminBundle:Admin:index.html.twig');
    }
}
