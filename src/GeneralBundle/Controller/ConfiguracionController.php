<?php

namespace GeneralBundle\Controller;

use GeneralBundle\Entity\Configuracion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class ConfiguracionController extends Controller
{

    /**
     * Lists all configuracion entities.
     *
     * @Route("configuracion/", name="configuracion")
     * @Method("GET")
     */
    public function listaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $arConfiguracion = new \GeneralBundle\Entity\Configuracion();

        $arConfiguracion = $em->getRepository('GeneralBundle:Configuracion')->find(1);

        $arConfiguracion = $this->createFormBuilder()
            ->add('nitEmpresa', TextType::class, array('data' => $arConfiguracion->getNitEmpresa(), 'required' => true))
            ->add('nombreComercial', TextType::class, array('data' => $arConfiguracion->getNombreComercial(), 'required' => true))
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
    public function cierreAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $objMensaje = new\GeneralBundle\MisClases\Mensajes();
        $arCierre = $em->getRepository('GeneralBundle:Configuracion')->find(1);
        $periodoCierre = $arCierre->setPeriodoActual((new \DateTime('now'))->format('Ym'));
        $form = $this->formularioDetalle($arCierre);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                if ($form->get('BtnCerrarPeriodo')->isClicked()) {
                    $arrControles = $request->request->All();
                    $periodoCierre = $arrControles['TxtPeriodo'];
                    $respuesta = $em->getRepository('GeneralBundle:Configuracion')->cerrarPeriodo($periodoCierre);
                    if ($respuesta != "") {
                        $objMensaje->Mensaje("error", $respuesta);
                    }
                    return $this->redirect($this->generateUrl('cierre_periodo'));
                    //return $this->redirect($this->generateUrl('cierre_periodo', array('periodoCierre' => $periodoCierre)));
                }
            }
        }

        return $this->render('GeneralBundle:CierrePeriodo:cierre.html.twig', array(
            'arCierre' => $arCierre,
            'form' => $form->createView(),
        ));
    }

    private function formularioDetalle($ar)
    {

        $arrCerrarPeriodo = array('label' => 'Cerrar Perido', 'disabled' => false);

        $form = $this->createFormBuilder()
            ->add('BtnCerrarPeriodo', SubmitType::class, $arrCerrarPeriodo)
            ->getForm();
        return $form;
    }

}
