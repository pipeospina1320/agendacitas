<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class CitasController {

    /**
     * @Route("/citas")
     */
    public function ShowAction() 
    {
     
        return new Response("hola");
    }

}
