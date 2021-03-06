<?php

namespace GeneralBundle\Controller;

use GeneralBundle\Entity\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class ClienteController extends Controller {

    /**
     * Lists all cliente entities.
     *
     * @Route("clientes/", name="cliente_lista")
     * @Method("GET")
     */
    public function listaAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $arClientes = $em->getRepository('GeneralBundle:Cliente')->findAll();

        return $this->render('GeneralBundle:Cliente:lista.html.twig', array(
                    'arClientes' => $arClientes,
        ));
    }

    /**
     * Creates a new cliente entity.
     *
     * @Route("clientes/nuevocliente", name="cliente_nuevo")
     * @Method({"GET", "POST"})
     */
    public function nuevoAction(Request $request) {
        $arClientes = new Cliente();
        $form = $this->createForm('GeneralBundle\Form\ClienteType', $arClientes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($arClientes);
            $em->flush();

            return $this->redirectToRoute('cliente_show', array('codigoClientePk' => $arClientes->getCodigoClientePk()));
        }

        return $this->render('GeneralBundle:Cliente:nuevo.html.twig', array(
                    'arClientes' => $arClientes,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cliente entity.
     *
     * @Route("clientes/{codigoClientePk}", name="cliente_show")
     * @Method("GET")
     */
    public function detalleAction(Cliente $cliente) {
        $deleteForm = $this->createDeleteForm($cliente);

        return $this->render('GeneralBundle:Cliente:buscar.html.twig', array(
                    'cliente' => $cliente,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cliente entity.
     *
     * @Route("clientes/{codigoClientePk}/edit", name="cliente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cliente $cliente) {
        $deleteForm = $this->createDeleteForm($cliente);
        $editForm = $this->createForm('GeneralBundle\Form\ClienteType', $cliente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cliente_edit', array('codigoClientePk' => $cliente->getCodigoClientePk()));
        }

        return $this->render('GeneralBundle:Cliente:editar.html.twig', array(
                    'cliente' => $cliente,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cliente entity.
     *
     * @Route("clientes/{codigoClientePk}", name="cliente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cliente $cliente) {
        $form = $this->createDeleteForm($cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cliente);
            $em->flush();
        }

        return $this->redirectToRoute('cliente_lista');
    }

    /**
     * Creates a form to delete a cliente entity.
     *
     * @param Cliente $cliente The cliente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cliente $cliente) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('cliente_delete', array('codigoClientePk' => $cliente->getCodigoClientePk())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
