<?php

namespace InventarioBundle\Controller;

use InventarioBundle\Entity\Articulo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ArticuloController extends Controller {

    /**
     * @Route("articulo/", name="articulo_lista")
     */
    public function listaAction() {
        $em = $this->getDoctrine()->getManager();

        $arArticulo = $em->getRepository('InventarioBundle:Articulo')->findAll();

        return $this->render('InventarioBundle:Articulo:lista.html.twig', array(
                    'arArticulo' => $arArticulo,
        ));
    }

    /**
     * @Route("articulo/nuevo", name="articulo_nuevo")
     * @Method({"GET", "POST"})
     */
    public function nuevoAction(Request $request) {
        $articulo = new Articulo();
        $form = $this->createForm('InventarioBundle\Form\ArticuloType', $articulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($articulo);
            $em->flush();

            return $this->redirectToRoute('articulo_lista', array('codigoArticuloPk' => $articulo->getCodigoArticuloPk()));
        }

        return $this->render('InventarioBundle:Articulo:nuevo.html.twig', array(
                    'articulo' => $articulo,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cliente entity.
     *
     * @Route("articulo/{codigoArticuloPk}/editar", name="articulo_editar")
     * @Method({"GET", "POST"})
     */
    public function editarAction(Request $request, Articulo $articulo) {
        
        $editForm = $this->createForm('InventarioBundle\Form\ArticuloType', $articulo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articulo_editar', array('codigoArticuloPk' => $articulo->getCodigoArticuloPk()));
        }

        return $this->render('InventioBundle:Articulo:editar.html.twig', array(
                    'articulo' => $articulo,
                    'edit_form' => $editForm->createView(),
                    
        ));
    }

}
