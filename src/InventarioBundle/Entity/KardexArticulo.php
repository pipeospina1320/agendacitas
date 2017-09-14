<?php

namespace InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="kardex_articulo")
 * @ORM\Entity(repositoryClass="InventarioBundle\Repository\KardexArticuloRepository")
 */
class KardexArticulo {

    /**
     * @ORM\Id
     * @ORM\Column(name="codigo_kardex_articulo_pk", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoKardexArticuloPk;

    /**
     * @ORM\Column(name="codigo_factura_detalle_fk" , type="integer")
     */
    private $codigoFacturaDetalleFk;
    
     /**
     * @ORM\Column(name="codigo_articulo_fk", type="integer")
     */
    private $codigoArticuloFk;

    /**
     * @ORM\Column(name="fecha_movimiento" , type="date")
     */
    private $fechaMovimiento;

    /**
     * @ORM\Column(name="periodo_movimiento" , type="float")
     */
    private $periodoMovimiento;

    /**
     * @ORM\Column(name="saldo_anterior" , type="float")
     */
    private $saldoAnterior;

    /**
     * @ORM\Column(name="entradas" , type="float")
     */
    private $entradas;

    /**
     * @ORM\Column(name="salidas" , type="float")
     */
    private $salidas;

     /**
     * @ORM\Column(name="saldo_final" , type="float")
     */
    private $saldoFinal;
    
    /**
     * @ORM\Column(name="costo_promedio" , type="float")
     */
    private $costoPromedio;
    
       /**
     * @ORM\Column(name="costo_unitario" , type="float")
     */
    private $costoUnitario;
  

    /**
     * @ORM\ManyToOne(targetEntity="FacturacionBundle\Entity\FacturaDetalle", inversedBy="facturaDetalleRel")
     * @ORM\JoinColumn(name="codigo_factura_detalle_fk", referencedColumnName="codigo_factura_detalle_pk")
     */
    protected $facturaDetalleRel;

    /**
     * @ORM\ManyToOne(targetEntity="InventarioBundle\Entity\Articulo", inversedBy="articuloRel")
     * @ORM\JoinColumn(name="codigo_articulo_fk", referencedColumnName="codigo_articulo_pk")
     */
    protected $articuloRel;



    /**
     * Get codigoKardexArticuloPk
     *
     * @return integer
     */
    public function getCodigoKardexArticuloPk()
    {
        return $this->codigoKardexArticuloPk;
    }

    /**
     * Set codigoFacturaDetalleFk
     *
     * @param integer $codigoFacturaDetalleFk
     *
     * @return KardexArticulo
     */
    public function setCodigoFacturaDetalleFk($codigoFacturaDetalleFk)
    {
        $this->codigoFacturaDetalleFk = $codigoFacturaDetalleFk;

        return $this;
    }

    /**
     * Get codigoFacturaDetalleFk
     *
     * @return integer
     */
    public function getCodigoFacturaDetalleFk()
    {
        return $this->codigoFacturaDetalleFk;
    }

    /**
     * Set codigoArticuloFk
     *
     * @param integer $codigoArticuloFk
     *
     * @return KardexArticulo
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
     * Set fechaMovimiento
     *
     * @param \DateTime $fechaMovimiento
     *
     * @return KardexArticulo
     */
    public function setFechaMovimiento($fechaMovimiento)
    {
        $this->fechaMovimiento = $fechaMovimiento;

        return $this;
    }

    /**
     * Get fechaMovimiento
     *
     * @return \DateTime
     */
    public function getFechaMovimiento()
    {
        return $this->fechaMovimiento;
    }

    /**
     * Set periodoMovimiento
     *
     * @param float $periodoMovimiento
     *
     * @return KardexArticulo
     */
    public function setPeriodoMovimiento($periodoMovimiento)
    {
        $this->periodoMovimiento = $periodoMovimiento;

        return $this;
    }

    /**
     * Get periodoMovimiento
     *
     * @return float
     */
    public function getPeriodoMovimiento()
    {
        return $this->periodoMovimiento;
    }

    /**
     * Set saldoAnterior
     *
     * @param float $saldoAnterior
     *
     * @return KardexArticulo
     */
    public function setSaldoAnterior($saldoAnterior)
    {
        $this->saldoAnterior = $saldoAnterior;

        return $this;
    }

    /**
     * Get saldoAnterior
     *
     * @return float
     */
    public function getSaldoAnterior()
    {
        return $this->saldoAnterior;
    }

    /**
     * Set entradas
     *
     * @param float $entradas
     *
     * @return KardexArticulo
     */
    public function setEntradas($entradas)
    {
        $this->entradas = $entradas;

        return $this;
    }

    /**
     * Get entradas
     *
     * @return float
     */
    public function getEntradas()
    {
        return $this->entradas;
    }

    /**
     * Set salidas
     *
     * @param float $salidas
     *
     * @return KardexArticulo
     */
    public function setSalidas($salidas)
    {
        $this->salidas = $salidas;

        return $this;
    }

    /**
     * Get salidas
     *
     * @return float
     */
    public function getSalidas()
    {
        return $this->salidas;
    }

    /**
     * Set saldoFinal
     *
     * @param float $saldoFinal
     *
     * @return KardexArticulo
     */
    public function setSaldoFinal($saldoFinal)
    {
        $this->saldoFinal = $saldoFinal;

        return $this;
    }

    /**
     * Get saldoFinal
     *
     * @return float
     */
    public function getSaldoFinal()
    {
        return $this->saldoFinal;
    }

    /**
     * Set costoPromedio
     *
     * @param float $costoPromedio
     *
     * @return KardexArticulo
     */
    public function setCostoPromedio($costoPromedio)
    {
        $this->costoPromedio = $costoPromedio;

        return $this;
    }

    /**
     * Get costoPromedio
     *
     * @return float
     */
    public function getCostoPromedio()
    {
        return $this->costoPromedio;
    }

    /**
     * Set costoUnitario
     *
     * @param float $costoUnitario
     *
     * @return KardexArticulo
     */
    public function setCostoUnitario($costoUnitario)
    {
        $this->costoUnitario = $costoUnitario;

        return $this;
    }

    /**
     * Get costoUnitario
     *
     * @return float
     */
    public function getCostoUnitario()
    {
        return $this->costoUnitario;
    }

    /**
     * Set facturaDetalleRel
     *
     * @param \FacturacionBundle\Entity\FacturaDetalle $facturaDetalleRel
     *
     * @return KardexArticulo
     */
    public function setFacturaDetalleRel(\FacturacionBundle\Entity\FacturaDetalle $facturaDetalleRel = null)
    {
        $this->facturaDetalleRel = $facturaDetalleRel;

        return $this;
    }

    /**
     * Get facturaDetalleRel
     *
     * @return \FacturacionBundle\Entity\FacturaDetalle
     */
    public function getFacturaDetalleRel()
    {
        return $this->facturaDetalleRel;
    }

    /**
     * Set articuloRel
     *
     * @param \InventarioBundle\Entity\Articulo $articuloRel
     *
     * @return KardexArticulo
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
