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
        $cursusRepository = $this->getDoctrine()->getManager()->getRepository('HROMCursusBundle:Cursus');

        $committee = $contactRepository->findKeyCommitteeMembers();
        
        $cursusList = $cursusRepository->findBy(array(), array('name' => 'asc'));
        
        $director = $contactRepository->findByRole('ROLE_DIRECTOR');
        
        $webmaster = $contactRepository->findByRole('ROLE_WEBMASTER');
        
        usort($committee, 'HROM\ContactsBundle\Validator\ExistingCommitteeRole::precedence');

        return $this->render('HROMContactsBundle:Contact:contactus.html.twig', array(
            'committee' => $committee,
            'committeeRolesArray' => ExistingCommitteeRole::getAuthorizedRoles(),
            'director' => $director,
            'cursusList' => $cursusList,
            'webmaster' => $webmaster
        ));
    }
}

?>
