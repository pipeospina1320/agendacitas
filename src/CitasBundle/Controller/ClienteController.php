<?php

namespace CitasBundle\Controller;

use CitasBundle\Entity\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ClienteController extends Controller {

    /**
     * Lists all cliente entities.
     *
     * @Route("citas/clientes", name="cliente_index")
     * @Method("GET")
     */
    public function listaAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $arClientes = $em->getRepository('CitasBundle:Cliente')->findAll();

        return $this->render('CitasBundle:Cliente:lista.html.twig', array(
                    'arClientes' => $arClientes,
        ));
    }

    /**
     * Creates a new cliente entity.
     *
     * @Route("citas/nuevocliente", name="cliente_new")
     * @Method({"GET", "POST"})
     */
    public function nuevoAction(Request $request) {
        $cliente = new Cliente();
        $form = $this->createForm('CitasBundle\Form\ClienteType', $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cliente);
            $em->flush();

            return $this->redirectToRoute('cliente_show', array('codigoClientePk' => $cliente->getCodigoClientePk()));
        }

        return $this->render('CitasBundle:Cliente:nuevo.html.twig', array(
                    'cliente' => $cliente,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cliente entity.
     *
     * @Route("citas/{codigoClientePk}", name="cliente_show")
     * @Method("GET")
     */
    public function detalleAction(Cliente $cliente) {
        $deleteForm = $this->createDeleteForm($cliente);

        return $this->render('CitasBundle:Cliente:buscar.html.twig', array(
                    'cliente' => $cliente,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cliente entity.
     *
     * @Route("citas/{codigoClientePk}/edit", name="cliente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cliente $cliente) {
        $deleteForm = $this->createDeleteForm($cliente);
        $editForm = $this->createForm('CitasBundle\Form\ClienteType', $cliente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cliente_edit', array('codigoClientePk' => $cliente->getCodigoClientePk()));
        }

        return $this->render('CitasBundle:Cliente:editar.html.twig', array(
                    'cliente' => $cliente,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cliente entity.
     *
     * @Route("citas/{codigoClientePk}", name="cliente_delete")
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

        return $this->redirectToRoute('cliente_index');
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
