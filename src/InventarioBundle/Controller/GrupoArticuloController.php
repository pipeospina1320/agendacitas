<?php

namespace InventarioBundle\Controller;

use InventarioBundle\Entity\GrupoArticulo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class GrupoArticuloController extends Controller {

    /**
     * @Route("grupo/", name="grupo_lista")
     */
    public function listaAction() {
        $em = $this->getDoctrine()->getManager();

        $arGrupoArticulo = $em->getRepository('InventarioBundle:GrupoArticulo')->findAll();

        return $this->render('InventarioBundle:GrupoArticulo:lista.html.twig', array(
                    'arGrupoArticulo' => $arGrupoArticulo,
        ));
    }

    /**
     * @Route("grupo/nuevo", name="grupo_nuevo")
     * @Method({"GET", "POST"})
     */
    public function nuevoAction(Request $request) {
        $grupoArticulo = new GrupoArticulo();
        $form = $this->createForm('InventarioBundle\Form\GrupoArticuloType', $grupoArticulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grupoArticulo);
            $em->flush();

            return $this->redirectToRoute('grupo_lista', array('codigoGrupoArticuloPk' => $grupoArticulo->getCodigoGrupoArticuloPk()));
        }

        return $this->render('InventarioBundle:GrupoArticulo:nuevo.html.twig', array(
                    'grupoarticulo' => $grupoArticulo,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cliente entity.
     *
     * @Route("grupo/{codigoGrupoArticuloPk}/editar", name="grupo_editar")
     * @Method({"GET", "POST"})
     */
    public function editarAction(Request $request, GrupoArticulo $grupoArticulo) {
        
        $editForm = $this->createForm('InventarioBundle\Form\GrupoArticuloType', $grupoArticulo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('grupo_editar', array('codigoGrupoArticuloPk' => $grupoArticulo->getCodigoGrupoArticuloPk()));
        }

        return $this->render('InventarioBundle:GrupoArticulo:editar.html.twig', array(
                    'articulo' => $grupoArticulo,
                    'edit_form' => $editForm->createView(),
                    
        ));
    }

}
