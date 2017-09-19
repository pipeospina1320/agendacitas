<?php

namespace GeneralBundle\Controller;

use GeneralBundle\Entity\Configuracion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ConfiguracionController extends Controller {

    /**
     * Lists all configuracion entities.
     *
     * @Route("configuracion/", name="configuracion")
     * @Method("GET")
     */
    public function listaAction() {
        $em = $this->getDoctrine()->getManager();
        $arConfiguracions = $em->getRepository('GeneralBundle:Configuracion')->findAll();


        return $this->render('GeneralBundle:Configuracion:index.html.twig', array(
                    'configuracions' => $arConfiguracions,
        ));
    }

    /**
     * Finds and displays a configuracion entity.
     *
     * @Route("configuracion/{codigoConfiguracionPk}", name="configuracion_show")
     * @Method("GET")
     */
    public function mostrarAction(Configuracion $configuracion) {

        return $this->render('GeneralBundle:Configuracion:show.html.twig', array(
                    'configuracion' => $configuracion,
        ));
    }

    /**
     * Finds and displays a configuracion entity.
     *
     * @Route("cierreperiodo/", name="cierre_periodo")
     * 
     */
    public function cierreAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $arCierre = new \GeneralBundle\Entity\Configuracion();
        
        $arCierre = $em->getRepository('GeneralBundle:Configuracion')->find(1);
        $periodoActual = $arCierre->getPeriodoActual();
        $form = $this->formularioDetalle($arCierre);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                if ($form->get('BtnCerrarPeriodo')->isClicked()) {
                    $arrControles = $request->request->All();
                    $em->getRepository('GeneralBundle:Configuracion')->cerrarPeriodo($periodoActual);
                    return $this->redirect($this->generateUrl('cierre_periodo'));
                }
                $em->persist($arFacturaDetalle);
                $em->flush();
            }
        }


        return $this->render('GeneralBundle:CierrePeriodo:cierre.html.twig', array(
                    'arCierre' => $arCierre,
                    'form' => $form->createView(),
        ));
    }

    private function formularioDetalle($ar) {

        $arrCerrarPeriodo = array('label' => 'Cerrar Perido', 'disabled' => false);


        $form = $this->createFormBuilder()
                ->add('BtnCerrarPeriodo', SubmitType::class, $arrCerrarPeriodo)
                ->getForm();
        return $form;
    }

}
