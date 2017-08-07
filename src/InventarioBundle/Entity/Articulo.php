<?php

namespace InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="inv_articulos")
 * @ORM\Entity(repositoryClass="InventarioBundle\Repository\ArticuloRepository")
 */
class Articulo {

    /**
     * @ORM\Id
     * @ORM\Column(name="codigo_articulo_pk", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoArticuloPk;

    /**
     * @ORM\Column(name="codigo_articulo", type="string", nullable=true)
     */
    private $codigoArticulo;
    
    /**
     * @ORM\Column(name="maneja_kardex", type="boolean", nullable=true)
     */
    private $manejaKardex = true;

    /**
     * @ORM\Column(name="estado_activo", type="boolean", nullable=true)
     */
    private $estadoActivo = true;
    
    
    /**
     * @ORM\Column(name="codigo_barras", type="string", nullable=true)
     */
    private $codigoBarras;

    /**
     * @ORM\Column(name="nombre_articulo", type="string", nullable=true)
     */
    private $nombreArticulo;

    /**
     * @ORM\Column(name="descripcion_articulo", type="string", nullable=true)
     */
    private $descripcionArticulo;

    /**
     * @ORM\ManyToOne(targetEntity="MarcaArticulo", inversedBy="marcaArticuloRel")
     * @ORM\JoinColumn(name="codigo_marca_articulo_fk", referencedColumnName="codigo_marca_articulo_pk")
     */
    private $marcaArticuloRel;

    /**
     * @ORM\ManyToOne(targetEntity="UnidadManejo", inversedBy="unidadManejoRel")
     * @ORM\JoinColumn(name="codigo_unidad_manejo_fk", referencedColumnName="codigo_unidad_manejo_pk")
     */
    private $unidadManejoRel;

    /**
     * @ORM\ManyToOne(targetEntity="GrupoArticulo", inversedBy="grupoArticuloRel")
     * @ORM\JoinColumn(name="codigo_grupo_articulo_fk", referencedColumnName="codigo_grupo_articulo_pk")
     */
    private $grupoArticuloRel;


    /**
     * Get codigoArticuloPk
     *
     * @return integer
     */
    public function getCodigoArticuloPk()
    {
        return $this->codigoArticuloPk;
    }

    /**
     * Set codigoArticulo
     *
     * @param string $codigoArticulo
     *
     * @return Articulo
     */
    public function setCodigoArticulo($codigoArticulo)
    {
        $this->codigoArticulo = $codigoArticulo;

        return $this;
    }

    /**
     * Get codigoArticulo
     *
     * @return string
     */
    public function getCodigoArticulo()
    {
        return $this->codigoArticulo;
    }

    /**
     * Set codigoBarras
     *
     * @param string $codigoBarras
     *
     * @return Articulo
     */
    public function setCodigoBarras($codigoBarras)
    {
        $this->codigoBarras = $codigoBarras;

        return $this;
    }

    /**
     * Get codigoBarras
     *
     * @return string
     */
    public function getCodigoBarras()
    {
        return $this->codigoBarras;
    }

    /**
     * Set nombreArticulo
     *
     * @param string $nombreArticulo
     *
     * @return Articulo
     */
    public function setNombreArticulo($nombreArticulo)
    {
        $this->nombreArticulo = $nombreArticulo;

        return $this;
    }

    /**
     * Get nombreArticulo
     *
     * @return string
     */
    public function getNombreArticulo()
    {
        return $this->nombreArticulo;
    }

    /**
     * Set descripcionArticulo
     *
     * @param string $descripcionArticulo
     *
     * @return Articulo
     */
    public function setDescripcionArticulo($descripcionArticulo)
    {
        $this->descripcionArticulo = $descripcionArticulo;

        return $this;
    }

    /**
     * Get descripcionArticulo
     *
     * @return string
     */
    public function getDescripcionArticulo()
    {
        return $this->descripcionArticulo;
    }

    /**
     * Set marcaArticuloRel
     *
     * @param \InventarioBundle\Entity\MarcaArticulo $marcaArticuloRel
     *
     * @return Articulo
     */
    public function setMarcaArticuloRel(\InventarioBundle\Entity\MarcaArticulo $marcaArticuloRel = null)
    {
        $this->marcaArticuloRel = $marcaArticuloRel;

        return $this;
    }

    /**
     * Get marcaArticuloRel
     *
     * @return \InventarioBundle\Entity\MarcaArticulo
     */
    public function getMarcaArticuloRel()
    {
        return $this->marcaArticuloRel;
    }

    /**
     * Set unidadManejoRel
     *
     * @param \InventarioBundle\Entity\UnidadManejo $unidadManejoRel
     *
     * @return Articulo
     */
    public function setUnidadManejoRel(\InventarioBundle\Entity\UnidadManejo $unidadManejoRel = null)
    {
        $this->unidadManejoRel = $unidadManejoRel;

        return $this;
    }

    /**
     * Get unidadManejoRel
     *
     * @return \InventarioBundle\Entity\UnidadManejo
     */
    public function getUnidadManejoRel()
    {
        return $this->unidadManejoRel;
    }

    /**
     * Set grupoArticuloRel
     *
     * @param \InventarioBundle\Entity\GrupoArticulo $grupoArticuloRel
     *
     * @return Articulo
     */
    public function setGrupoArticuloRel(\InventarioBundle\Entity\GrupoArticulo $grupoArticuloRel = null)
    {
        $this->grupoArticuloRel = $grupoArticuloRel;

        return $this;
    }

    /**
     * Get grupoArticuloRel
     *
     * @return \InventarioBundle\Entity\GrupoArticulo
     */
    public function getGrupoArticuloRel()
    {
        return $this->grupoArticuloRel;
    }

    /**
     * Set manejaKardex
     *
     * @param boolean $manejaKardex
     *
     * @return Articulo
     */
    public function setManejaKardex($manejaKardex)
    {
        $this->manejaKardex = $manejaKardex;

        return $this;
    }

    /**
     * Get manejaKardex
     *
     * @return boolean
     */
    public function getManejaKardex()
    {
        return $this->manejaKardex;
    }

    /**
     * Set estadoActivo
     *
     * @param boolean $estadoActivo
     *
     * @return Articulo
     */
    public function setEstadoActivo($estadoActivo)
    {
        $this->estadoActivo = $estadoActivo;

        return $this;
    }

    /**
     * Get estadoActivo
     *
     * @return boolean
     */
    public function getEstadoActivo()
    {
        return $this->estadoActivo;
    }
}
