<?php

namespace CitasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class LoginController extends Controller {

    /**
     * Lists all cita entities.
     *
     * @Route("index/", name="index")
     * @Method("GET")
     */
    public function calendarioAction() {
        $em = $this->getDoctrine()->getManager();
        $calendario = $em->getRepository('CitasBundle:Citas')->findAll();
        return $this->render('CitasBundle:Default:index.html.twig', array(
                    'calendario' => $calendario,
        ));
    }
    
    
    /**
     * Lists all cita entities.
     *
     * @Route("/", name="login")
     * @Method("GET")
     */
    public function loginAction() {
        $em = $this->getDoctrine()->getManager();
        $login = $em->getRepository('CitasBundle:Usuario')->findAll();
        return $this->render('CitasBundle:Default:login.html.twig', array(
                    'login' => $login,
        ));
    }

}
