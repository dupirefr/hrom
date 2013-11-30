<?php

namespace HROM\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HROM\Configuration;

/**
 * Controller for showing albums and photos/videos
 */
class GalleryController extends Controller
{
    /**
     * Shows albums list
     */
    public function allAction($page)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('HROMGalleryBundle:Album');

        $limit = Configuration::ALBUM_COLS_PER_PAGE * Configuration::ALBUM_ROWS_PER_PAGE;

        $albumList = $repository->findBy(array(), array('year' => 'desc', 'name' => 'asc'), $limit, ($page - 1)*$limit);

        $albumCount = $repository->count();
        $pageCount = ceil($albumCount / $limit);

        return $this->render('HROMGalleryBundle:Gallery:all.html.twig', array(
            'albumList' => $albumList,
            'albumCols' => Configuration::ALBUM_COLS_PER_PAGE,
            'pageCount' => $pageCount)
        );
    }
    
    /**
     * Shows selected album
     */
    public function selectAction($id)
    {
        $album = $this->getDoctrine()->getManager()->find('HROMGalleryBundle:Album', $id);
        
        return $this->render('HROMGalleryBundle:Gallery:album.html.twig', array('album' => $album));
    }
}
