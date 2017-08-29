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
     * @ORM\Column(name="codigo_marca_articulo_fk", type="integer", length=11, nullable=true)
     */
    private $codigoMarcaArticuloFk;

    /**
     * @ORM\Column(name="codigo_grupo_articulo_fk", type="integer",length=11, nullable=true)
     */
    private $codigoGrupodArticuloFk;

    /**
     * @ORM\Column(name="codigo_unidad_manejo_fk", type="integer",length=11, nullable=true)
     */
    private $codigoUnidadManejoFk;

    /**
     * @ORM\Column(name="codigo_tarifa_iva_fk", type="integer",length=11, nullable=true)
     */
    private $codigoTarifaIvaFk;

    /**
     * @ORM\Column(name="descripcion_articulo", type="string", nullable=true)
     */
    private $descripcionArticulo;

    /**
     * @ORM\Column(name="iva_incluido", type="boolean", nullable=true)
     */
    private $ivaIncluido = true;

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
     * @ORM\Column(name="precio_1", type="string", nullable=true)
     */
    private $precio1;

    /**
     * @ORM\Column(name="precio_2", type="string", nullable=true)
     */
    private $precio2;

    /**
     * @ORM\Column(name="precio_3", type="string", nullable=true)
     */
    private $precio3;

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
     * @ORM\ManyToOne(targetEntity="GrupoArticulo", inversedBy="codigoGrupoArticuloPk")
     * @ORM\JoinColumn(name="codigo_grupo_articulo_fk", referencedColumnName="codigo_grupo_articulo_pk")
     */
    private $grupoArticuloRel;

    /**
     * @ORM\ManyToOne(targetEntity="ContabilidadBundle\Entity\TarifaIva", inversedBy="tarifaIvaRel")
     * @ORM\JoinColumn(name="codigo_tarifa_iva_fk", referencedColumnName="codigo_tarifa_iva_pk")
     */
    private $tarifaIvaRel;

    

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
     * Set codigoMarcaArticuloFk
     *
     * @param integer $codigoMarcaArticuloFk
     *
     * @return Articulo
     */
    public function setCodigoMarcaArticuloFk($codigoMarcaArticuloFk)
    {
        $this->codigoMarcaArticuloFk = $codigoMarcaArticuloFk;

        return $this;
    }

    /**
     * Get codigoMarcaArticuloFk
     *
     * @return integer
     */
    public function getCodigoMarcaArticuloFk()
    {
        return $this->codigoMarcaArticuloFk;
    }

    /**
     * Set codigoGrupodArticuloFk
     *
     * @param integer $codigoGrupodArticuloFk
     *
     * @return Articulo
     */
    public function setCodigoGrupodArticuloFk($codigoGrupodArticuloFk)
    {
        $this->codigoGrupodArticuloFk = $codigoGrupodArticuloFk;

        return $this;
    }

    /**
     * Get codigoGrupodArticuloFk
     *
     * @return integer
     */
    public function getCodigoGrupodArticuloFk()
    {
        return $this->codigoGrupodArticuloFk;
    }

    /**
     * Set codigoUnidadManejoFk
     *
     * @param integer $codigoUnidadManejoFk
     *
     * @return Articulo
     */
    public function setCodigoUnidadManejoFk($codigoUnidadManejoFk)
    {
        $this->codigoUnidadManejoFk = $codigoUnidadManejoFk;

        return $this;
    }

    /**
     * Get codigoUnidadManejoFk
     *
     * @return integer
     */
    public function getCodigoUnidadManejoFk()
    {
        return $this->codigoUnidadManejoFk;
    }

    /**
     * Set codigoTarifaIvaFk
     *
     * @param integer $codigoTarifaIvaFk
     *
     * @return Articulo
     */
    public function setCodigoTarifaIvaFk($codigoTarifaIvaFk)
    {
        $this->codigoTarifaIvaFk = $codigoTarifaIvaFk;

        return $this;
    }

    /**
     * Get codigoTarifaIvaFk
     *
     * @return integer
     */
    public function getCodigoTarifaIvaFk()
    {
        return $this->codigoTarifaIvaFk;
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
     * Set ivaIncluido
     *
     * @param boolean $ivaIncluido
     *
     * @return Articulo
     */
    public function setIvaIncluido($ivaIncluido)
    {
        $this->ivaIncluido = $ivaIncluido;

        return $this;
    }

    /**
     * Get ivaIncluido
     *
     * @return boolean
     */
    public function getIvaIncluido()
    {
        return $this->ivaIncluido;
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
     * Set precio1
     *
     * @param string $precio1
     *
     * @return Articulo
     */
    public function setPrecio1($precio1)
    {
        $this->precio1 = $precio1;

        return $this;
    }

    /**
     * Get precio1
     *
     * @return string
     */
    public function getPrecio1()
    {
        return $this->precio1;
    }

    /**
     * Set precio2
     *
     * @param string $precio2
     *
     * @return Articulo
     */
    public function setPrecio2($precio2)
    {
        $this->precio2 = $precio2;

        return $this;
    }

    /**
     * Get precio2
     *
     * @return string
     */
    public function getPrecio2()
    {
        return $this->precio2;
    }

    /**
     * Set precio3
     *
     * @param string $precio3
     *
     * @return Articulo
     */
    public function setPrecio3($precio3)
    {
        $this->precio3 = $precio3;

        return $this;
    }

    /**
     * Get precio3
     *
     * @return string
     */
    public function getPrecio3()
    {
        return $this->precio3;
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
     * Set tarifaIvaRel
     *
     * @param \ContabilidadBundle\Entity\TarifaIva $tarifaIvaRel
     *
     * @return Articulo
     */
    public function setTarifaIvaRel(\ContabilidadBundle\Entity\TarifaIva $tarifaIvaRel = null)
    {
        $this->tarifaIvaRel = $tarifaIvaRel;

        return $this;
    }

    /**
     * Get tarifaIvaRel
     *
     * @return \ContabilidadBundle\Entity\TarifaIva
     */
    public function getTarifaIvaRel()
    {
        return $this->tarifaIvaRel;
    }
}
