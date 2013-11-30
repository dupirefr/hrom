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
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMContactsBundle:Contact');

        $committee = $repository->findByRole('ROLE_COMMITTEE');
        
        usort($committee, 'HROM\ContactsBundle\Validator\ExistingCommitteeRole::precedence');

        return $this->render('HROMContactsBundle:Contact:contactus.html.twig', array(
            'committee' => $committee,
            'committeeRolesArray' => ExistingCommitteeRole::getAuthorizedRoles()
        ));
    }
}

?>
