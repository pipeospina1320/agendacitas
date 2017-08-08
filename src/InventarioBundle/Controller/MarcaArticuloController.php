<?php

namespace InventarioBundle\Controller;

use InventarioBundle\Entity\MarcaArticulo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MarcaArticuloController extends Controller {

    /**
     * @Route("marca/", name="marca_lista")
     */
    public function listaAction() {
        $em = $this->getDoctrine()->getManager();

        $arMarcaArticulo = $em->getRepository('InventarioBundle:MarcaArticulo')->findAll();

        return $this->render('InventarioBundle:MarcaArticulo:lista.html.twig', array(
                    'arMarcaArticulo' => $arMarcaArticulo,
        ));
    }

    /**
     * @Route("marca/nuevo", name="marca_nuevo")
     * @Method({"GET", "POST"})
     */
    public function nuevoAction(Request $request) {
        $arMarcaArticulo = new MarcaArticulo();
        $form = $this->createForm('InventarioBundle\Form\MarcaArticuloType', $arMarcaArticulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($arMarcaArticulo);
            $em->flush();

            return $this->redirectToRoute('marca_lista', array('codigoMarcaArticuloPk' => $arMarcaArticulo->getCodigoMarcaArticuloPk()));
        }

        return $this->render('InventarioBundle:MarcaArticulo:nuevo.html.twig', array(
                    'marcaArticulo' => $arMarcaArticulo,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cliente entity.
     *
     * @Route("marca/{codigoMarcaArticuloPk}/editar", name="marca_editar")
     * @Method({"GET", "POST"})
     */
    public function editarAction(Request $request, MarcaArticulo $arMarcaArticulo) {
        
        $editForm = $this->createForm('InventarioBundle\Form\MarcaArticuloType', $arMarcaArticulo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('marca_editar', array('codigoMarcaArticuloPk' => $arMarcaArticulo->getCodigoMarcaArticuloPk()));
        }

        return $this->render('InventarioBundle:MarcaArticulo:editar.html.twig', array(
                    'marcaArticulo' => $arMarcaArticulo,
                    'edit_form' => $editForm->createView(),
                    
        ));
    }

}
