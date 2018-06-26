<?php
/**
 * Created by PhpStorm.
 * User: Pierre-Yves
 * Date: 23/06/2018
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Link;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;

class LinkController extends FOSRestController
{
    /**
     * @Get(
     *     path = "/link/{id}",
     *     name = "app_link_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function showAction(Link $link)
    {
        return $link;
    }


    /**
     * @Rest\Get("/links", name="app_link_list")
     * @View
     */
    public function listAction()
    {
        $links = $this->getDoctrine()->getRepository('AppBundle:Link')->findAll();
        
        return $links;
    }

    /**
     * @Rest\Post(
     *    path = "/links",
     *    name = "app_link_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("link", converter="fos_rest.request_body")
     */
    public function createAction(Link $link)
    {
        $em = $this->getDoctrine()->getManager();

        $em->persist($link);
        $em->flush();

        return $link;
    }

    /**
     * @Rest\Delete(
     *     path = "/link/{id}",
     *     name = "app_link_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function deleteAction(Link $link)
    {
        $id = $link->getId();
        if (!$link->getId()) {
            return 'The link does not exist';
        }
        $em = $this->getDoctrine()->getManager();

        $em->remove($link);
        $em->flush();

        return 'The id '.$id.' has been removed';
    }

    /**
     * @Rest\Put(
     *     path = "/link/{id}",
     *     name = "app_link_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function updateAction(Link $link)
    {
        return $link;
    }

}