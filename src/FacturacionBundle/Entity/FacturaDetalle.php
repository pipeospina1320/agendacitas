<?php

namespace FacturacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  Movimietos Facturas Detalle
 * 
 * @ORM\Table(name="factura_detalle")
 * @ORM\Entity(repositoryClass="FacturacionBundle\Repository\FacturaDetalleRepository")
 */
class FacturaDetalle {

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_factura_detalle_pk", type="integer", length=100000)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoFacturaDetallePk;

    /**
     * @ORM\Column(name="codigo_factura_fk", type="integer",length=1000, nullable=true)
     */
    private $codigoFacturaFk;

    /**
     * @ORM\Column(name="codigo_articulo_fk", type="integer", length=11, nullable=true)
     */
    private $codigoArticuloFk;

    /**
     * @ORM\Column(name="cantidad", type="integer", length=11, nullable=true)
     */
    private $cantidad;

    /**
     * @ORM\Column(name="vr_Unitario", type="integer", length=11, nullable=true)
     */
    private $vrUnitario;

    /**
     * @ORM\Column(name="dscto", type="integer", length=11, nullable=true)
     */
    private $dscto;

    /**
     * @ORM\Column(name="sub_total_unitario", type="integer", length=11, nullable=true)
     */
    private $subTotalUnitario;

    /**
     * @ORM\Column(name="iva", type="integer", length=11, nullable=true)
     */
    private $iva;

    /**
     * @ORM\Column(name="total_neto", type="integer", length=11, nullable=true)
     */
    private $totalNeto;

    /**
     * @ORM\ManyToOne(targetEntity="Factura", inversedBy="FacturaRel")
     * @ORM\JoinColumn(name="codigo_factura_fk", referencedColumnName="codigo_factura_pk")
     */
    protected $FacturaRel;

    /**
     * @ORM\ManyToOne(targetEntity="InventarioBundle\Entity\Articulo", inversedBy="articuloRel")
     * @ORM\JoinColumn(name="codigo_articulo_fk", referencedColumnName="codigo_articulo_pk")
     */
    protected $articuloRel;


    /**
     * Get codigoFacturaDetallePk
     *
     * @return integer
     */
    public function getCodigoFacturaDetallePk()
    {
        return $this->codigoFacturaDetallePk;
    }

    /**
     * Set codigoFacturaFk
     *
     * @param integer $codigoFacturaFk
     *
     * @return FacturaDetalle
     */
    public function setCodigoFacturaFk($codigoFacturaFk)
    {
        $this->codigoFacturaFk = $codigoFacturaFk;

        return $this;
    }

    /**
     * Get codigoFacturaFk
     *
     * @return integer
     */
    public function getCodigoFacturaFk()
    {
        return $this->codigoFacturaFk;
    }

    /**
     * Set codigoArticuloFk
     *
     * @param integer $codigoArticuloFk
     *
     * @return FacturaDetalle
     */
    public function setCodigoArticuloFk($codigoArticuloFk)
    {
        $this->codigoArticuloFk = $codigoArticuloFk;

        return $this;
    }

    /**
     * Get codigoArticuloFk
     *
     * @return integer
     */
    public function getCodigoArticuloFk()
    {
        return $this->codigoArticuloFk;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return FacturaDetalle
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set vrUnitario
     *
     * @param integer $vrUnitario
     *
     * @return FacturaDetalle
     */
    public function setVrUnitario($vrUnitario)
    {
        $this->vrUnitario = $vrUnitario;

        return $this;
    }

    /**
     * Get vrUnitario
     *
     * @return integer
     */
    public function getVrUnitario()
    {
        return $this->vrUnitario;
    }

    /**
     * Set dscto
     *
     * @param integer $dscto
     *
     * @return FacturaDetalle
     */
    public function setDscto($dscto)
    {
        $this->dscto = $dscto;

        return $this;
    }

    /**
     * Get dscto
     *
     * @return integer
     */
    public function getDscto()
    {
        return $this->dscto;
    }

    /**
     * Set subTotalUnitario
     *
     * @param integer $subTotalUnitario
     *
     * @return FacturaDetalle
     */
    public function setSubTotalUnitario($subTotalUnitario)
    {
        $this->subTotalUnitario = $subTotalUnitario;

        return $this;
    }

    /**
     * Get subTotalUnitario
     *
     * @return integer
     */
    public function getSubTotalUnitario()
    {
        return $this->subTotalUnitario;
    }

    /**
     * Set iva
     *
     * @param integer $iva
     *
     * @return FacturaDetalle
     */
    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }

    /**
     * Get iva
     *
     * @return integer
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set totalNeto
     *
     * @param integer $totalNeto
     *
     * @return FacturaDetalle
     */
    public function setTotalNeto($totalNeto)
    {
        $this->totalNeto = $totalNeto;

        return $this;
    }

    /**
     * Get totalNeto
     *
     * @return integer
     */
    public function getTotalNeto()
    {
        return $this->totalNeto;
    }

    /**
     * Set facturaRel
     *
     * @param \FacturacionBundle\Entity\Factura $facturaRel
     *
     * @return FacturaDetalle
     */
    public function setFacturaRel(\FacturacionBundle\Entity\Factura $facturaRel = null)
    {
        $this->FacturaRel = $facturaRel;

        return $this;
    }

    /**
     * Get facturaRel
     *
     * @return \FacturacionBundle\Entity\Factura
     */
    public function getFacturaRel()
    {
        return $this->FacturaRel;
    }

    /**
     * Set articuloRel
     *
     * @param \InventarioBundle\Entity\Articulo $articuloRel
     *
     * @return FacturaDetalle
     */
    public function setArticuloRel(\InventarioBundle\Entity\Articulo $articuloRel = null)
    {
        $this->articuloRel = $articuloRel;

        return $this;
    }

    /**
     * Get articuloRel
     *
     * @return \InventarioBundle\Entity\Articulo
     */
    public function getArticuloRel()
    {
        return $this->articuloRel;
    }
}
