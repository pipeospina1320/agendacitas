<?php

namespace GeneralBundle\Controller;

use GeneralBundle\Entity\Comprobante;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class ComprobanteController extends Controller
{
    /**
     * @Route("comprobante/", name="comprobante_lista")
     * @Method("GET")
     */
    public function listaAction()
    {
        $em = $this->getDoctrine()->getManager();

        $comprobantes = $em->getRepository('GeneralBundle:Comprobante')->findAll();

        return $this->render('GeneralBundle:Comprobante:lista.html.twig', array(
            'comprobantes' => $comprobantes,
        ));
    }

    /**
     * Creates a new comprobante entity.
     *
     * @Route("comprobante/nuevo", name="comprobante_nuevo")
     * @Method({"GET", "POST"})
     */
    public function nuevoAction(Request $request)
    {
        $comprobante = new Comprobante();
        $form = $this->createForm('GeneralBundle\Form\ComprobanteType', $comprobante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comprobante);
            $em->flush();
            
            return $this->redirectToRoute('comprobante_lista', array('codigoComprobantePk' => $comprobante->getCodigoComprobantePk()));
        }

        return $this->render('GeneralBundle:Comprobante:nuevo.html.twig', array(
            'comprobante' => $comprobante,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a comprobante entity.
     *
     * @Route("comprobante/{codigoComprobantePk}", name="comprobante_show")
     * @Method("GET")
     */
    public function showAction(Comprobante $comprobante)
    {
        $deleteForm = $this->createDeleteForm($comprobante);

        return $this->render('GeneralBundle:Comprobante:show.html.twig', array(
            'comprobante' => $comprobante,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing comprobante entity.
     *
     * @Route("comprobante/{codigoComprobantePk}/editar", name="comprobante_editar")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Comprobante $comprobante)
    {
        $deleteForm = $this->createDeleteForm($comprobante);
        $editForm = $this->createForm('GeneralBundle\Form\ComprobanteType', $comprobante);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comprobante_editar', array('codigoComprobantePk' => $comprobante->getCodigocomprobantepk()));
        }

        return $this->render('GeneralBundle:Comprobante:editar.html.twig', array(
            'comprobante' => $comprobante,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a comprobante entity.
     *
     * @Route("comprobante/{codigoComprobantePk}", name="comprobante_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Comprobante $comprobante)
    {
        $form = $this->createDeleteForm($comprobante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comprobante);
            $em->flush();
        }

        return $this->redirectToRoute('comprobante_index');
    }

    /**
     * Creates a form to delete a comprobante entity.
     *
     * @param Comprobante $comprobante The comprobante entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Comprobante $comprobante)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comprobante_delete', array('codigoComprobantePk' => $comprobante->getCodigocomprobantepk())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
