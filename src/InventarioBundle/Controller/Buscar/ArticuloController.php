<?php

namespace InventarioBundle\Controller\Buscar;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;

class ArticuloController extends Controller {

    var $strDqlLista = "";
    var $strCodigo = "";
    var $strNombre = "";

    /**
     * @Route("/inv/burcar/item/{codigoFactura}/{campoCodigo}/{campoNombre}", name="buscar_articulo")
     */
    public function listaAction(Request $request, $campoCodigo, $campoNombre, $codigoFactura) {
        $em = $this->getDoctrine()->getManager();
        $arFactura = new \FacturacionBundle\Entity\FacturaDetalle();
        $arFactura = $em->getRepository('FacturacionBundle:Factura')->find($codigoFactura);
        $arFacturaDetalle = new \FacturacionBundle\Entity\FacturaDetalle();
        $paginator = $this->get('knp_paginator');
        $form = $this->formularioLista();
        $form->handleRequest($request);
        $this->lista();
        if ($form->get('BtnFiltrar')->isClicked()) {
            $this->filtrarLista($form);
            $this->lista();
        } else {
            if ($form->isSubmitted()) {
                if ($form->isValid()) {
                    if ($form->get('BtnGuardar')->isClicked()) {
                        $arrSeleccionados = $request->request->get('ChkSeleccionar');
                        $arrControles = $request->request->All();
                        if (count($arrSeleccionados) > 0) {
                            foreach ($arrSeleccionados AS $codigo) {
                                $arArticulo = new \InventarioBundle\Entity\Articulo();
                                $arArticulo = $em->getRepository('InventarioBundle:Articulo')->find($codigo);
                                $arFacturaDetalle = new \FacturacionBundle\Entity\FacturaDetalle();
                                $arFacturaDetalle->setFacturaRel($arFactura);
                                $arFacturaDetalle->setArticuloRel($arArticulo);
//                            $arFacturaDetalle->setAfectaInventario($arArticulo->getAfectaInventario());
//                            $arFacturaDetalle->setOperacionInventario($arFacturaDetalle->getOperacionInventario());
//                            $arFacturaDetalle->setPorcentajeIva($arArticulo->getPorcentajeIva());
                                $em->persist($arFacturaDetalle);
                            }
                            $em->persist($arFacturaDetalle);
                            $em->flush();
                        }
                    }
                    echo "<script languaje='javascript' type='text/javascript'>window.close();window.opener.location.reload();</script>";
                }
            }
        }

        $arArticulo = $paginator->paginate($em->createQuery($this->strDqlLista), $request->query->get('page', 1), 20);
        return $this->render('InventarioBundle:Buscar:item.html.twig', array(
                    'arFacturaDetalle' => $arFacturaDetalle,
                    'arArticulo' => $arArticulo,
                    'campoCodigo' => $campoCodigo,
                    'campoNombre' => $campoNombre,
                    'form' => $form->createView()
        ));
    }

    private function lista() {
        $em = $this->getDoctrine()->getManager();
        $this->strDqlLista = $em->getRepository('InventarioBundle:Articulo')->listaDQL(
                $this->strNombre, $this->strCodigo
        );
    }

    private function formularioLista() {
        $form = $this->createFormBuilder()
                ->add('TxtNombreArticulo', TextType::class, array('label' => 'Nombre', 'data' => $this->strNombre))
                ->add('TxtCodigoArticulo', TextType::class, array('label' => 'Codigo', 'data' => $this->strCodigo))
                ->add('BtnFiltrar', SubmitType::class, array('label' => 'Filtrar'))
                ->add('BtnGuardar', SubmitType::class, array('label' => 'Guardar',))
                ->getForm();
        return $form;
    }

    private function filtrarLista($form) {
        $session = new Session;
        $this->strNombre = $form->get('TxtNombreArticulo')->getData();
        $this->strCodigo = $form->get('TxtCodigoArticulo')->getData();
    }

}
