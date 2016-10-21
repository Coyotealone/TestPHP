<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MainController extends Controller
{
    public function indexAction(Request $request)
    {
        // redirect to the "AppBundle_api" route
        return new RedirectResponse($this->generateUrl('nelmio_api_doc_index'));
        return $this->redirectToRoute('NelmioApiDocBundle');
    }
}