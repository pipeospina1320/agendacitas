<?php

namespace FacturacionBundle\Controller;

use FacturacionBundle\Entity\Factura;
use FacturacionBundle\Entity\FacturaDetalle;
use InventarioBundle\Controller\Buscar\ArticuloController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FacturaController extends Controller {

    /**
     * Lists all cita entities.
     *
     * @Route("factura/", name="factura_lista")
     * @Method("GET")
     */
    public function listaAction() {
        $em = $this->getDoctrine()->getManager();
        $arFactura = new \FacturacionBundle\Entity\Factura();
        $arFactura = $em->getRepository('FacturacionBundle:Factura')->findAll();

        return $this->render('FacturacionBundle:Factura:lista.html.twig', array(
                    'arFactura' => $arFactura,
        ));
    }

    /**
     * 
     * @Route("factura/nuevo/{codigoFactura}/{codigoMovimiento}", name="factura_nuevo")
     * @Method({"GET", "POST"})
     */
    public function nuevoAction(Request $request, $codigoFactura, $codigoMovimiento) {
        $em = $this->getDoctrine()->getManager();
        $arFactura = new \FacturacionBundle\Entity\Factura();

        if ($codigoFactura != 0) {
            $arFactura = $em->getRepository('FacturacionBundle:Factura')->find($codigoFactura);
        } else {
            $arFactura->setFechaMovimiento(new \DateTime('now'));
        }

        $form = $this->createForm('FacturacionBundle\Form\FacturaType', $arFactura);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $arrControles = $request->request->All();
                if ($arrControles['txtCedula'] != '') {
                    $arTercero = new \GeneralBundle\Entity\Cliente();
                    $arTercero = $em->getRepository('GeneralBundle:Cliente')->findOneBy(array('numDocumento' => $arrControles['txtCedula']));
                    if (count($arTercero) > 0) {

                        $arFactura->setClienteRel($arTercero);

                        $em->persist($arFactura);
                        $em->flush();

                        return $this->redirectToRoute('factura_detalle', array('codigoFactura' => $arFactura->getCodigoFacturaPk()));
                    } else {
                        
                    }
                } else {
                    echo "El campo cliente es obligatorio";
                }
            }
        }

        return $this->render('FacturacionBundle:Factura:nuevo.html.twig', array(
                    'arFactura' => $arFactura,
                    'form' => $form->createView(),
        ));
    }

    /**
     * 
     * @Route("factura/{codigoFactura}/editar", name="factura_editar")
     * @Method({"GET", "POST"})
     */
    public function editarAction(Request $request, Factura $factura) {
        $editarFormulario = $this->createForm('FacturacionBundle\Form\FacturaType', $factura);
        $editarFormulario->handleRequest($request);

        if ($editarFormulario->isSubmitted() && $editarFormulario->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('factura_editar', array('codigofactura' => $factura->getCodigoFacturaPk()));
        }

        return $this->render('FacturacionBundle:Factura:editar.html.twig', array(
                    'factura' => $factura,
                    'edit_form' => $editarFormulario->createView(),));
    }

    /**
     * 
     * @Route("factura/detalle/{codigoFactura}", name="factura_detalle")
     * 
     */
    public function facturaDetalleAction(Request $request, $codigoFactura) {
        $em = $this->getDoctrine()->getManager();
        $arFactura = new \FacturacionBundle\Entity\Factura();
        $arFactura = $em->getRepository('FacturacionBundle:Factura')->find($codigoFactura);
        $form = $this->formularioDetalle($arFactura);
        if ($codigoFactura != 0) {
            $arFacturaDetalle = $em->getRepository('FacturacionBundle:FacturaDetalle')->find($codigoFactura);
        } else {
            $arFacturaDetalle->setFacturaRel($arFactura);
        }
        $form = $this->createForm('FacturacionBundle\Form\FacturaDetalleType', $arFacturaDetalle);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {



                $em->persist($arFacturaDetalle);
                $em->flush();

                return $this->redirectToRoute('factura_lista', array('codigoFactura' => $arFacturaDetalle->getCodigoFacturaFk()));
            }
        }
        $arFacturaDetalle = new \FacturacionBundle\Entity\FacturaDetalle();
        $arFacturaDetalle = $em->getRepository('FacturacionBundle:FacturaDetalle')->findBy(array('codigoFacturaFk' => $codigoFactura));

        return $this->render('FacturacionBundle:Factura:detalle.html.twig', array(
                    'arFactura' => $arFactura,
                    'arFacturaDetalle' => $arFacturaDetalle,
                    'form' => $form->createView(),));
        }

