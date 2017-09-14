<?php

namespace FacturacionBundle\Repository;

/**
 * FacturaDetalleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FacturaDetalleRepository extends \Doctrine\ORM\EntityRepository {

    public function eliminarSeleccionados($arrSeleccionados, $codigoFactura) {
        if (count($arrSeleccionados) > 0) {
            $em = $this->getEntityManager();
            $em->getRepository('InventarioBundle:KardexArticulo')->eliminarMovimiento($arrSeleccionados, $codigoFactura);
            foreach ($arrSeleccionados AS $arrSeleccionados) {
                $arRegistro = $em->getRepository('FacturacionBundle:FacturaDetalle')->find($arrSeleccionados);

                $em->remove($arRegistro);
            }
            $em->flush();
            $this->liquidar($codigoFactura);
        }
    }

    public function liquidar($codigoFactura) {
        $em = $this->getEntityManager();
        $arFactura = new \FacturacionBundle\Entity\Factura();
        $arFactura = $em->getRepository('FacturacionBundle:Factura')->find($codigoFactura);
        $subtotal = 0;
        $dscto = 0;
        $iva = 0;
        $baseIva = 0;
        $total = 0;
        $retencionFuente = 0;
        $retencionIva = 0;
        $arFacturaDetalle = new \FacturacionBundle\Entity\FacturaDetalle();
        $arFacturaDetalle = $em->getRepository('FacturacionBundle:FacturaDetalle')->findBy(array('codigoFacturaFk' => $codigoFactura));
        foreach ($arFacturaDetalle as $arFacturaDetalle) {
            $arFacturaDetalleAct = new \FacturacionBundle\Entity\FacturaDetalle();
            $arFacturaDetalleAct = $em->getRepository('FacturacionBundle:FacturaDetalle')->find($arFacturaDetalle->getCodigoFacturaDetallePk());
            $subTotalUnitario = $arFacturaDetalle->getVrUnitario();
            $subtotalDetalle = $arFacturaDetalle->getVrUnitario() * $arFacturaDetalle->getCantidad();
            $descuento = 0;
            $dsctoUnitario = 0;
            if ($arFacturaDetalle->getporDscto() > 0) {
                $descuento = ($subtotalDetalle * $arFacturaDetalle->getPorDscto()) / 100;
                $dsctoUnitario = ($subTotalUnitario * $arFacturaDetalle->getPorDscto()) / 100;
            }
            $subTotalUnitario = $subTotalUnitario - $dsctoUnitario;
            $ivaUnitario = ($subTotalUnitario * ($arFacturaDetalle->getPorIva())) / 100;
            $totalUnitario = $subTotalUnitario + $ivaUnitario;
            $subtotalDetalle = $subtotalDetalle - $descuento;
            $ivaDetalle = ($subtotalDetalle * ($arFacturaDetalle->getPorIva())) / 100;
            $ivaDetalle = $ivaDetalle;
            $totalDetalle = $subtotalDetalle + $ivaDetalle;
            $totalDetalle = $totalDetalle;
            $arFacturaDetalleAct->setVrSubTotalUnitario($subTotalUnitario);
            $arFacturaDetalleAct->setVrTotalNetoUnitario($totalUnitario);
            $arFacturaDetalleAct->setVrSubTotal($subtotalDetalle);
            $arFacturaDetalleAct->setVrDscto($descuento);
            $arFacturaDetalleAct->setVrIva($ivaDetalle);
            $arFacturaDetalleAct->setVrTotalNeto($totalDetalle);
            $em->persist($arFacturaDetalleAct);

            $subtotal += $subtotalDetalle;
            $dscto += $descuento;
            $iva += $ivaDetalle;
            $total += $totalDetalle;
        }

        $subtotal = round($subtotal);
        $dscto = round($dscto);
        $iva = round($iva);
        $retencionFuente = round($retencionFuente);
        $retencionIva = round($retencionIva);
        $totalBruto = $subtotal - $dscto + $iva;
        $totalNeto = $subtotal + $iva - $retencionFuente - $retencionIva;
        $arFactura->setVrSubTotal($subtotal);
        $arFactura->setVrDscto($dscto);
        $arFactura->setVrIva($iva);
//        $arFactura->setvrBruto($totalBruto);
        $arFactura->setValorTotal($totalNeto);
        $em->persist($arFactura);
        $em->flush();
        return true;
    }

    public function validarEntrada($codigoMovimiento) {
        $em = $this->getEntityManager();
        $respuesta = "";
        //Valida si tiene registros
//        $validarNumeroRegistros = $em->getRepository('BrasaInventarioBundle:InvMovimientoDetalle')->numeroRegistros($codigoMovimiento);
//        if($validarNumeroRegistros <= 0) {
//            $respuesta = "El movimiento no tiene registros";            
//        }
        //Valida las cantidades
//        $validarCantidad = $em->getRepository('BrasaInventarioBundle:InvMovimientoDetalle')->validarCantidad($codigoMovimiento);
//        if($validarCantidad > 0) {
//            $respuesta = "Existen detalles con cantidad en cero";
//        }  
//        $validarLote = $em->getRepository('BrasaInventarioBundle:InvMovimientoDetalle')->validarLote($codigoMovimiento);
//        if($validarLote > 0) {
//            $respuesta = "Existen detalles sin lote";
//        }         
//        $validarBodega = $em->getRepository('BrasaInventarioBundle:InvMovimientoDetalle')->validarBodega($codigoMovimiento);
//        if($validarBodega > 0) {
//            $respuesta = "Existen detalles sin bodega o con codigo de bodega incorrecta";
//        }
        return $respuesta;
    }

    public function validarSalida($codigoMovimiento, $codigo, $cantidad) {
        $em = $this->getEntityManager();
        $respuesta = "";
//        //Valida si tiene registros
//        $validarNumeroRegistros = $em->getRepository('InventarioBundle:InvMovimientoDetalle')->numeroRegistros($codigoMovimiento);
//        if($validarNumeroRegistros <= 0) {
//            $respuesta = "El movimiento no tiene registros";            
//        }
//        //Valida las cantidades
//        $validarCantidad = $em->getRepository('BrasaInventarioBundle:InvMovimientoDetalle')->validarCantidad($codigoMovimiento);
//        if($validarCantidad > 0) {
//            $respuesta = "Existen detalles con cantidad en cero";
//        }  
//        
//        $validarLote = $em->getRepository('BrasaInventarioBundle:InvMovimientoDetalle')->validarLote($codigoMovimiento);
//        if($validarLote > 0) {
//            $respuesta = "Existen detalles sin lote";
//        }         
//        $validarBodega = $em->getRepository('BrasaInventarioBundle:InvMovimientoDetalle')->validarBodega($codigoMovimiento);
//        if($validarBodega > 0) {
//            $respuesta = "Existen detalles sin bodega o con codigo de bodega incorrecta";
//        }
        if ($respuesta == "") {
            $validarExistencia = $em->getRepository('InventarioBundle:KardexArticulo')->validarExistencia($codigoMovimiento, $codigo, $cantidad);
            if ($validarExistencia == FALSE) {
                $respuesta = "Cantidades con existencias insuficientes";
            }
        }
        return $respuesta;
    }

}
