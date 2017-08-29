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
     * @ORM\Column(name="codigo_centro_costo_fk", type="integer", length=11, nullable=true)
     */
    private $codigoCentroCostoFk;
    

    
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
     *
     * @ORM\ManyToOne(targetEntity="GeneralBundle\Entity\CentroCosto", inversedBy="centroCostoRel")
     * @ORM\JoinColumn(name="codigo_centro_costo_fk", referencedColumnName="codigo_centro_costo_pk")
     */
    protected $centroCostoRel;

 



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
     * Set codigoCentroCostoFk
     *
     * @param integer $codigoCentroCostoFk
     *
     * @return FacturaDetalle
     */
    public function setCodigoCentroCostoFk($codigoCentroCostoFk)
    {
        $this->codigoCentroCostoFk = $codigoCentroCostoFk;

        return $this;
    }

    /**
     * Get codigoCentroCostoFk
     *
     * @return integer
     */
    public function getCodigoCentroCostoFk()
    {
        return $this->codigoCentroCostoFk;
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

    /**
     * Set centroCostoRel
     *
     * @param \GeneralBundle\Entity\CentroCosto $centroCostoRel
     *
     * @return FacturaDetalle
     */
    public function setCentroCostoRel(\GeneralBundle\Entity\CentroCosto $centroCostoRel = null)
    {
        $this->centroCostoRel = $centroCostoRel;

        return $this;
    }

    /**
     * Get centroCostoRel
     *
     * @return \GeneralBundle\Entity\CentroCosto
     */
    public function getCentroCostoRel()
    {
        return $this->centroCostoRel;
    }
}
