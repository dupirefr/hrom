<?php
namespace HROM\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\Configuration;

/**
 * Controller for showing and managing news.
 *
 * @author François Dupire <dupire.francois@gmail.com>
 */
class NewsController extends Controller {
    public function lastAction() {
	$repository = $this->getDoctrine()->getManager()->getRepository('HROMNewsBundle:News');
        
        $limit = Configuration::INDEX_NEWS;
        
        $newsList = $repository->findBy(array(), array('instant' => 'desc'), $limit);
        
        return $this->render('HROMNewsBundle:News:last.html.twig', array('newsList' => $newsList));
    }
    
    public function oversightAction() {
	$repository = $this->getDoctrine()->getManager()->getRepository('HROMNewsBundle:News');
        
        $limit = Configuration::INDEX_NEWS;
        
        $newsList = $repository->findBy(array(), array('instant' => 'desc'), $limit);
        
        return $this->render('HROMNewsBundle:News:oversight.html.twig', array('newsList' => $newsList));
    }
    
    public function allAction($page) {
	$repository = $this->getDoctrine()->getManager()->getRepository('HROMNewsBundle:News');
        
        $limit = Configuration::NEWS_PER_PAGE;

        $newsList = $repository->findBy(array(), array('instant' => 'desc'), $limit, ($page - 1)*$limit);
        
        $newsCount = $repository->count();
        $pageCount = max(floor($newsCount / $limit), 1);
        
        return $this->render('HROMNewsBundle:News:all.html.twig', array('newsList' => $newsList, 'pageCount' => $pageCount));
    }
}

?>
