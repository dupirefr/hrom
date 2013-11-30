<?php
namespace HROM\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\Configuration;

use HROM\NewsBundle\Entity\News;
use HROM\NewsBundle\Form\NewsType;

/**
 * Controller for news management
 *
 * @author François Dupire
 */
class NewsAdminController extends Controller {
    /**
     * Handles news list demands
     */
    public function listAction($page) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMNewsBundle:News');

        $limit = Configuration::ADMIN_NEWS_PER_PAGE;

        $newsList = $repository->findBy(array(), array('instant' => 'desc'), $limit, ($page - 1)*$limit);

        $newsCount = $repository->count();
        $pageCount = ceil($newsCount / $limit);

        return $this->render('HROMNewsBundle:NewsAdmin:list.html.twig', array('newsList' => $newsList, 'pageCount' => $pageCount));
    }
    
    /**
     * Handles news addition demands
     */
    public function addAction() {
        $news = new News($this->getUser());

        $form = $this->createForm(new NewsType(), $news);

        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($news);
                $em->flush();

                $session = $this->get('session');
                $session->getFlashBag()->add('succeed', 'La news a bien été ajoutée.');

                return $this->redirect($this->generateUrl('news_list'));
            }
        }

        return $this->render('HROMNewsBundle:NewsAdmin:add.html.twig', array('form' => $form->createView(), 'actionRoute' => 'news_add'));
    }
    
    /**
     * Handles news modification demands
     */
    public function editAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMNewsBundle:News');
        $news = $repository->find($id);

        $form = $this->createForm(new NewsType(), $news);

        $request = $this->getRequest();

        if($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($news);
                $em->flush();

                $session = $this->get('session');
                $session->getFlashBag()->add('succeed', 'La news a bien été modifiée.');

                return $this->redirect($this->generateUrl('news_list'));
            }
        }

        return $this->render('HROMNewsBundle:NewsAdmin:edit.html.twig', array('form' => $form->createView(), 'actionRoute' => 'news_edit'));
    }
    
    /**
     * Handles news deletion demands
     */
    public function deleteAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMNewsBundle:News');
        $news = $repository->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($news);
        $em->flush();

        $session = $this->get('session');
        $session->getFlashBag()->add('succeed', 'La news a bien été supprimée.');

        return $this->redirect($this->generateUrl('news_list'));
    }
}

?>
