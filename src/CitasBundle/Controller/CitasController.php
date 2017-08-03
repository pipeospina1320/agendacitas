<?php

namespace CitasBundle\Controller;

use CitasBundle\Entity\Citas;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;



class CitasController extends Controller {

    /**
     * Lists all cita entities.
     *
     * @Route("citas/", name="citas_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $citas = $em->getRepository('CitasBundle:Citas')->findAll();

        return $this->render('CitasBundle:Citas:index.html.twig', array(
                    'citas' => $citas,
        ));
    }

    /**
     * Creates a new cita entity.
     *
     * @Route("citas/nuevo", name="citas_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $cita = new Citas();
        $form = $this->createForm('CitasBundle\Form\CitasType', $cita);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cita);
            $em->flush();

            return $this->redirectToRoute('citas_show', array('codigoCitasPk' => $cita->getCodigoCitasPk()));
        }

        return $this->render('CitasBundle:Citas:nuevacita.html.twig', array(
                    'cita' => $cita,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cita entity.
     *
     * @Route("citas/{codigoCitasPk}", name="citas_show")
     * @Method("GET")
     */
    public function showAction(Citas $cita) {
        $deleteForm = $this->createDeleteForm($cita);

        return $this->render('CitasBundle:Citas:lista.html.twig', array(
                    'cita' => $cita,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cita entity.
     *
     * @Route("citas/{codigoCitasPk}/edit", name="citas_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Citas $cita) {
        $deleteForm = $this->createDeleteForm($cita);
        $editForm = $this->createForm('CitasBundle\Form\CitasType', $cita);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('citas_edit', array('codigoCitasPk' => $cita->getCodigoCitasPk()));
        }

        return $this->render('CitasBundle:Citas:edit.html.twig', array(
                    'cita' => $cita,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cita entity.
     *
     * @Route("citas/{codigoCitasPk}", name="citas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Citas $cita) {
        $form = $this->createDeleteForm($cita);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cita);
            $em->flush();
        }

        return $this->redirectToRoute('citas_index');
    }

    /**
     * Creates a form to delete a cita entity.
     *
     * @param Citas $cita The cita entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Citas $cita) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('citas_delete', array('codigoCitasPk' => $cita->getCodigoCitasPk())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
