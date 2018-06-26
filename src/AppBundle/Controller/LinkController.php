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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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
     *     name = "app_link_delete",
     *     requirements = {"id"="\d+"}
     * )
     * @View(statusCode=Response::HTTP_NO_CONTENT)
     */
    public function deleteAction(Link $link)
    {
        $em = $this->getDoctrine()->getManager();
        $link_id = $em->getRepository('AppBundle:Link')->find($link->get('id'));
        $em->remove($link);
        $em->flush();

        return 'The id '.$link_id.' has been removed';
    }

    /**
     * @Rest\View(StatusCode = 200)
     * @Rest\Put(
     *     path = "/link/{id}",
     *     name = "app_link_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newlink", converter="fos_rest.request_body",
     *     options={
     *         "validator"={ "groups"="Update" }
     *     })
     */
    public function updateAction(Link $link, Link $newlink)
    {

        $em = $this->getDoctrine()->getManager();
        $link->setLink($newlink->getLink());
        $link->setBookmark($newlink->getBookmark());
        $link->setType($newlink->getType());

        $this->getDoctrine()->getManager()->flush();

        return $link;
    }



}