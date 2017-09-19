<?php

namespace InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="saldos_articulos")
 * @ORM\Entity(repositoryClass="InventarioBundle\Repository\SaldosArticuloRepository")
 */
class SaldosArticulos {

    /**
     * @ORM\Id
     * @ORM\Column(name="codigo_saldos_articulos_pk", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoSaldosArticulosPk;

    /**
     * @ORM\Column(name="codigo_articulo_fk", type="integer")
     */
    private $codigoArticuloFk;

    /**
     * @ORM\Column(name="periodo", type="float")
     */
    private $periodo;

    /**
     * @ORM\Column(name="saldo_inicial", type="float")
     */
    private $saldoInicial;

    /**
     * @ORM\Column(name="entradas", type="float")
     */
    private $entradas;

    /**
     * @ORM\Column(name="salidas", type="float")
     */
    private $salidas;

    /**
     * @ORM\Column(name="saldo_final", type="float")
     */
    private $saldoFinal;

    /**
     * @ORM\Column(name="costo_promedio", type="float")
     */
    private $costoPromedio;

    /**
     * @ORM\Column(name="costo_unitario", type="float")
     */
    private $costoUnitario;

    /**
     * @ORM\Column(name="ultimo_costo", type="float")
     */
    private $ultimoCosto;

    /**
     * @ORM\ManyToOne(targetEntity="Articulo", inversedBy="ArticuloRel")
     * @ORM\JoinColumn(name="codigo_articulo_fk", referencedColumnName="codigo_articulo_pk")
     */
    private $ArticuloRel;



    /**
     * Get codigoSaldosArticulosPk
     *
     * @return integer
     */
    public function getCodigoSaldosArticulosPk()
    {
        return $this->codigoSaldosArticulosPk;
    }

    /**
     * Set codigoArticuloFk
     *
     * @param integer $codigoArticuloFk
     *
     * @return SaldosArticulos
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
     * Set periodo
     *
     * @param float $periodo
     *
     * @return SaldosArticulos
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get periodo
     *
     * @return float
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * Set saldoInicial
     *
     * @param float $saldoInicial
     *
     * @return SaldosArticulos
     */
    public function setSaldoInicial($saldoInicial)
    {
        $this->saldoInicial = $saldoInicial;

        return $this;
    }

    /**
     * Get saldoInicial
     *
     * @return float
     */
    public function getSaldoInicial()
    {
        return $this->saldoInicial;
    }

    /**
     * Set entradas
     *
     * @param float $entradas
     *
     * @return SaldosArticulos
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
     * @return SaldosArticulos
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
     * @return SaldosArticulos
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
     * @return SaldosArticulos
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
     * @return SaldosArticulos
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
     * Set ultimoCosto
     *
     * @param float $ultimoCosto
     *
     * @return SaldosArticulos
     */
    public function setUltimoCosto($ultimoCosto)
    {
        $this->ultimoCosto = $ultimoCosto;

        return $this;
    }

    /**
     * Get ultimoCosto
     *
     * @return float
     */
    public function getUltimoCosto()
    {
        return $this->ultimoCosto;
    }

    /**
     * Set articuloRel
     *
     * @param \InventarioBundle\Entity\Articulo $articuloRel
     *
     * @return SaldosArticulos
     */
    public function setArticuloRel(\InventarioBundle\Entity\Articulo $articuloRel = null)
    {
        $this->ArticuloRel = $articuloRel;

        return $this;
    }

    /**
     * Get articuloRel
     *
     * @return \InventarioBundle\Entity\Articulo
     */
    public function getArticuloRel()
    {
        return $this->ArticuloRel;
    }
}
