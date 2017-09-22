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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class FacturaController extends Controller {

    var $strDqlLista = "";
    var $strCodigo = "";
    var $strNombre = "";

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
                        $formaPago = $form->get('formaPagoRel')->getData();
                        $centroCosto = $form->get('centroCostoRel')->getData();
                        $arFactura->setFormaPagoRel($formaPago);
                        $arFactura->setCentroCostoRel($centroCosto);
//                        $fechaVencimiento = $arFactura->getFechaMovimiento();
                        $fechaVencimiento = $this->sumarDiasFecha($arFactura->getFormaPagoRel()->getPlazoDias(), $arFactura->getFechaMovimiento());
                        $arFactura->setFechaVencimiento($fechaVencimiento);
                        $dias = $arFactura->getFormaPagoRel()->getPlazoDias();
//                        var_dump($dias);
//                        exit;
                        $em->persist($arFactura);
                        $em->flush();

                        return $this->redirectToRoute('factura_detalle', array('codigoFactura' => $arFactura->getCodigoFacturaPk()));
                    } else {
                        echo "El cliente no existe";
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
    public function editarAction(Request $request, Factura $codigoFactura) {
        $editarFormulario = $this->createForm('FacturacionBundle\Form\FacturaType', $codigoFactura);
        $editarFormulario->handleRequest($request);

        if ($editarFormulario->isSubmitted() && $editarFormulario->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('factura_editar', array('codigofactura' => $codigoFactura->getCodigoFacturaPk()));
        }

        return $this->render('FacturacionBundle:Factura:editar.html.twig', array(
                    'factura' => $codigoFactura,
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
        $arArticulo = new \InventarioBundle\Entity\Articulo();
        $arFactura = $em->getRepository('FacturacionBundle:Factura')->find($codigoFactura);
        $form = $this->formularioDetalle($arFactura);
        if ($codigoFactura != 0) {
            $arFacturaDetalle = $em->getRepository('FacturacionBundle:FacturaDetalle')->find($codigoFactura);
        } else {
            $arFacturaDetalle->setFacturaRel($arFactura);
        }
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                if ($form->get('BtnEliminarDetalle')->isClicked()) {
                    $arrSeleccionados = $request->request->get('ChkSeleccionar');
                    $em->getRepository('FacturacionBundle:FacturaDetalle')->eliminarSeleccionados($arrSeleccionados, $codigoFactura);
//                    return $this->render('FacturacionBundle:Factura:detalle.html.twig', array('codigoFactura' => $codigoFactura));
//                    return $this->redirect($this->generateUrl('factura_detalle', array('codigoFactura' => $codigoFactura)));
                }
                if ($form->get('BtnAddArticulo')->isClicked()) {
                    $arrControles = $request->request->All();
                    $this->addArticulo($arrControles, $codigoFactura);
//                    return $this->redirect($this->generateUrl('factura_detalle', array('codigoFactura' => $codigoFactura)));
                }
                if ($form->get('BtnImprimir')->isClicked()) {
                    $objFactura = new \FacturacionBundle\Formatos\Factura1();
                    $objFactura->Generar($em, $codigoFactura);
                }
//
//                $em->persist($arFacturaDetalle);
//                $em->flush();
//                return $this->redirectToRoute('factura_lista', array('codigoFactura' => $arFacturaDetalle->getCodigoFacturaFk()));
            }
        }
        $arFacturaDetalle = new \FacturacionBundle\Entity\FacturaDetalle();
        $arFacturaDetalle = $em->getRepository('FacturacionBundle:FacturaDetalle')->findBy(array('codigoFacturaFk' => $codigoFactura));

        return $this->render('FacturacionBundle:Factura:detalle.html.twig', array(
                    'arFactura' => $arFactura,
                    'arFacturaDetalle' => $arFacturaDetalle,
                    'arArticulo' => $arArticulo,
                    'form' => $form->createView(),));
    }

    private function formularioDetalle($ar) {
        $arrBotonDetalleActualizar = array('label' => 'Guardar', 'disabled' => false);
        $arrBotonEliminar = array('label' => 'Eliminar', 'disabled' => false);
        $arrBotonImprimir = array('label' => 'Imprimir', 'disabled' => false);

//        if ($ar->getEstadoAutorizado() == 1) {
//            $arrBotonAutorizar['disabled'] = true;
//            $arrBotonEliminar['disabled'] = true;
//            $arrBotonDetalleActualizar['disabled'] = true;
//        } else {
//            $arrBotonDesAutorizar['disabled'] = true;
//            $arrBotonImprimir['disabled'] = true;
//        }
        $form = $this->createFormBuilder()
                ->add('BtnAddArticulo', SubmitType::class, $arrBotonDetalleActualizar)
                ->add('BtnEliminarDetalle', SubmitType::class, $arrBotonEliminar)
                ->add('BtnImprimir', SubmitType::class, $arrBotonImprimir)
                ->getForm();
        return $form;
    }

    public function sumarDiasFecha($intDias, $dateFecha) {
        $fecha = $dateFecha->format('Y-m-j');
        $nuevafecha = strtotime('+' . $intDias . ' day', strtotime($fecha));
        $nuevafecha = date('Y-m-j', $nuevafecha);
        $dateNuevaFecha = date_create($nuevafecha);
        return $dateNuevaFecha;
    }

    private function filtrar($form) {
        $this->strNombre = $form->get('TxtNombreArticulo')->getData();
        $this->strCodigo = $form->get('TxtCodigoArticulo')->getData();
    }

    private function lista() {
        $em = $this->getDoctrine()->getManager();
        $this->strDqlLista = $em->getRepository('InventarioBundle:Articulo')->listaDQL(
                $this->strNombre, $this->strCodigo
        );
    }

    private function addArticulo($arrControles, $codigoFactura) {
        $em = $this->getDoctrine()->getManager();
        $arFactura = new \FacturacionBundle\Entity\Factura();
        $arFactura = $em->getRepository('FacturacionBundle:Factura')->find($codigoFactura);

        // codigo articulo
        $codigo = $arrControles['TxtCodigoArticulo'];
        $cantidad = $arrControles['TxtCantidad'];
        $fecha = $arFactura->getFechaMovimiento();
        $periodo = $arFactura->getFechaMovimiento()->format('Ym');
        $periodoAnterior = $periodo - 1;
        $cierre = new \InventarioBundle\Entity\SaldosArticulos();
        $cierre = $em->getRepository('InventarioBundle:SaldosArticulos')->findOneBy(array('codigoArticuloFk' => $codigo, 'periodo' => $periodoAnterior));
        if ($cierre == null) {
            echo "cierre el periodo anterior de inventario";
        } else {

            if ($arFactura->getComprobanteRel()->getSuma() == 1) {
                $respuesta = $em->getRepository('FacturacionBundle:FacturaDetalle')->validarEntrada($codigoFactura, $codigo);
            } else {
                $arFactura->getComprobanteRel()->getResta();
                $respuesta = $em->getRepository('FacturacionBundle:FacturaDetalle')->validarSalida($periodo, $codigo, $cantidad, $fecha);
            }
            if ($respuesta != "") {
                echo $respuesta;
            } else {
                $arMovimientoDetalle = new \FacturacionBundle\Entity\FacturaDetalle();
                $arArticulo = new \InventarioBundle\Entity\Articulo();
                if ($arrControles['TxtCodigoArticulo'] != '') {
                    $codigo = $arrControles['TxtCodigoArticulo'];
                    $arArticulo = $em->getRepository('InventarioBundle:Articulo')->find($codigo);
                    $arFactura = $em->getRepository('FacturacionBundle:Factura')->find($codigoFactura);
                    $cantidad = $arrControles['TxtCantidad'];
                    $vrUnitario = $arrControles['VrUnitario'];
                    $dscto = $arrControles['PorDscto'];
                    $subTotalUnitario = $arrControles['SubTotalUnitario'];
                    $totalNeto = $arrControles['TotalNeto'];
                    $arMovimientoDetalle->setFacturaRel($arFactura);
                    $arMovimientoDetalle->setArticuloRel($arArticulo);
                    $arMovimientoDetalle->setCantidad($cantidad);
                    $arMovimientoDetalle->setVrUnitario($vrUnitario);
                    $arMovimientoDetalle->setPorDscto($dscto);
                    $arMovimientoDetalle->setPorIva($arMovimientoDetalle->getArticuloRel()->getTarifaIvaRel()->getPorcentajeIva());
                    $em->persist($arMovimientoDetalle);

                    $em->flush();
                    $em->getRepository('FacturacionBundle:FacturaDetalle')->liquidar($codigoFactura);
                    if ($arArticulo->getManejaKardex() == 1) {
                        $em->getRepository('InventarioBundle:KardexArticulo')->ingresarMovimiento($codigoFactura, $codigo, $arMovimientoDetalle);
                    }
                }
            }
        }
    }

}
