<?php

namespace HROM\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\Configuration;

class GalleryController extends Controller {
    public function allAction($page) {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMGalleryBundle:Category');

        $limit = Configuration::CATEGORY_COLS_PER_PAGE * Configuration::CATEGORY_ROWS_PER_PAGE;

        $categoryList = $repository->findBy(array(), array('name' => 'asc'), $limit, ($page - 1)*$limit);

        $categoryCount = $repository->count();
        $pageCount = max(floor($categoryCount / $limit), 1);

        return $this->render('HROMGalleryBundle:Gallery:all.html.twig', array(
            'categoryList' => $categoryList,
            'categoryCols' => Configuration::CATEGORY_COLS_PER_PAGE,
            'pageCount' => $pageCount));
    }
    
    public function selectAction($page) {
        
    }
}
