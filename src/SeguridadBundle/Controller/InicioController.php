<?php

namespace SeguridadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class InicioController extends Controller {

    /**
     * Lists all cita entities.
     *
     * @Route("/", name="index")
     * @Method("GET")
     */
    public function inicioAction() {
        return $this->render('SeguridadBundle:Default:index.html.twig');
    }
    

}
