<?php
namespace HROM\PartnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\Configuration;

/**
 * Controller for showing partners
 *
 * @author François Dupire
 */
class PartnerController extends Controller {
    /**
     * Shows partners list
     */
    public function allAction($page) {
	$repository = $this->getDoctrine()->getManager()->getRepository('HROMPartnerBundle:Partner');
        
        $limit = Configuration::PARTNERS_PER_PAGE;

        $partnersList = $repository->findBy(array(), array('name' => 'asc'), $limit, ($page - 1)*$limit);
        
        $partnersCount = $repository->count();
        $pageCount = ceil($partnersCount / $limit);
        
        return $this->render('HROMPartnerBundle:Partner:all.html.twig', array('partnersList' => $partnersList, 'pageCount' => $pageCount));
    }
}

?>
