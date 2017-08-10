<?php

namespace SeguridadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\SecurityContext;
use SeguridadBundle\Form\Type\UserType;
use SeguridadBundle\Form\Type\UserEditarType;
use SeguridadBundle\Form\Type\SegPermisoDocumentoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use SeguridadBundle\Form\Type\SegGrupoType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SegUsuariosController extends Controller {

    var $strDqlLista = "";
    var $strDqlListaSegDocumento = "";

    /**
     * @Route("usuario/lista/", name="usuario_lista")
     */
    public function listaAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');
        $form = $this->formularioLista();
        $form->handleRequest($request);
        $this->listar();
        //$arUsuarios = $em->getRepository('SeguridadBundle:User')->findAll();
        $arUsuarios = $paginator->paginate($em->createQuery($this->strDqlLista), $request->query->get('page', 1), 50);
        $arGrupos = $paginator->paginate($em->getRepository("SeguridadBundle:SegGrupo")->findAll(), $request->query->get('page', 1), 50);
        return $this->render('SeguridadBundle:Usuarios:lista.html.twig', array(
                    'form' => $form->createView(),
                    'arUsuarios' => $arUsuarios,
                    'arGrupos' => $arGrupos
        ));
    }

    /**
     * @Route("usuario/nuevo/{codigoUsuario}", name="usuario_nuevo")
     */
    public function nuevoAction(Request $request, $codigoUsuario) {
        $em = $this->getDoctrine()->getManager();
        $arUsuario = new \SeguridadBundle\Entity\User();
        $form = $this->createForm(UserType::class, $arUsuario);
        if ($codigoUsuario != 0) {
            $arUsuario = $em->getRepository('SeguridadBundle:User')->find($codigoUsuario);
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($arUsuario);
            $password = $encoder->encodePassword($arUsuario->getPassword(), $arUsuario->getSalt());
            $form = $this->createForm(UserEditarType::class, $arUsuario);
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $arUsuario = $form->getData();
            if ($codigoUsuario == 0) {
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($arUsuario);
                $password = $encoder->encodePassword($arUsuario->getPassword(), $arUsuario->getSalt());
                $arUsuario->setPassword($password);
            }
            $em->persist($arUsuario);
            if ($arUsuario->getGrupoRel()) {
                $em->getRepository('SeguridadBundle:SegPermisoGrupo')->asignarPermisosUsuario($arUsuario->getGrupoRel()->getCodigoGrupoPk(), $arUsuario);
            }
            $em->flush();
            return $this->redirect($this->generateUrl('usuario_lista'));
        }
        return $this->render('SeguridadBundle:Usuarios:nuevo.html.twig', array(
                    'form' => $form->createView(),
                    'codigoUsuario' => $codigoUsuario
        ));
    }

    /**
     * @Route("usuario/detalle/{codigoUsuario}", name="usuario_detalle")
     */
    public function detalleAction(Request $request, $codigoUsuario) {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createFormBuilder()
                ->add('BtnEliminarEspecial', SubmitType::class, array('label' => 'Eliminar'))
                ->add('BtnEliminarDocumento', SubmitType::class, array('label' => 'Eliminar'))
                ->add('BtnEliminarRol', SubmitType::class, array('label' => 'Eliminar'))
                ->getForm();
        $form->handleRequest($request);

        $arUsuario = new \SeguridadBundle\Entity\User();
        $arUsuario = $em->getRepository('SeguridadBundle:User')->find($codigoUsuario);
        if ($form->isValid()) {
            if ($form->get('BtnEliminarEspecial')->isClicked()) {
                $arrSeleccionados = $request->request->get('ChkSeleccionarPermisoEspecial');
                if (count($arrSeleccionados) > 0) {
                    foreach ($arrSeleccionados AS $codigoUsuarioPermisoEspecialPk) {
                        $arUsuarioPermisoEspecial = new SeguridadBundle\Entity\SegUsuarioPermisoEspecial();
                        $arUsuarioPermisoEspecial = $em->getRepository('SeguridadBundle:SegUsuarioPermisoEspecial')->find($codigoUsuarioPermisoEspecialPk);
                        $em->remove($arUsuarioPermisoEspecial);
                        $em->flush();
                    }
                }
                return $this->redirect($this->generateUrl('brs_seg_admin_usuario_detalle', array('codigoUsuario' => $codigoUsuario)));
            }
            if ($form->get('BtnEliminarDocumento')->isClicked()) {
                $arrSeleccionados = $request->request->get('ChkSeleccionarPermisoDocumento');
                if (count($arrSeleccionados) > 0) {
                    foreach ($arrSeleccionados AS $codigoPermisoDocumentoPk) {
                        $arPermisoDocumento = new SeguridadBundle\Entity\SegPermisoDocumento();
                        $arPermisoDocumento = $em->getRepository('SeguridadBundle:SegPermisoDocumento')->find($codigoPermisoDocumentoPk);
                        $em->remove($arPermisoDocumento);
                        $em->flush();
                    }
                }
                return $this->redirect($this->generateUrl('brs_seg_admin_usuario_detalle', array('codigoUsuario' => $codigoUsuario)));
            }
            if ($form->get('BtnEliminarRol')->isClicked()) {
                $arrSeleccionados = $request->request->get('ChkSeleccionarUsuarioRol');
                if (count($arrSeleccionados) > 0) {
                    foreach ($arrSeleccionados AS $codigoUsuarioRol) {
                        $arUsuarioRol = new SeguridadBundle\Entity\SegUsuarioRol();
                        $arUsuarioRol = $em->getRepository('SeguridadBundle:SegUsuarioRol')->find($codigoUsuarioRol);
                        $em->remove($arUsuarioRol);
                    }
                    $em->flush();
                }
                return $this->redirect($this->generateUrl('brs_seg_admin_usuario_detalle', array('codigoUsuario' => $codigoUsuario)));
            }
        }
        $arPermisosDocumentos = new \SeguridadBundle\Entity\SegPermisoDocumento();
        $arPermisosDocumentos = $em->getRepository('SeguridadBundle:SegPermisoDocumento')->findBy(array('codigoUsuarioFk' => $codigoUsuario));
        $arPermisosEspeciales = new \SeguridadBundle\Entity\SegUsuarioPermisoEspecial();
        $arPermisosEspeciales = $em->getRepository('SeguridadBundle:SegUsuarioPermisoEspecial')->findBy(array('codigoUsuarioFk' => $codigoUsuario));
        $arUsuarioRoles = new \SeguridadBundle\Entity\SegUsuarioRol();
        $arUsuarioRoles = $em->getRepository('SeguridadBundle:SegUsuarioRol')->findBy(array('codigoUsuarioFk' => $codigoUsuario));
        return $this->render('SeguridadBundle:Usuarios:detalle.html.twig', array(
                    'arPermisosDocumentos' => $arPermisosDocumentos,
                    'arPermisosEspeciales' => $arPermisosEspeciales,
                    'arUsuarioRoles' => $arUsuarioRoles,
                    'arUsuario' => $arUsuario,
                    'form' => $form->createView()
        ));
    }

    /**
     * @Route("usuario/detalle/ver/{codigoUsuario}/", name="")
     */
    public function detalleVerAction(Request $request, $codigoUsuario) {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createFormBuilder()
                ->getForm();
        $form->handleRequest($request);
        $arUsuario = new SeguridadBundle\Entity\User();
        $arUsuario = $em->getRepository('SeguridadBundle:User')->find($codigoUsuario);
        if ($form->isValid()) {
            if ($form->get('BtnEliminarEspecial')->isClicked()) {
                $arrSeleccionados = $request->request->get('ChkSeleccionarPermisoEspecial');
                if (count($arrSeleccionados) > 0) {
                    foreach ($arrSeleccionados AS $codigoUsuarioPermisoEspecialPk) {
                        $arUsuarioPermisoEspecial = new SeguridadBundle\Entity\SegUsuarioPermisoEspecial();
                        $arUsuarioPermisoEspecial = $em->getRepository('SeguridadBundle:SegUsuarioPermisoEspecial')->find($codigoUsuarioPermisoEspecialPk);
                        $em->remove($arUsuarioPermisoEspecial);
                        $em->flush();
                    }
                }
                return $this->redirect($this->generateUrl('brs_seg_admin_usuario_detalle', array('codigoUsuario' => $codigoUsuario)));
            }
            if ($form->get('BtnEliminarDocumento')->isClicked()) {
                $arrSeleccionados = $request->request->get('ChkSeleccionarPermisoDocumento');
                if (count($arrSeleccionados) > 0) {
                    foreach ($arrSeleccionados AS $codigoPermisoDocumentoPk) {
                        $arPermisoDocumento = new SeguridadBundle\Entity\SegPermisoDocumento();
                        $arPermisoDocumento = $em->getRepository('SeguridadBundle:SegPermisoDocumento')->find($codigoPermisoDocumentoPk);
                        $em->remove($arPermisoDocumento);
                        $em->flush();
                    }
                }
                return $this->redirect($this->generateUrl('brs_seg_admin_usuario_detalle', array('codigoUsuario' => $codigoUsuario)));
            }
            if ($form->get('BtnEliminarRol')->isClicked()) {
                $arrSeleccionados = $request->request->get('ChkSeleccionarUsuarioRol');
                if (count($arrSeleccionados) > 0) {
                    foreach ($arrSeleccionados AS $codigoUsuarioRol) {
                        $arUsuarioRol = new SeguridadBundle\Entity\SegUsuarioRol();
                        $arUsuarioRol = $em->getRepository('SeguridadBundle:SegUsuarioRol')->find($codigoUsuarioRol);
                        $em->remove($arUsuarioRol);
                    }
                    $em->flush();
                }
                return $this->redirect($this->generateUrl('brs_seg_admin_usuario_detalle', array('codigoUsuario' => $codigoUsuario)));
            }
            if ($form->get('BtnActualizar')->isClicked()) {
                $arrControles = $request->request->All();
                $intIndice = 0;
                if (isset($arrControles['LblCodigoGuiaDocumento'])) {
                    foreach ($arrControles['LblCodigoGuiaDocumento'] as $intCodigo) {
                        $arPermisoDocumento = new SeguridadBundle\Entity\SegPermisoDocumento();
                        $arPermisoDocumento = $em->getRepository('SeguridadBundle:SegPermisoDocumento')->find($intCodigo);
                        if (isset($arrControles['ChkSeleccionarIngreso' . $intCodigo])) {
                            $arPermisoDocumento->setIngreso(1);
                        } else {
                            $arPermisoDocumento->setIngreso(0);
                        }
                        if (isset($arrControles['ChkSeleccionarNuevo' . $intCodigo])) {
                            $arPermisoDocumento->setNuevo(1);
                        } else {
                            $arPermisoDocumento->setNuevo(0);
                        }
                        if (isset($arrControles['ChkSeleccionarEditar' . $intCodigo])) {
                            $arPermisoDocumento->setEditar(1);
                        } else {
                            $arPermisoDocumento->setEditar(0);
                        }
                        if (isset($arrControles['ChkSeleccionarEliminar' . $intCodigo])) {
                            $arPermisoDocumento->setEliminar(1);
                        } else {
                            $arPermisoDocumento->setEliminar(0);
                        }
                        if (isset($arrControles['ChkSeleccionarAutorizar' . $intCodigo])) {
                            $arPermisoDocumento->setAutorizar(1);
                        } else {
                            $arPermisoDocumento->setAutorizar(0);
                        }
                        if (isset($arrControles['ChkSeleccionarDesautorizar' . $intCodigo])) {
                            $arPermisoDocumento->setDesautorizar(1);
                        } else {
                            $arPermisoDocumento->setDesautorizar(0);
                        }
                        if (isset($arrControles['ChkSeleccionarAprobar' . $intCodigo])) {
                            $arPermisoDocumento->setAprobar(1);
                        } else {
                            $arPermisoDocumento->setAprobar(0);
                        }
                        if (isset($arrControles['ChkSeleccionarDesaprobar' . $intCodigo])) {
                            $arPermisoDocumento->setDesaprobar(1);
                        } else {
                            $arPermisoDocumento->setDesaprobar(0);
                        }
                        if (isset($arrControles['ChkSeleccionarAnular' . $intCodigo])) {
                            $arPermisoDocumento->setAnular(1);
                        } else {
                            $arPermisoDocumento->setAnular(0);
                        }
                        if (isset($arrControles['ChkSeleccionarDesanular' . $intCodigo])) {
                            $arPermisoDocumento->setDesanular(1);
                        } else {
                            $arPermisoDocumento->setDesanular(0);
                        }
                        if (isset($arrControles['ChkSeleccionarImprimir' . $intCodigo])) {
                            $arPermisoDocumento->setImprimir(1);
                        } else {
                            $arPermisoDocumento->setImprimir(0);
                        }
                        $em->persist($arPermisoDocumento);
                    }
                }
                $em->flush();
            }
        }
        $arPermisosDocumentos = new SeguridadBundle\Entity\SegPermisoDocumento();
        $arPermisosDocumentos = $em->getRepository('SeguridadBundle:SegPermisoDocumento')->findBy(array('codigoUsuarioFk' => $codigoUsuario));
        $arPermisosEspeciales = new SeguridadBundle\Entity\SegUsuarioPermisoEspecial();
        $arPermisosEspeciales = $em->getRepository('SeguridadBundle:SegUsuarioPermisoEspecial')->findBy(array('codigoUsuarioFk' => $codigoUsuario));
        $arUsuarioRoles = new SeguridadBundle\Entity\SegUsuarioRol();
        $arUsuarioRoles = $em->getRepository('SeguridadBundle:SegUsuarioRol')->findBy(array('codigoUsuarioFk' => $codigoUsuario));
        return $this->render('SeguridadBundle:Usuarios:detalleVer.html.twig', array(
                    'arPermisosDocumentos' => $arPermisosDocumentos,
                    'arPermisosEspeciales' => $arPermisosEspeciales,
                    'arUsuarioRoles' => $arUsuarioRoles,
                    'arUsuario' => $arUsuario,
                    'form' => $form->createView()
        ));
    }

    /**
     * @Route("usuario/detalle/permiso/especial/nuevo/{codigoUsuario}/", name="usuario_detalle_nuevo_especial")
     */
    public function detalleNuevoPermisoEspecialAction(Request $request, $codigoUsuario) {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createFormBuilder()
                ->add('guardar', SubmitType::class, array('label' => 'Guardar'))
                ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($form->get('guardar')->isClicked()) {
                $arUsuario = $em->getRepository('SeguridadBundle:User')->find($codigoUsuario);
                $arrSeleccionados = $request->request->get('ChkSeleccionar');
                if (count($arrSeleccionados) > 0) {
                    foreach ($arrSeleccionados AS $codigoPermisoEspecial) {
                        $arUsuarioPermisoEspecialValidar = new \SeguridadBundle\Entity\SegUsuarioPermisoEspecial();
                        $arUsuarioPermisoEspecialValidar = $em->getRepository('SeguridadBundle:SegUsuarioPermisoEspecial')->findBy(array('codigoUsuarioFk' => $codigoUsuario, 'codigoPermisoEspecialFk' => $codigoPermisoEspecial));
                        if (!$arUsuarioPermisoEspecialValidar) {
                            $arPermisoEspecial = new \SeguridadBundle\Entity\SegPermisoEspecial();
                            $arPermisoEspecial = $em->getRepository('SeguridadBundle:SegPermisoEspecial')->find($codigoPermisoEspecial);
                            $arUsuarioPermisoEspecial = new \SeguridadBundle\Entity\SegUsuarioPermisoEspecial();
                            $arUsuarioPermisoEspecial->setPermisoEspecialRel($arPermisoEspecial);
                            $arUsuarioPermisoEspecial->setUsuarioRel($arUsuario);
                            $arUsuarioPermisoEspecial->setPermitir(1);
                            $em->persist($arUsuarioPermisoEspecial);
                            $em->flush();
                            echo "<script languaje='javascript' type='text/javascript'>window.close();window.opener.location.reload();</script>";
                        }
                    }
                }
            }
        }
        $arPermisosEspeciales = $em->getRepository('SeguridadBundle:SegPermisoEspecial')->findBy(array(), array('modulo' => 'ASC'));
        return $this->render('SeguridadBundle:Usuarios:detalleNuevoPermisoEspecial.html.twig', array(
                    'arPermisosEspeciales' => $arPermisosEspeciales,
                    'form' => $form->createView()));
    }

    /**
     * @Route("usuario/detalle/permiso/documento/nuevo/{codigoUsuario}/", name="brs_seg_admin_usuario_detalle_nuevo_documento")
     */
    public function detalleNuevoPermisoDocumentoAction(Request $request, $codigoUsuario) {
        $em = $this->getDoctrine()->getManager();
        $objMensaje = new GeneralBundle\MisClases\Mensajes();
        $paginator = $this->get('knp_paginator');
        $form = $this->formularioSegDocumento();
        $form->handleRequest($request);
        $this->listarSegDocumento();
        if ($form->isValid()) {
            if ($form->get('BtnFiltrar')) {
                $this->filtrarListaSegDocumento($form);
                $this->listarSegDocumento();
            }
            if ($form->get('BtnGuardar')->isClicked()) {
                $arrSeleccionados = $request->request->get('ChkSeleccionar');
                $arDatos = $form->getData();
                if (count($arrSeleccionados) > 0) {
                    foreach ($arrSeleccionados AS $codigoDocumento) {
                        $arUsuarioPermisoDocumentoValidar = new SeguridadBundle\Entity\SegPermisoDocumento();
                        $arUsuarioPermisoDocumentoValidar = $em->getRepository('SeguridadBundle:SegPermisoDocumento')->findBy(array('codigoUsuarioFk' => $codigoUsuario, 'codigoDocumentoFk' => $codigoDocumento));
                        if (!$arUsuarioPermisoDocumentoValidar) {
                            $arUsuario = $em->getRepository('SeguridadBundle:User')->find($codigoUsuario);
                            $arDocumento = $em->getRepository('SeguridadBundle:SegDocumento')->find($codigoDocumento);
                            $arUsuarioPermisoDocumento = new SeguridadBundle\Entity\SegPermisoDocumento();
                            $arUsuarioPermisoDocumento->setDocumentoRel($arDocumento);
                            $arUsuarioPermisoDocumento->setUsuarioRel($arUsuario);
                            $arUsuarioPermisoDocumento->setIngreso($arDatos['ingreso']);
                            $arUsuarioPermisoDocumento->setNuevo($arDatos['nuevo']);
                            $arUsuarioPermisoDocumento->setEditar($arDatos['editar']);
                            $arUsuarioPermisoDocumento->setEliminar($arDatos['eliminar']);
                            $arUsuarioPermisoDocumento->setAutorizar($arDatos['autorizar']);
                            $arUsuarioPermisoDocumento->setDesautorizar($arDatos['desautorizar']);
                            $arUsuarioPermisoDocumento->setAprobar($arDatos['aprobar']);
                            $arUsuarioPermisoDocumento->setDesaprobar($arDatos['desaprobar']);
                            $arUsuarioPermisoDocumento->setAnular($arDatos['anular']);
                            $arUsuarioPermisoDocumento->setDesanular($arDatos['desanular']);
                            $arUsuarioPermisoDocumento->setImprimir($arDatos['imprimir']);
                            $em->persist($arUsuarioPermisoDocumento);
                        }
                    }
                    $em->flush();
                    echo "<script languaje='javascript' type='text/javascript'>window.close();window.opener.location.reload();</script>";
                } else {
                    $objMensaje->Mensaje("error", "No selecciono ningun dato para grabar");
                }
            }
        }
        $arDocumentos = $paginator->paginate($em->createQuery($this->strDqlListaSegDocumento), $request->query->get('page', 1), 500);
        return $this->render('SeguridadBundle:Usuarios:detalleNuevoPermisoDocumento.html.twig', array(
                    'arDocumentos' => $arDocumentos,
                    'form' => $form->createView()
        ));
    }

    /**
     * @Route("usuario/detalle/permiso/documento/editar/{codigoPermisoDocumento}/", name="brs_seg_usuario_detalle_permiso_documento_editar")
     */
    public function detallePermisoDocumentoEditarAction(Request $request, $codigoPermisoDocumento) {
        $objMensaje = new GeneralBundle\MisClases\Mensajes();
        $em = $this->getDoctrine()->getManager();
        $arPermisoDocumento = new SeguridadBundle\Entity\SegPermisoDocumento();
        if ($codigoPermisoDocumento != 0) {
            $arPermisoDocumento = $em->getRepository('SeguridadBundle:SegPermisoDocumento')->find($codigoPermisoDocumento);
        }
        $form = $this->createForm(SegPermisoDocumentoType::class, $arPermisoDocumento);
        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($form->get('guardar')->isClicked()) {
                $arPermisoDocumento = $form->getData();
                $em->persist($arPermisoDocumento);
                $em->flush();
                echo "<script languaje='javascript' type='text/javascript'>window.close();window.opener.location.reload();</script>";
            }
        }
        return $this->render('SeguridadBundle:Usuarios:detalleEditarPermisoDocumento.html.twig', array(
                    'form' => $form->createView()));
    }

    /**
     * @Route("usuario/detalle/rol/nuevo/{codigoUsuario}/", name="usuario_detalle_rol_nuevo")
     */
    public function detalleNuevoRolAction(Request $request, $codigoUsuario) {
        
        $em = $this->getDoctrine()->getManager();
        $arRoles = $em->getRepository('SeguridadBundle:SegRoles')->findAll();
        $form = $this->createFormBuilder()
                ->add('BtnGuardar', SubmitType::class, array('label' => 'Guardar',))
                ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($form->get('BtnGuardar')->isClicked()) {
                $arrSeleccionados = $request->request->get('ChkSeleccionar');
                if (count($arrSeleccionados) > 0) {
                    foreach ($arrSeleccionados AS $codigoRol) {
                        $arUsuario = $em->getRepository('SeguridadBundle:User')->find($codigoUsuario);
                        $arRol = $em->getRepository('SeguridadBundle:SegRoles')->find($codigoRol);
                        $arUsuarioRolValidar = new \SeguridadBundle\Entity\SegUsuarioRol();
                        $arUsuarioRolValidar = $em->getRepository('SeguridadBundle:SegUsuarioRol')->findBy(array('codigoUsuarioFk' => $codigoUsuario, 'codigoRolFk' => $codigoRol));
                        if (!$arUsuarioRolValidar) {
                            $arUsuarioRol = new \SeguridadBundle\Entity\SegUsuarioRol();
                            $arUsuarioRol->setRolRel($arRol);
                            $arUsuarioRol->setUsuarioRel($arUsuario);
                            $em->persist($arUsuarioRol);
                        }
                    }
                    $em->flush();
                    echo "<script languaje='javascript' type='text/javascript'>window.close();window.opener.location.reload();</script>";
                } else {
                    $objMensaje->Mensaje("error", "No selecciono ningun dato para grabar");
                }
            }
        }
        return $this->render('SeguridadBundle:Usuarios:detalleNuevoRol.html.twig', array(
                    'arRoles' => $arRoles,
                    'form' => $form->createView()));
    }

    /**
     * @Route("usuario/cambiar/clave/admin/{codigoUsuario}", name="admin_usuario_cambiar_clave")
     */
    public function cambiarClaveAction(Request $request, $codigoUsuario) {
        $em = $this->getDoctrine()->getManager();
        $formUsuario = $this->createFormBuilder()
                ->setAction($this->generateUrl('admin_usuario_cambiar_clave', array('codigoUsuario' => $codigoUsuario)))
                ->add('password', PasswordType::class)
                ->add('BtnGuardar', SubmitType::class, array('label' => 'Guardar'))
                ->getForm();
        $formUsuario->handleRequest($request);
        $arUsuario = new \SeguridadBundle\Entity\User();
        $arUsuario = $em->getRepository('SeguridadBundle:User')->find($codigoUsuario);

        if ($formUsuario->isValid()) {
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($arUsuario);
            $password = $encoder->encodePassword($formUsuario->get('password')->getData(), $arUsuario->getSalt());
            $arUsuario->setPassword($password);
            $em->persist($arUsuario);
            $em->flush();
            return $this->redirect($this->generateUrl('usuario_lista'));
        }
        return $this->render('SeguridadBundle:Usuarios:cambiarClave.html.twig', array(
                    'arUsuario' => $arUsuario,
                    'formUsuario' => $formUsuario->createView()
        ));
    }

    /**
     * @Route("usuario/cambiar/clave/usuario/{codigoUsuario}/", name="usuario_cambiar_clave")
     */
    public function cambiarClaveUsuarioAction(Request $request, $codigoUsuario) {
        $em = $this->getDoctrine()->getManager();
        $formUsuario = $this->createFormBuilder()
                ->setAction($this->generateUrl('usuario_cambiar_clave', array('codigoUsuario' => $codigoUsuario)))
                ->add('password', PasswordType::class)
                ->add('BtnGuardar', SubmitType::class, array('label' => 'Guardar'))
                ->getForm();
        $formUsuario->handleRequest($request);
        $arUsuario = new \SeguridadBundle\Entity\User();
        $arUsuario = $em->getRepository('SeguridadBundle:User')->find($codigoUsuario);

        if ($formUsuario->isValid()) {
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($arUsuario);
            $password = $encoder->encodePassword($formUsuario->get('password')->getData(), $arUsuario->getSalt());
            $arUsuario->setPassword($password);
            $arUsuario->setCambiarClave(0);
            $em->persist($arUsuario);
            $em->flush();
            return $this->redirect($this->generateUrl('usuario_lista', array('codigoUsuario' => $codigoUsuario)));
        }
        if ($arUsuario->getCambiarClave()) {
            $ruta = 'SeguridadBundle:Usuarios:cambiarClaveLogin.html.twig';
        } else {
            $ruta = 'SeguridadBundle:Usuarios:cambiarClave.html.twig';
        }
        return $this->render($ruta, array(
                    'arUsuario' => $arUsuario,
                    'formUsuario' => $formUsuario->createView()));
    }

    /**
     * @Route("usuario/nuevo/permiso/grupo/{codigoGrupo}/", name="brs_seg_admin_permiso_grupo_nuevo")
     */
    public function nuevoPermisoGrupoAction(Request $request, $codigoGrupo) {
        $em = $this->getDoctrine()->getManager();
        $arGrupo = new SeguridadBundle\Entity\SegPermisoGrupo();
        if ($codigoGrupo != "" || $codigoGrupo != 0) {
            $arGrupo = $em->getRepository('SeguridadBundle:SegGrupo')->find($codigoGrupo);
        }
        $form = $this->createForm(SegGrupoType::class, $arGrupo);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $arGrupo = $form->getData();
            $em->persist($arGrupo);
            $em->flush();
            return $this->redirect($this->generateUrl('brs_seg_admin_usuario_lista'));
        }
        return $this->render("SeguridadBundle:Usuarios:nuevoGrupo.html.twig", array(
                    'arGrupo' => $arGrupo,
                    'form' => $form->createView()));
    }

    /**
     * @Route("usuario/detalle/permiso/grupo/{codigoGrupo}/", name="brs_seg_admin_permiso_grupo_detalle")
     */
    public function detallePermisoGrupoAction(Request $request, $codigoGrupo) {
        $em = $this->getDoctrine()->getManager();
        $arGrupo = $em->getRepository('SeguridadBundle:SegGrupo')->find($codigoGrupo);
        $paginator = $this->get('knp_paginator');
        $form = $this->createFormBuilder()
                ->add('BtnEliminar', SubmitType::class, array('label' => 'Eliminar'))
                ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('BtnEliminar')->isClicked()) {
                $arrSeleccionadosPermisoEspecial = $request->request->get('ChkSeleccionarPermisoEspecial');
                $arrSeleccionadosPermisoDocumento = $request->request->get('ChkSeleccionarPermisoDocumento');
                if (count($arrSeleccionadosPermisoEspecial) > 0) {
                    $respuesta = $em->getRepository('SeguridadBundle:SegPermisoGrupo')->eliminar($arrSeleccionadosPermisoEspecial, $codigoGrupo);
                }
                if (count($arrSeleccionadosPermisoDocumento) > 0) {
                    $respuesta = $em->getRepository('SeguridadBundle:SegPermisoGrupo')->eliminar($arrSeleccionadosPermisoDocumento, $codigoGrupo);
                }
                return $this->redirect($this->generateUrl('brs_seg_admin_permiso_grupo_detalle', array('codigoGrupo' => $codigoGrupo)));
            }
        }

        $arPermisosGrupo = $paginator->paginate($em->getRepository('SeguridadBundle:SegPermisoGrupo')->findBy(array('codigoGrupoFk' => $codigoGrupo)), $request->query->get('page', 1), 500);
        return $this->render("SeguridadBundle:Usuarios:detallePermisoGrupo.html.twig", array(
                    'arPermisosGrupo' => $arPermisosGrupo,
                    'arGrupo' => $arGrupo,
                    'form' => $form->createView()));
    }

    /**
     * @Route("usuario/detalle/permiso/grupo/documento/nuevo/{codigoGrupo}/", name="brs_seg_admin_permiso_grupo_detalle_documento_nuevo")
     */
    public function detalleNuevoPermisoGrupoDocumentoAction(Request $request, $codigoGrupo) {
        $em = $this->getDoctrine()->getManager();
        $arGrupo = $em->getRepository('SeguridadBundle:SegGrupo')->find($codigoGrupo);
        $paginator = $this->get('knp_paginator');
        $form = $this->formularioSegDocumento();
        $this->filtrarListaSegDocumento($form);
        $this->listarSegDocumento();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('BtnFiltrar')) {
                $this->filtrarListaSegDocumento($form);
                $this->listarSegDocumento();
            }
            if ($form->get('BtnGuardar')->isClicked()) {
                $arrSeleccionadosDocumentos = $request->request->get('ChkSeleccionar');
                $arDatos = $form->getData();
                if (count($arrSeleccionadosDocumentos) > 0) {
                    foreach ($arrSeleccionadosDocumentos AS $codigoDocumento) {
                        //Actualizar los permisos del grupo
                        $arPermisoGrupoValidarPermisoDocumento = new SeguridadBundle\Entity\SegPermisoGrupo();
                        $arPermisoGrupoValidarPermisoDocumento = $em->getRepository('SeguridadBundle:SegPermisoGrupo')->findBy(array('codigoGrupoFk' => $codigoGrupo, 'codigoDocumentoFk' => $codigoDocumento));
                        if (!$arPermisoGrupoValidarPermisoDocumento) {
                            $arDocumento = $em->getRepository('SeguridadBundle:SegDocumento')->find($codigoDocumento);
                            $arPermisoGrupo = new SeguridadBundle\Entity\SegPermisoGrupo();
                            $arPermisoGrupo->setGrupoRel($arGrupo);
                            $arPermisoGrupo->setDocumentoRel($arDocumento);
                            $arPermisoGrupo->setIngreso($arDatos['ingreso']);
                            $arPermisoGrupo->setNuevo($arDatos['nuevo']);
                            $arPermisoGrupo->setEditar($arDatos['editar']);
                            $arPermisoGrupo->setEliminar($arDatos['eliminar']);
                            $arPermisoGrupo->setAutorizar($arDatos['autorizar']);
                            $arPermisoGrupo->setDesautorizar($arDatos['desautorizar']);
                            $arPermisoGrupo->setAprobar($arDatos['aprobar']);
                            $arPermisoGrupo->setDesaprobar($arDatos['desaprobar']);
                            $arPermisoGrupo->setAnular($arDatos['anular']);
                            $arPermisoGrupo->setDesanular($arDatos['desanular']);
                            $arPermisoGrupo->setImprimir($arDatos['imprimir']);
                            $em->persist($arPermisoGrupo);
                        }
                        //Actualizar los permisos documentos de los usuarios de el grupo seleccionado
                        $arUsuarios = $em->getRepository('SeguridadBundle:User')->findBy(array('codigoGrupoFk' => $codigoGrupo));
                        if ($arUsuarios) {
                            foreach ($arUsuarios as $arUsuario) {
                                $arUsuarioPermisoDocumentoValidar = new SeguridadBundle\Entity\SegPermisoDocumento();
                                $arUsuarioPermisoDocumentoValidar = $em->getRepository('SeguridadBundle:SegPermisoDocumento')->findBy(array('codigoUsuarioFk' => $arUsuario->getId(), 'codigoDocumentoFk' => $codigoDocumento));
                                if (!$arUsuarioPermisoDocumentoValidar) {
                                    $arDocumento = $em->getRepository('SeguridadBundle:SegDocumento')->find($codigoDocumento);
                                    $arUsuarioPermisoDocumento = new SeguridadBundle\Entity\SegPermisoDocumento();
                                    $arUsuarioPermisoDocumento->setDocumentoRel($arDocumento);
                                    $arUsuarioPermisoDocumento->setUsuarioRel($arUsuario);
                                    $arUsuarioPermisoDocumento->setIngreso($arDatos['ingreso']);
                                    $arUsuarioPermisoDocumento->setNuevo($arDatos['nuevo']);
                                    $arUsuarioPermisoDocumento->setEditar($arDatos['editar']);
                                    $arUsuarioPermisoDocumento->setEliminar($arDatos['eliminar']);
                                    $arUsuarioPermisoDocumento->setAutorizar($arDatos['autorizar']);
                                    $arUsuarioPermisoDocumento->setDesautorizar($arDatos['desautorizar']);
                                    $arUsuarioPermisoDocumento->setAprobar($arDatos['aprobar']);
                                    $arUsuarioPermisoDocumento->setDesaprobar($arDatos['desaprobar']);
                                    $arUsuarioPermisoDocumento->setAnular($arDatos['anular']);
                                    $arUsuarioPermisoDocumento->setDesanular($arDatos['desanular']);
                                    $arUsuarioPermisoDocumento->setImprimir($arDatos['imprimir']);
                                    $em->persist($arUsuarioPermisoDocumento);
                                }
                            }
                        }
                    }
                    $em->flush();
                    echo "<script languaje='javascript' type='text/javascript'>window.close();window.opener.location.reload();</script>";
                }
            }
        }

        $arDocumentos = $paginator->paginate($em->createQuery($this->strDqlListaSegDocumento), $request->query->get('page', 1), 500);
        return $this->render("SeguridadBundle:Usuarios:detalleNuevoPermisoDocumento.html.twig", array(
                    'arDocumentos' => $arDocumentos,
                    'form' => $form->createView()));
    }

    /**
     * @Route("usuario/detalle/permiso/grupo/especial/nuevo/{codigoGrupo}/", name="brs_seg_admin_permiso_grupo_detalle_especial_nuevo")
     */
    public function detalleNuevoPermisoGrupoEspecialAction(Request $request, $codigoGrupo) {
        $em = $this->getDoctrine()->getManager();
        $arGrupo = $em->getRepository('SeguridadBundle:SegGrupo')->find($codigoGrupo);
        $paginator = $this->get('knp_paginator');
        $form = $this->createFormBuilder()
                ->add('guardar', SubmitType::class, array('label' => 'Guardar'))
                ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('guardar')->isClicked()) {
                $arrSeleccionadosPermisoEspecial = $request->request->get('ChkSeleccionar');
                $arDatos = $form->getData();
                if (count($arrSeleccionadosPermisoEspecial) > 0) {
                    foreach ($arrSeleccionadosPermisoEspecial AS $codigoPermisoEspecial) {
                        //Actualizar los permisos especiales del grupo
                        $arUsuarioPermisoGrupoValidarPermisoEspecial = new SeguridadBundle\Entity\SegPermisoGrupo();
                        $arUsuarioPermisoGrupoValidarPermisoEspecial = $em->getRepository('SeguridadBundle:SegPermisoGrupo')->findBy(array('codigoGrupoFk' => $codigoGrupo, 'codigoPermisoEspecialFk' => $codigoPermisoEspecial));
                        if (!$arUsuarioPermisoGrupoValidarPermisoEspecial) {
                            $arPermisoEspecial = $em->getRepository('SeguridadBundle:SegPermisoEspecial')->find($codigoPermisoEspecial);
                            $arPermisoGrupo = new SeguridadBundle\Entity\SegPermisoGrupo();
                            $arPermisoGrupo->setCodigoPermisoEspecialFk($arPermisoEspecial->getCodigoPermisoEspecialPk());
                            $arPermisoGrupo->setGrupoRel($arGrupo);
                            $arPermisoGrupo->setPermisoEspecialRel($arPermisoEspecial);
                            $arPermisoGrupo->setPermitir(1);
                            $em->persist($arPermisoGrupo);
                        }
                        //Actualizar los permisos especiales de los usuarios del grupo
                        $arUsuarios = $em->getRepository('SeguridadBundle:User')->findBy(array('codigoGrupoFk' => $codigoGrupo));
                        if ($arUsuarios) {
                            foreach ($arUsuarios as $arUsuario) {
                                $arUsuarioPermisoEspecialValidar = new SeguridadBundle\Entity\SegUsuarioPermisoEspecial();
                                $arUsuarioPermisoEspecialValidar = $em->getRepository('SeguridadBundle:SegUsuarioPermisoEspecial')->findBy(array('codigoUsuarioFk' => $arUsuario->getId(), 'codigoPermisoEspecialFk' => $codigoPermisoEspecial));
                                if (!$arUsuarioPermisoEspecialValidar) {
                                    $arPermisoEspecial = new SeguridadBundle\Entity\SegPermisoEspecial();
                                    $arPermisoEspecial = $em->getRepository('SeguridadBundle:SegPermisoEspecial')->find($codigoPermisoEspecial);
                                    $arUsuarioPermisoEspecial = new SeguridadBundle\Entity\SegUsuarioPermisoEspecial();
                                    $arUsuarioPermisoEspecial->setPermisoEspecialRel($arPermisoEspecial);
                                    $arUsuarioPermisoEspecial->setUsuarioRel($arUsuario);
                                    $arUsuarioPermisoEspecial->setPermitir(1);
                                    $em->persist($arUsuarioPermisoEspecial);
                                }
                            }
                        }
                    }
                    $em->flush();
                    echo "<script languaje='javascript' type='text/javascript'>window.close();window.opener.location.reload();</script>";
                }
            }
        }
        $arPermisosEspeciales = $em->getRepository('SeguridadBundle:SegPermisoEspecial')->findBy(array(), array('modulo' => 'ASC'));
        return $this->render("SeguridadBundle:Usuarios:detalleNuevoPermisoEspecial.html.twig", array(
                    'arPermisosEspeciales' => $arPermisosEspeciales,
                    'form' => $form->createView()));
    }

    public function recuperarAction() {
        $em = $this->getDoctrine()->getManager();
        $form = $this->formularioRecuperar();
        $form->handleRequest($request);
        if ($form->isValid()) {
            return $this->redirect($this->generateUrl('login'));
        }
        return $this->render('SeguridadBundle:Usuarios:recuperar.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    private function listar() {
        $em = $this->getDoctrine()->getManager();
        $this->strDqlLista = $em->getRepository('SeguridadBundle:User')->listaDql();
    }

    private function listarSegDocumento() {
        $em = $this->getDoctrine()->getManager();
        $session = new session;
        $this->strDqlListaSegDocumento = $em->getRepository('SeguridadBundle:SegDocumento')->listaDql(
                $session->get('filtroTipo'), $session->get('filtroModulo'));
    }

    private function formularioRecuperar() {
        $em = $this->getDoctrine()->getManager();
        $session = new Session;
        $form = $this->createFormBuilder()
                ->add('username', TextType::class, array('label' => 'Numero', 'data' => ""))
                ->add('BtnRecuperar', SubmitType::class, array('label' => 'Recuperar'))
                ->getForm();
        return $form;
    }

    private function formularioLista() {
        $em = $this->getDoctrine()->getManager();
        $session = new Session;
        $form = $this->createFormBuilder()
                ->add('TxtNumero', TextType::class, array('label' => 'Numero', 'data' => ""))
                ->add('BtnFiltrar', SubmitType::class, array('label' => 'Filtrar'))
                ->getForm();
        return $form;
    }

    private function formularioSegDocumento() {
        $em = $this->getDoctrine()->getManager();
        $session = new Session;
        $form = $this->createFormBuilder()
                ->add('ingreso', CheckboxType::class, array('required' => false))
                ->add('nuevo', CheckboxType::class, array('required' => false))
                ->add('editar', CheckboxType::class, array('required' => false))
                ->add('eliminar', CheckboxType::class, array('required' => false))
                ->add('autorizar', CheckboxType::class, array('required' => false))
                ->add('desautorizar', CheckboxType::class, array('required' => false))
                ->add('aprobar', CheckboxType::class, array('required' => false))
                ->add('desaprobar', CheckboxType::class, array('required' => false))
                ->add('anular', CheckboxType::class, array('required' => false))
                ->add('imprimir', CheckboxType::class, array('required' => false))
                ->add('desanular', CheckboxType::class, array('required' => false))
                ->add('TxtModulo', TextType::class, array('required' => false, 'data' => $session->get('filtroModulo')))
                ->add('TxtTipo', TextType::class, array('required' => false, 'data' => $session->get('filtroTipo')))
                ->add('BtnFiltrar', SubmitType::class, array('label' => 'filtrar'))
                ->add('BtnGuardar', SubmitType::class, array('label' => 'Guardar'))
                ->getForm();
        return $form;
    }

    private function filtrarListaSegDocumento($form) {
        $session = new Session;
        $session->set('filtroTipo', $form->get('TxtTipo')->getData());
        $session->set('filtroModulo', $form->get('TxtModulo')->getData());
    }

}
