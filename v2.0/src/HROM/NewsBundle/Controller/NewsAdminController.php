<?php
namespace HROM\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\Configuration;

use HROM\NewsBundle\Entity\News;
use HROM\NewsBundle\Form\NewsType;

/**
 * Controller for showing and managing news.
 *
 * @author François Dupire <dupire.francois@gmail.com>
 */
class NewsAdminController extends Controller {
    public function listAction($page) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMNewsBundle:News');

        $limit = Configuration::ADMIN_NEWS_PER_PAGE;

        $newsList = $repository->findBy(array(), array('instant' => 'desc'), $limit, ($page - 1)*$limit);

        $newsCount = $repository->count();
        $pageCount = max(floor($newsCount / $limit), 1);

        return $this->render('HROMNewsBundle:NewsAdmin:list.html.twig', array('newsList' => $newsList, 'pageCount' => $pageCount));
    }
    
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
