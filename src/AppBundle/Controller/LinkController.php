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
     * @Rest\Post("/link")
     * @Rest\View
     * @ParamConverter("link", converter="fos_rest.request_body")
     */
    public function createAction(Link $link)
    {
        dump($link); die;
    }
}