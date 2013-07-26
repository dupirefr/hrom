<?php

namespace HROM\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author François Dupire <dupire.francois@gmail.com>
 */
class CoreController extends Controller {
	public function rootAction() {
		return $this->redirect($this->generateUrl("home"));
	}
	
    public function indexAction() {
        return $this->render('HROMCoreBundle:Core:index.html.twig');
    }
    
    public function schoolAction() {
        return $this->render('HROMCoreBundle:Core:school.html.twig');
    }
    
    public function calendarAction() {
        return $this->render('HROMCoreBundle:Core:calendar.html.twig');
    }
    
    public function galleryAction() {
        return $this->render('HROMCoreBundle:Core:gallery.html.twig');
    }
    
    public function contactUsAction() {
        return $this->render('HROMCoreBundle:Core:contact_us.html.twig');
    }
    
    public function linksAction() {
        return $this->render('HROMCoreBundle:Core:links.html.twig');
    }
}
