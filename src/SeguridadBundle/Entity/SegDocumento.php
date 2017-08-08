<?php

namespace SeguridadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="seg_documento")
 * @ORM\Entity(repositoryClass="SeguridadBundle\Repository\SegDocumentoRepository")
 */
class SegDocumento {

    /**
     * @ORM\Id
     * @ORM\Column(name="codigo_documento_pk", type="integer")
     */
    private $codigoDocumentoPk;

    /**
     * @ORM\Column(name="nombre", type="string", length=50, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(name="tipo", type="string", length=30, nullable=true)
     */
    private $tipo;

    /**
     * @ORM\Column(name="modulo", type="string", length=30, nullable=true)
     */
    private $modulo;

    /**
     * @ORM\OneToMany(targetEntity="SegPermisoDocumento", mappedBy="documentoRel")
     */
    protected $permisosDocumentosDocumentoRel;

    /**
     * @ORM\OneToMany(targetEntity="SegPermisoGrupo", mappedBy="documentoRel")
     */
    protected $permisosGruposDocumentoRel;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->permisosDocumentosDocumentoRel = new \Doctrine\Common\Collections\ArrayCollection();
        $this->permisosGruposDocumentoRel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set codigoDocumentoPk
     *
     * @param integer $codigoDocumentoPk
     *
     * @return SegDocumento
     */
    public function setCodigoDocumentoPk($codigoDocumentoPk)
    {
        $this->codigoDocumentoPk = $codigoDocumentoPk;

        return $this;
    }

    /**
     * Get codigoDocumentoPk
     *
     * @return integer
     */
    public function getCodigoDocumentoPk()
    {
        return $this->codigoDocumentoPk;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return SegDocumento
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return SegDocumento
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set modulo
     *
     * @param string $modulo
     *
     * @return SegDocumento
     */
    public function setModulo($modulo)
    {
        $this->modulo = $modulo;

        return $this;
    }

    /**
     * Get modulo
     *
     * @return string
     */
    public function getModulo()
    {
        return $this->modulo;
    }

    /**
     * Add permisosDocumentosDocumentoRel
     *
     * @param \SeguridadBundle\Entity\SegPermisoDocumento $permisosDocumentosDocumentoRel
     *
     * @return SegDocumento
     */
    public function addPermisosDocumentosDocumentoRel(\SeguridadBundle\Entity\SegPermisoDocumento $permisosDocumentosDocumentoRel)
    {
        $this->permisosDocumentosDocumentoRel[] = $permisosDocumentosDocumentoRel;

        return $this;
    }

    /**
     * Remove permisosDocumentosDocumentoRel
     *
     * @param \SeguridadBundle\Entity\SegPermisoDocumento $permisosDocumentosDocumentoRel
     */
    public function removePermisosDocumentosDocumentoRel(\SeguridadBundle\Entity\SegPermisoDocumento $permisosDocumentosDocumentoRel)
    {
        $this->permisosDocumentosDocumentoRel->removeElement($permisosDocumentosDocumentoRel);
    }

    /**
     * Get permisosDocumentosDocumentoRel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPermisosDocumentosDocumentoRel()
    {
        return $this->permisosDocumentosDocumentoRel;
    }

    /**
     * Add permisosGruposDocumentoRel
     *
     * @param \SeguridadBundle\Entity\SegPermisoGrupo $permisosGruposDocumentoRel
     *
     * @return SegDocumento
     */
    public function addPermisosGruposDocumentoRel(\SeguridadBundle\Entity\SegPermisoGrupo $permisosGruposDocumentoRel)
    {
        $this->permisosGruposDocumentoRel[] = $permisosGruposDocumentoRel;

        return $this;
    }

    /**
     * Remove permisosGruposDocumentoRel
     *
     * @param \SeguridadBundle\Entity\SegPermisoGrupo $permisosGruposDocumentoRel
     */
    public function removePermisosGruposDocumentoRel(\SeguridadBundle\Entity\SegPermisoGrupo $permisosGruposDocumentoRel)
    {
        $this->permisosGruposDocumentoRel->removeElement($permisosGruposDocumentoRel);
    }

    /**
     * Get permisosGruposDocumentoRel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPermisosGruposDocumentoRel()
    {
        return $this->permisosGruposDocumentoRel;
    }
}
