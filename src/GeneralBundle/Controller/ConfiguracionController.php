<?php

namespace GeneralBundle\Controller;

use GeneralBundle\Entity\Configuracion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ConfiguracionController extends Controller
{
    /**
     * Lists all configuracion entities.
     *
     * @Route("configuracion/", name="configuracion")
     * @Method("GET")
     */
    public function listaAction()
    {
        $em = $this->getDoctrine()->getManager();

        $configuracions = $em->getRepository('GeneralBundle:Configuracion')->findAll();

        return $this->render('GeneralBundle:Configuracion:index.html.twig', array(
            'configuracions' => $configuracions,
        ));
    }

    /**
     * Finds and displays a configuracion entity.
     *
     * @Route("configuracion/{codigoConfiguracionPk}", name="configuracion_show")
     * @Method("GET")
     */
    public function mostrarAction(Configuracion $configuracion)
    {

        return $this->render('GeneralBundle:Configuracion:show.html.twig', array(
            'configuracion' => $configuracion,
        ));
    }
}
