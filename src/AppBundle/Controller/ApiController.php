<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\View;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use AppBundle\Form\RecordMoviesType;

class ApiController extends FOSRestController
{
    /**
     * @Rest\Get("videos")
     * @ApiDoc(
     *      section="Video Entity",
     *      description="Get all videos from database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllVideosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:RecordMovies')->findAll();
        if (count($entities) > 0)
        {
            $view = $this->view(array(
                            "videos" => $entities,
                            "count" => count($entities),
            ),200);
            $view->setFormat("json");
        }
        else
        {
            $view = $this->view(array(
                            "Aucune video" => $entities
            ),204);
            $view->setFormat("json");
        }

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("video/{id}")
     * @ApiDoc(
     *      section="Video Entity",
     *      description="Get video by id from database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the video instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getVideoByIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("AppBundle:RecordMovies")->findOneById($id);
        if ($entity)
        {
            $view = $this->view(array(
                            "video" => $entity
            ),200);
            $view->setFormat("json");
        }
        else
        {
            $view = $this->view(array(
                            "Aucune video" => $entity
            ),204);
            $view->setFormat("json");
        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Get("video/{realisator}")
     * @ApiDoc(
     *      section="Video Entity",
     *      description="Get videos by realisator from database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param string $realisator of the video instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getVideosByRealisatorAction($realisator)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository("AppBundle:RecordMovies")->findByRealisator($realisator);
        if ($entities)
        {
            $view = $this->view(array(
                            "videos" => $entities
            ),200);
            $view->setFormat("json");
        }
        else
        {
            $view = $this->view(array(
                            "Aucune video" => $entities
            ),204);
            $view->setFormat("json");
        }
        return $this->handleView($view);
    }

    /**
     * @Rest\Get("videos/{from}/{to}")
     * @ApiDoc(
     *      section="Video Entity",
     *      description="Get videos between two date from database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param string $from Start date of the video instance.
     * @param string $to End date of the video instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getVideosBetweenDatesAction($from, $to)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository("AppBundle:RecordMovies")->getByDates($from, $to);
        if ($entities)
        {
            $view = $this->view(array(
                            "videos" => $entities
            ),200);
            $view->setFormat("json");
        }
        else
        {
            $view = $this->view(array(
                            "Aucune video" => $entities
            ),204);
            $view->setFormat("json");
        }
        return $this->handleView($view);
    }
}