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
     * @Route("citas/", name="citas_lista")
     * @Method("GET")
     */
    public function listaAction() {
        $em = $this->getDoctrine()->getManager();

        $citas = $em->getRepository('CitasBundle:Citas')->findAll();

        return $this->render('CitasBundle:Citas:lista.html.twig', array(
                    'citas' => $citas,
        ));
    }

    /**
     * Creates a new cita entity.
     *
     * @Route("citas/nuevo", name="citas_nueva")
     * @Method({"GET", "POST"})
     */
    public function nuevoAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $arCita = new Citas();
        
        $form = $this->createForm('CitasBundle\Form\CitasType', $arCita);
        $form->handleRequest($request);
        /* if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($arCita);
          $em->flush(); */
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $arrControles = $request->request->All();
                if ($arrControles['txtCedula'] != '') {
                    $arTercero = new \CitasBundle\Entity\Cliente();
                    $arHoraInicio = new \GeneralBundle\Entity\Configuracion();
                    $arTercero = $em->getRepository('CitasBundle:Cliente')->findOneBy(array('numDocumento' => $arrControles['txtCedula']));
                    if (count($arTercero) > 0) {
                        $arHoraInicio = $em->getRepository('GeneralBundle:Configuracion')->find('horaApertura');
                        $arHoraCierre = $em->getRepository('GeneralBundle:Configuracion')->find('horaCierre');
                        $horaCita = $form->get('horaCita')->getData();
                        
                        
                        if($horaCita > $arHoraInicio ){
                            
                        $arCita->setClienteRel($arTercero);
                        //$arCita->setHoraCita($horaCita);
                        
                        $em->persist($arCita);
                        $em->flush();


                        return $this->redirectToRoute('citas_lista', array('codigoCitasPk' => $arCita->getCodigoCitasPk()));
                        } else {
                            echo  "err";
                        }
                    } else {
                        echo "El cliente no existe";
                    }
                } else {
                    echo "El campo cliente es obligatorio";
                }
            }
        }

        return $this->render('CitasBundle:Citas:nuevo.html.twig', array(
                    'arCita' => $arCita,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cita entity.
     *
     * @Route("citas/{codigoCitasPk}/editar", name="citas_editar")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Citas $cita) {
        $deleteForm = $this->createDeleteForm($cita);
        $editForm = $this->createForm('CitasBundle\Form\CitasType', $cita);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('citas_editar', array('codigoCitasPk' => $cita->getCodigoCitasPk()));
        }

        return $this->render('CitasBundle:Citas:editar.html.twig', array(
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

        return $this->redirectToRoute('citas_lista');
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
