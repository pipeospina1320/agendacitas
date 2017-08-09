<?php

namespace SeguridadBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SegPermisoGrupoRepository extends EntityRepository {

    public function asignarPermisosUsuario($codigoGrupo = "", $arUsuario = "") {
        $repuesta = "";
        if ($codigoGrupo != "") {
            $em = $this->getEntityManager();
            $arPermisosGrupoDocumentos = new SeguridadBundle\Entity\SegPermisoGrupo();
            $arPermisosGrupoDocumentos = $em->getRepository('SeguridadBundle:SegPermisoGrupo')->findBy(array('codigoGrupoFk' => $codigoGrupo, 'codigoPermisoEspecialFk' => null));
            $arPermisosGrupoPermisoEspecial = new SeguridadBundle\Entity\SegPermisoGrupo();
            $arPermisosGrupoPermisoEspecial = $em->getRepository('SeguridadBundle:SegPermisoGrupo')->findBy(array('codigoGrupoFk' => $codigoGrupo, 'codigoDocumentoFk' => null));
            foreach ($arPermisosGrupoDocumentos AS $arPermisoGrupoDocumento) {
                $arUsuarioPermisoDocumentoValidar = new SeguridadBundle\Entity\SegPermisoDocumento();
                $arUsuarioPermisoDocumentoValidar = $em->getRepository('SeguridadBundle:SegPermisoDocumento')->findBy(array('codigoUsuarioFk' => $arUsuario->getId(), 'codigoDocumentoFk' => $arPermisoGrupoDocumento->getCodigoDocumentoFk()));
                if (!$arUsuarioPermisoDocumentoValidar) {
                    $arDocumento = $em->getRepository('SeguridadBundle:SegDocumento')->find($arPermisoGrupoDocumento->getCodigoDocumentoFk());
                    $arUsuarioPermisoDocumento = new SeguridadBundle\Entity\SegPermisoDocumento();
                    $arUsuarioPermisoDocumento->setDocumentoRel($arDocumento);
                    $arUsuarioPermisoDocumento->setUsuarioRel($arUsuario);
                    $arUsuarioPermisoDocumento->setIngreso($arPermisoGrupoDocumento->getIngreso());
                    $arUsuarioPermisoDocumento->setNuevo($arPermisoGrupoDocumento->getNuevo());
                    $arUsuarioPermisoDocumento->setEditar($arPermisoGrupoDocumento->getEditar());
                    $arUsuarioPermisoDocumento->setEliminar($arPermisoGrupoDocumento->getEliminar());
                    $arUsuarioPermisoDocumento->setAutorizar($arPermisoGrupoDocumento->getAutorizar());
                    $arUsuarioPermisoDocumento->setDesautorizar($arPermisoGrupoDocumento->getDesautorizar());
                    $arUsuarioPermisoDocumento->setAprobar($arPermisoGrupoDocumento->getAprobar());
                    $arUsuarioPermisoDocumento->setDesaprobar($arPermisoGrupoDocumento->getDesaprobar());
                    $arUsuarioPermisoDocumento->setAnular($arPermisoGrupoDocumento->getAnular());
                    $arUsuarioPermisoDocumento->setDesanular($arPermisoGrupoDocumento->getDesanular());
                    $arUsuarioPermisoDocumento->setImprimir($arPermisoGrupoDocumento->getImprimir());
                    $em->persist($arUsuarioPermisoDocumento);
                }
            }
            foreach ($arPermisosGrupoPermisoEspecial AS $arPermisoGrupoPermisoEspecial) {
                $arUsuarioPermisoEspecialValidar = new SeguridadBundle\Entity\SegUsuarioPermisoEspecial();
                $arUsuarioPermisoEspecialValidar = $em->getRepository('SeguridadBundle:SegUsuarioPermisoEspecial')->findBy(array('codigoUsuarioFk' => $arUsuario->getId(), 'codigoPermisoEspecialFk' => $arPermisoGrupoPermisoEspecial->getCodigoPermisoEspecialFk()));
                if (!$arUsuarioPermisoEspecialValidar) {
                    $arPermisoEspecial = new SeguridadBundle\Entity\SegPermisoEspecial();
                    $arPermisoEspecial = $em->getRepository('SeguridadBundle:SegPermisoEspecial')->find($arPermisoGrupoPermisoEspecial->getCodigoPermisoEspecialFk());
                    $arUsuarioPermisoEspecial = new SeguridadBundle\Entity\SegUsuarioPermisoEspecial();
                    $arUsuarioPermisoEspecial->setPermisoEspecialRel($arPermisoEspecial);
                    $arUsuarioPermisoEspecial->setUsuarioRel($arUsuario);
                    $arUsuarioPermisoEspecial->setPermitir($arPermisoGrupoPermisoEspecial->getPermitir());
                    $em->persist($arUsuarioPermisoEspecial);
                }
            }
            $em->flush();
        } else {
            $respuesta = "Ocurrio un error asignando los permisos";
        }
        return $repuesta;
    }

    public function eliminar($arrSeleccionados, $codigoGrupo = "") {
        $respuesta = "";
        $em = $this->getEntityManager();
        foreach ($arrSeleccionados as $codigo) {
            $arPermisoGrupo = new SeguridadBundle\Entity\SegPermisoGrupo();
            $arPermisoGrupo = $em->getRepository('SeguridadBundle:SegPermisoGrupo')->find($codigo);
            if ($codigoGrupo != "") {
                $arUsuario = new SeguridadBundle\Entity\User();
                $arUsuarios = $em->getRepository('SeguridadBundle:User')->findBy(array('codigoGrupoFk' => $codigoGrupo));
                if ($arUsuarios) {
                    foreach ($arUsuarios as $arUsuario) {
                        //eliminar los permisos documentos del usuario
                        if ($arPermisoGrupo->getCodigoDocumentoFk()) {
                            $arPermisoDocumento = new SeguridadBundle\Entity\SegPermisoDocumento();
                            $arPermisoDocumento = $em->getRepository('SeguridadBundle:SegPermisoDocumento')->findOneBy(array('codigoDocumentoFk' => $arPermisoGrupo->getCodigoDocumentoFk(), 'codigoUsuarioFk' => $arUsuario->getId()));
                            if ($arPermisoDocumento) {
                                $em->remove($arPermisoDocumento);
                            }
                        }
                        //eliminar los permisos especiales del usuario
                        if ($arPermisoGrupo->getCodigoPermisoEspecialFk()) {
                            $arUsuarioPermisoEspecial = new SeguridadBundle\Entity\SegUsuarioPermisoEspecial();
                            $arUsuarioPermisoEspecial = $em->getRepository('SeguridadBundle:SegUsuarioPermisoEspecial')->findOneBy(array('codigoPermisoEspecialFk' => $arPermisoGrupo->getCodigoPermisoEspecialFk(), 'codigoUsuarioFk' => $arUsuario->getId()));
                            if ($arUsuarioPermisoEspecial) {
                                $em->remove($arUsuarioPermisoEspecial);
                            }
                        }
                    }
                }
            }
            $em->remove($arPermisoGrupo);
        }
        $em->flush();

        return $respuesta;
    }

}