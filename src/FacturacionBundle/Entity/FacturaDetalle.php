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
     * @ORM\Column(name="codigo_articulo_fk", type="integer", nullable=true)
     */
    private $codigoArticuloFk;

    /**
     * @ORM\Column(name="cantidad", type="float", nullable=true)
     */
    private $cantidad;

    /**
     * @ORM\Column(name="vr_unitario", type="float", nullable=true)
     */
    private $vrUnitario;

        /**
     * @ORM\Column(name="porcentaje_dscto", type="float", nullable=true)
     */
    private $porDscto;
    
    /**
     * @ORM\Column(name="vr_dscto", type="float", nullable=true)
     */
    private $vrDscto;

    /**
     * @ORM\Column(name="vr_sub_total_unitario", type="float", nullable=true)
     */
    private $vrSubTotalUnitario;
 
    
    /**
     * @ORM\Column(name="vr_subtotal", type="float", nullable=true)
     */
    private $vrSubTotal;
   
        /**
     * @ORM\Column(name="porcentaje_iva", type="float", length=11, nullable=true)
     */
    private $porIva;
    
    /**
     * @ORM\Column(name="vr_iva", type="float", length=11, nullable=true)
     */
    private $vrIva;

    /**
     * @ORM\Column(name="vr_total_neto_unitario", type="float", length=11, nullable=true)
     */
    private $vrTotalNetoUnitario;
    
        /**
     * @ORM\Column(name="vr_total_neto", type="float", length=11, nullable=true)
     */
    private $vrTotalNeto;

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
     * @param float $cantidad
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
     * @return float
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set vrUnitario
     *
     * @param float $vrUnitario
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
     * @return float
     */
    public function getVrUnitario()
    {
        return $this->vrUnitario;
    }

    /**
     * Set porDscto
     *
     * @param float $porDscto
     *
     * @return FacturaDetalle
     */
    public function setPorDscto($porDscto)
    {
        $this->porDscto = $porDscto;

        return $this;
    }

    /**
     * Get porDscto
     *
     * @return float
     */
    public function getPorDscto()
    {
        return $this->porDscto;
    }

    /**
     * Set vrDscto
     *
     * @param float $vrDscto
     *
     * @return FacturaDetalle
     */
    public function setVrDscto($vrDscto)
    {
        $this->vrDscto = $vrDscto;

        return $this;
    }

    /**
     * Get vrDscto
     *
     * @return float
     */
    public function getVrDscto()
    {
        return $this->vrDscto;
    }

    /**
     * Set vrSubTotalUnitario
     *
     * @param float $vrSubTotalUnitario
     *
     * @return FacturaDetalle
     */
    public function setVrSubTotalUnitario($vrSubTotalUnitario)
    {
        $this->vrSubTotalUnitario = $vrSubTotalUnitario;

        return $this;
    }

    /**
     * Get vrSubTotalUnitario
     *
     * @return float
     */
    public function getVrSubTotalUnitario()
    {
        return $this->vrSubTotalUnitario;
    }

    /**
     * Set vrSubTotal
     *
     * @param float $vrSubTotal
     *
     * @return FacturaDetalle
     */
    public function setVrSubTotal($vrSubTotal)
    {
        $this->vrSubTotal = $vrSubTotal;

        return $this;
    }

    /**
     * Get vrSubTotal
     *
     * @return float
     */
    public function getVrSubTotal()
    {
        return $this->vrSubTotal;
    }

    /**
     * Set porIva
     *
     * @param float $porIva
     *
     * @return FacturaDetalle
     */
    public function setPorIva($porIva)
    {
        $this->porIva = $porIva;

        return $this;
    }

    /**
     * Get porIva
     *
     * @return float
     */
    public function getPorIva()
    {
        return $this->porIva;
    }

    /**
     * Set vrIva
     *
     * @param float $vrIva
     *
     * @return FacturaDetalle
     */
    public function setVrIva($vrIva)
    {
        $this->vrIva = $vrIva;

        return $this;
    }

    /**
     * Get vrIva
     *
     * @return float
     */
    public function getVrIva()
    {
        return $this->vrIva;
    }

    /**
     * Set vrTotalNetoUnitario
     *
     * @param float $vrTotalNetoUnitario
     *
     * @return FacturaDetalle
     */
    public function setVrTotalNetoUnitario($vrTotalNetoUnitario)
    {
        $this->vrTotalNetoUnitario = $vrTotalNetoUnitario;

        return $this;
    }

    /**
     * Get vrTotalNetoUnitario
     *
     * @return float
     */
    public function getVrTotalNetoUnitario()
    {
        return $this->vrTotalNetoUnitario;
    }

    /**
     * Set vrTotalNeto
     *
     * @param float $vrTotalNeto
     *
     * @return FacturaDetalle
     */
    public function setVrTotalNeto($vrTotalNeto)
    {
        $this->vrTotalNeto = $vrTotalNeto;

        return $this;
    }

    /**
     * Get vrTotalNeto
     *
     * @return float
     */
    public function getVrTotalNeto()
    {
        return $this->vrTotalNeto;
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
