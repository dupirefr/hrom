<?php
namespace HROM\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\Configuration;

/**
 * Controller for showing news.
 *
 * @author François Dupire
 */
class NewsController extends Controller {
    /**
     * Shows last news
     */
    public function lastAction() {
	$repository = $this->getDoctrine()->getManager()->getRepository('HROMNewsBundle:News');
        
        $limit = Configuration::INDEX_NEWS;
        
        $newsList = $repository->findBy(array(), array('instant' => 'desc'), $limit);
        
        return $this->render('HROMNewsBundle:News:last.html.twig', array('newsList' => $newsList));
    }
    
    /**
     * Shows last news titles
     */
    public function overviewAction() {
	$repository = $this->getDoctrine()->getManager()->getRepository('HROMNewsBundle:News');
        
        $limit = Configuration::INDEX_NEWS;
        
        $newsList = $repository->findBy(array(), array('instant' => 'desc'), $limit);
        
        return $this->render('HROMNewsBundle:News:overview.html.twig', array('newsList' => $newsList));
    }
    
    /**
     * Shows news list
     */
    public function allAction($page) {
	$repository = $this->getDoctrine()->getManager()->getRepository('HROMNewsBundle:News');
        
        $limit = Configuration::NEWS_PER_PAGE;

        $newsList = $repository->findBy(array(), array('instant' => 'desc'), $limit, ($page - 1)*$limit);
        
        $newsCount = $repository->count();
        $pageCount = ceil($newsCount / $limit);
        
        return $this->render('HROMNewsBundle:News:all.html.twig', array('newsList' => $newsList, 'pageCount' => $pageCount));
    }
}

?>
