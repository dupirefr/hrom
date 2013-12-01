<?php
namespace HROM\ContactsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\ContactsBundle\Validator\ExistingCommitteeRole;

/**
 * Controller for showing contacts
 *
 * @author François Dupire
 */
class ContactController extends Controller {
    /**
     * Handles contact_us page requests
     */
    public function contactUsAction() {
        $contactRepository = $this->getDoctrine()->getManager()->getRepository('HROMContactsBundle:Contact');

        $contactsList = $contactRepository->findByRoles(array('ROLE_COMMITTEE', 'ROLE_TEACHER', 'ROLE_DIRECTOR', 'ROLE_WEBMASTER'));
        
        $committee = array();
        $teachers = array();
        
        foreach($contactsList as $contact) {
            if(in_array('ROLE_COMMITTEE', $contact->getRoles()) && $contact->getCommitteeRole() != 'ROLE_COMM_MEMBER') {
                $committee[] = $contact;
            }
            
            if(in_array('ROLE_TEACHER', $contact->getRoles()))  {
                $teachers[] = $contact;
            }
            
            if(in_array('ROLE_DIRECTOR', $contact->getRoles())) {
                $director = $contact;
            }
            
            if(in_array('ROLE_WEBMASTER', $contact->getRoles())) {
                $webmaster = $contact;
            }
        }
        
        usort($committee, 'HROM\ContactsBundle\Validator\ExistingCommitteeRole::precedence');

        return $this->render('HROMContactsBundle:Contact:contactus.html.twig', array(
            'committee' => $committee,
            'committeeRolesArray' => ExistingCommitteeRole::getAuthorizedRoles(),
            'director' => $director,
            'teachers' => $teachers,
            'webmaster' => $webmaster
        ));
    }
}

?>
