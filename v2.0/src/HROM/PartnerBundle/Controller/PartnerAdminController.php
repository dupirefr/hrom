<?php
namespace HROM\PartnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\Configuration;

use HROM\PartnerBundle\Entity\Partner;
use HROM\PartnerBundle\Form\PartnerType;

/**
 * Controller for partners management
 *
 * @author François Dupire
 */
class PartnerAdminController extends Controller {
    /**
     * Handles partners list demands
     */
    public function listAction($page) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMPartnerBundle:Partner');

        $limit = Configuration::ADMIN_PARTNERS_PER_PAGE;

        $partnersList = $repository->findBy(array(), array('name' => 'asc'), $limit, ($page - 1)*$limit);

        $partnersCount = $repository->count();
        $pageCount = ceil($partnersCount / $limit);

        return $this->render('HROMPartnerBundle:PartnerAdmin:list.html.twig', array(
            'partnersList' => $partnersList,
            'pageCount' => $pageCount
        ));
    }
    
    /**
     * Handles partner addition demands
     */
    public function addAction() {
        $partner = new Partner();

        $form = $this->createForm(new PartnerType(), $partner);

        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($partner);
                $em->flush();

                $session = $this->get('session');
                $session->getFlashBag()->add('succeed', 'Le partenaire a bien été ajouté.');

                return $this->redirect($this->generateUrl('partners_list'));
            }
        }

        return $this->render('HROMPartnerBundle:PartnerAdmin:add.html.twig', array('form' => $form->createView(), 'actionRoute' => 'partner_add'));
    }
    
    /**
     * Handles partner modification demands
     */
    public function editAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMPartnerBundle:Partner');
        $partner = $repository->find($id);
        
        $form = $this->createForm(new PartnerType(), $partner);
        
        $request = $this->getRequest();
        if($request->isMethod('POST')) {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                
                $em->persist($partner);
                $em->flush();

                $session = $this->get('session');
                $session->getFlashBag()->add('succeed', 'Le partenaire a bien été modifié.');

                return $this->redirect($this->generateUrl('partners_list'));
            }
        }

        return $this->render('HROMPartnerBundle:PartnerAdmin:edit.html.twig', array('form' => $form->createView(), 'actionRoute' => 'partner_edit'));
    }
    
    /**
     * Handles partner deletion demands
     */
    public function deleteAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMPartnerBundle:Partner');
        $partner = $repository->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($partner);
        $em->flush();

        $session = $this->get('session');
        $session->getFlashBag()->add('succeed', 'Le partenaire a bien été supprimé.');

        return $this->redirect($this->generateUrl('partners_list'));
    }
}

?>
