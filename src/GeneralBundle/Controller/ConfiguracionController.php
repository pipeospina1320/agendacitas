<?php

namespace GeneralBundle\Controller;

use GeneralBundle\Entity\Configuracion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ConfiguracionController extends Controller {

    /**
     * Lists all configuracion entities.
     *
     * @Route("configuracion/", name="configuracion")
     * @Method("GET")
     */
    public function listaAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $arConfiguracion = new \GeneralBundle\Entity\Configuracion();
        
        $arConfiguracion = $em->getRepository('GeneralBundle:Configuracion')->find(1);
        
        $arConfiguracion = $this->createFormBuilder()
                ->add('nitEmpresa', TextType::class, array('data' => $arConfiguracion->getNitEmpresa(), 'required' => true))
                ->add('nombreComercial', TextType::class, array('data' => $arConfiguracion->getNombreComercial(), 'required' => true ))
                ->getForm();

        return $this->render('GeneralBundle:Configuracion:configuracion.html.twig', array(
                    'arConfiguracion' => $arConfiguracion->createView(),
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
        $periodoActual =  $arCierre->setPeriodoActual((new \DateTime('now'))->format('Ym'));
        $periodoActual = $arCierre->getPeriodoActual();
        $form = $this->formularioDetalle($arCierre);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                if ($form->get('BtnCerrarPeriodo')->isClicked()) {
                    $arrControles = $request->request->All();
                    $periodoActual = $arrControles['TxtPeriodo'];
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
