<?php

namespace HROM\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller {
    public function indexAction() {
        return $this->render('HROMAdminBundle:Admin:index.html.twig');
    }
    
    public function addNewsAction() {
	$request = $this->getRequest();
	
	if($request->getMethod() == 'GET') {
	    return $this->render('HROMAdminBundle:News:addNews.html.twig');
	    
	} else {
	    
	}
    }
}
