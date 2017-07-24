<?php

namespace CitasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class CitasController extends Controller
{
    /**
     * @Route("/citas")
     */
    public function indexAction()
    {
        return $this->render('CitasBundle:Citas:Lista.html.twig');
    }
}
