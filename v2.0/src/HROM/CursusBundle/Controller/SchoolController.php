<?php

namespace HROM\CursusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controller for showing school information
 * 
 * @author François Dupire
 */
class SchoolController extends Controller
{
    /**
     * Shows school page
     */
    public function schoolAction() {
        $contactRepository = $this->getDoctrine()->getManager()->getRepository('HROMContactsBundle:Contact');

        $teachers = $contactRepository->findTeachers();
        
        return $this->render('HROMCursusBundle:School:school.html.twig', array(
            'teachers' => $teachers
        ));
    }
}
