<?php

namespace EmpleadoBundle\Controller;

use EmpleadoBundle\Entity\Empleado;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class EmpleadoController extends Controller
{
    /**
     * Lists all usuario entities.
     *
     * @Route("empleado/", name="empleado_lista")
     * @Method("GET")
     */
    public function listaAction()
    {
        $em = $this->getDoctrine()->getManager();

        $arEmpleados = $em->getRepository('EmpleadoBundle:Empleado')->findAll();

        return $this->render('EmpleadoBundle:Empleado:lista.html.twig', array(
            'empleados' => $arEmpleados,
        ));
    }

    /**
     * Creates a new usuario entity.
     *
     * @Route("empleado/nuevo", name="empleado_nuevo")
     * @Method({"GET", "POST"})
     */
    public function nuevoAction(Request $request)
    {
        $empleado = new Empleado();
        $form = $this->createForm('EmpleadoBundle\Form\EmpleadoType', $empleado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($empleado);
            $em->flush();

            return $this->redirectToRoute('empleado_lista', array('codigoEmpleadoPk' => $empleado->getCodigoEmpleadoPk()));
        }

        return $this->render('EmpleadoBundle:Empleado:nuevo.html.twig', array(
            'usuario' => $empleado,
            'form' => $form->createView(),
        ));
    }

  
    /**
     * Displays a form to edit an existing usuario entity.
     *
     * @Route("empleado/{codigoEmpleadoPk}/editar", name="empleado_editar")
     * @Method({"GET", "POST"})
     */
    public function editarAction(Request $request, Empleado $empleado)
    {
        $deleteForm = $this->createDeleteForm($empleado);
        $editForm = $this->createForm('EmpleadoBundle\Form\EmpleadoType', $empleado);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('empleado_editar', array('codigoEmpleadoPk' => $empleado->getCodigoEmpleadoPk()));
        }

        return $this->render('EmpleadoBundle:Empleado:editar.html.twig', array(
            'empleado' => $empleado,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a usuario entity.
     *
     * @Route("empleado/{codigoEmpleadoPk}", name="empleado_borrar")
     * @Method("DELETE")
     */
    public function borrarAction(Request $request, Empleado $empleado)
    {
        $form = $this->createDeleteForm($empleado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($empleado);
            $em->flush();
        }

        return $this->redirectToRoute('usuario_lista');
    }

    /**
     * Creates a form to delete a empleado entity.
     *
     * @param Empleado $empleado The empleado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Empleado $empleado)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('empleado_borrar', array('codigoUsuarioPk' => $empleado->getCodigoEmpleadoPk())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