//    /**
//     * @Route("factura/detalle/nuevo/{codigoFactura}", name="factura_detalle_nuevo")
//     * 
//     */
//    public function nuevoArticuloAction(Request $request, $codigoFactura) {
//        $em = $this->getDoctrine()->getManager();
//        $arFactura = new \FacturacionBundle\Entity\FacturaDetalle();
//        $arFactura = $em->getRepository('FacturacionBundle:Factura')->find($codigoFactura);
//        $form = $this->createFormBuilder()
//                ->add('BtnGuardar', SubmitType::class, array('label' => 'Guardar',))
//                ->getForm();
//        $form->handleRequest($request);
//        if ($form->isSubmitted()) {
//            if ($form->isValid()) {
//                if ($form->get('BtnGuardar')->isClicked()) {
//                    $arrSeleccionados = $request->request->get('ChkSeleccionar');
//                    $arrControles = $request->request->All();
//                    if (count($arrSeleccionados) > 0) {
//                        foreach ($arrSeleccionados AS $codigo) {
//                            $arArticulo = new \InventarioBundle\Entity\Articulo();
//                            $arArticulo = $em->getRepository('InventarioBundle:Articulo')->find($codigo);
//                            $arFacturaDetalle = new \FacturacionBundle\Entity\FacturaDetalle();
//                            $arFacturaDetalle->setFacturaRel($arFactura);
//                            $arFacturaDetalle->setArticuloRel($arArticulo);
//                            $arFacturaDetalle->setAfectaInventario($arArticulo->getAfectaInventario());
//                            $arFacturaDetalle->setOperacionInventario($arFacturaDetalle->getOperacionInventario());
//                            $arFacturaDetalle->setPorcentajeIva($arArticulo->getPorcentajeIva());
//                            $em->persist($arFacturaDetalle);
//                        }
//                        $em->persist($arFacturaDetalle);
//                        $em->flush();
//                    }
//                }
//                echo "<script languaje='javascript' type='text/javascript'>window.close();window.opener.location.reload();</script>";
//            }
//        }
//
//        $arArticulo = $em->getRepository('InventarioBundle:Articulo')->findAll();
//        return $this->render('FacturacionBundle:Factura:detalleNuevo.html.twig', array(
//                    'arArticulo' => $arArticulo,
//                    'form' => $form->createView()));
//    }

    private function formularioDetalle($ar) {
        $arrBotonAutorizar = array('label' => 'Autorizar', 'disabled' => false);
        $arrBotonDesAutorizar = array('label' => 'Desautorizar', 'disabled' => false);
        $arrBotonImprimir = array('label' => 'Imprimir', 'disabled' => false);
        $arrBotonDetalleActualizar = array('label' => 'Actualizar', 'disabled' => false);
        $arrBotonEliminar = array('label' => 'Eliminar', 'disabled' => false);
//        if ($ar->getEstadoAutorizado() == 1) {
//            $arrBotonAutorizar['disabled'] = true;
//            $arrBotonEliminar['disabled'] = true;
//            $arrBotonDetalleActualizar['disabled'] = true;
//        } else {
//            $arrBotonDesAutorizar['disabled'] = true;
//            $arrBotonImprimir['disabled'] = true;
//        }
        $form = $this->createFormBuilder()
                ->add('BtnAutorizar', SubmitType::class, $arrBotonAutorizar)
                ->add('BtnImprimir', SubmitType::class, $arrBotonImprimir)
                ->add('BtnDesAutorizar', SubmitType::class, $arrBotonDesAutorizar)
                ->add('BtnEliminarDetalle', SubmitType::class, $arrBotonEliminar)
                ->add('BtnDetalleActualizar', SubmitType::class, $arrBotonDetalleActualizar)
                ->getForm();
        return $form;
    }

}
