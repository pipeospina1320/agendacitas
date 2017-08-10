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
    public function indexAction() {

        $arUsuario = new \SeguridadBundle\Entity\User();
        $arUsuario = $this->getUser();
        if ($arUsuario->getCambiarClave()) {
            return $this->redirectToRoute('usuario_cambiar_clave', array('codigoUsuario' => $arUsuario->getId()));
        }
        return $this->render('SeguridadBundle:Default:index.html.twig');
    }

}