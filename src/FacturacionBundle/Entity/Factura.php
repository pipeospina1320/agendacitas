<?php

namespace FacturacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="factura")
 * @ORM\Entity(repositoryClass="FacturacionBundle\Repository\FacturaRepository")
 */
class Factura {

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_factura_pk", type="integer",length=1000)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoFacturaPk;

    /**
     * @ORM\Column(name="codigo_comprobante_fk", type="integer", length=11, nullable=true)
     */
    private $codigoComprobnteFk;

    /**
     * @ORM\Column(name="codigo_cliente_fk", type="integer", length=11, nullable=true)
     */
    private $codigoClienteFk;

    /**
     * @ORM\Column(name="codigo_forma_pago_fk", type="integer", length=11, nullable=true)
     */
    private $codigoFormaPagoFk;

    /**
     * @ORM\Column(name="codigo_centro_costo_fk", type="integer", length=11, nullable=true)
     */
    private $codigoCentroCostoFk;

    /**
     * @ORM\Column(name="codigo_vendedor_fk", type="integer", length=11, nullable=true)
     */
    private $codigoVendedorFk;

    /**
     * @ORM\Column(name="fecha_movimiento", type="date", nullable=true)
     */
    private $fechaMovimiento;
    
    /**
     * @ORM\Column(name="fecha_vencimiento", type="date", nullable=true)
     */
    private $fechaVencimiento;

    /**
     * @ORM\Column(name="numero_documento", type="integer", nullable=true)
     */
    private $numeroDocumento;

    /**
     * @ORM\Column(name="valor_iva", type="integer", nullable=true)
     */
    private $valorIva;

    /**
     * @ORM\Column(name="valor_subtotal", type="integer", nullable=true)
     */
    private $valorSubtotal;

    /**
     * @ORM\Column(name="valor_total", type="integer", nullable=true)
     */
    private $valorTotal;

    /**
     * @ORM\Column(name="valor_reteiva", type="integer", nullable=true)
     */
    private $valorReteIva;

    /**
     * @ORM\Column(name="valor_retefuente", type="integer", nullable=true)
     */
    private $valorReteFuente;

    /**
     * @ORM\Column(name="estado_anulado", type="boolean", nullable=true)
     */
    private $estadoAnulado = false;

    /**
     * @ORM\Column(name="estado_impreso", type="boolean", nullable=true)
     */
    private $estadoImpreso = false;

    /**
     * @ORM\Column(name="estado_cerrado", type="boolean", nullable=true)
     */
    private $estadoCerrado = false;

    /**
     * @ORM\ManyToOne(targetEntity="GeneralBundle\Entity\Comprobante", inversedBy="comprobanteRel")
     * @ORM\JoinColumn(name="codigo_comprobante_fk", referencedColumnName="codigo_comprobante_pk")
     */
    protected $comprobanteRel;

    /**
     * @ORM\ManyToOne(targetEntity="GeneralBundle\Entity\Cliente", inversedBy="clienteRel")
     * @ORM\JoinColumn(name="codigo_cliente_fk", referencedColumnName="codigo_cliente_pk")
     */
    protected $clienteRel;

    /**
     * @ORM\ManyToONe(targetEntity="GeneralBundle\Entity\FormaPago", inversedBy="formaPagoRel") 
     * @ORM\JoinColumn(name="codigo_forma_pago_fk", referencedColumnName="codigo_forma_pago_pk")
     */
    protected $formaPagoRel;

    /**
     * @ORM\ManyToOne(targetEntity="GeneralBundle\Entity\CentroCosto", inversedBy="centroCostoRel")
     * @ORM\JoinColumn(name="codigo_centro_costo_fk", referencedColumnName="codigo_centro_costo_pk")
     */
    protected $centroCostoRel;



    /**
     * Get codigoFacturaPk
     *
     * @return integer
     */
    public function getCodigoFacturaPk()
    {
        return $this->codigoFacturaPk;
    }

    /**
     * Set codigoComprobnteFk
     *
     * @param integer $codigoComprobnteFk
     *
     * @return Factura
     */
    public function setCodigoComprobnteFk($codigoComprobnteFk)
    {
        $this->codigoComprobnteFk = $codigoComprobnteFk;

        return $this;
    }

    /**
     * Get codigoComprobnteFk
     *
     * @return integer
     */
    public function getCodigoComprobnteFk()
    {
        return $this->codigoComprobnteFk;
    }

    /**
     * Set codigoClienteFk
     *
     * @param integer $codigoClienteFk
     *
     * @return Factura
     */
    public function setCodigoClienteFk($codigoClienteFk)
    {
        $this->codigoClienteFk = $codigoClienteFk;

        return $this;
    }

    /**
     * Get codigoClienteFk
     *
     * @return integer
     */
    public function getCodigoClienteFk()
    {
        return $this->codigoClienteFk;
    }

    /**
     * Set codigoFormaPagoFk
     *
     * @param integer $codigoFormaPagoFk
     *
     * @return Factura
     */
    public function setCodigoFormaPagoFk($codigoFormaPagoFk)
    {
        $this->codigoFormaPagoFk = $codigoFormaPagoFk;

        return $this;
    }

    /**
     * Get codigoFormaPagoFk
     *
     * @return integer
     */
    public function getCodigoFormaPagoFk()
    {
        return $this->codigoFormaPagoFk;
    }

    /**
     * Set codigoCentroCostoFk
     *
     * @param integer $codigoCentroCostoFk
     *
     * @return Factura
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
     * Set codigoVendedorFk
     *
     * @param integer $codigoVendedorFk
     *
     * @return Factura
     */
    public function setCodigoVendedorFk($codigoVendedorFk)
    {
        $this->codigoVendedorFk = $codigoVendedorFk;

        return $this;
    }

    /**
     * Get codigoVendedorFk
     *
     * @return integer
     */
    public function getCodigoVendedorFk()
    {
        return $this->codigoVendedorFk;
    }

    /**
     * Set fechaMovimiento
     *
     * @param \DateTime $fechaMovimiento
     *
     * @return Factura
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
     * Set fechaVencimiento
     *
     * @param \DateTime $fechaVencimiento
     *
     * @return Factura
     */
    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }

    /**
     * Get fechaVencimiento
     *
     * @return \DateTime
     */
    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    /**
     * Set numeroDocumento
     *
     * @param integer $numeroDocumento
     *
     * @return Factura
     */
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;

        return $this;
    }

    /**
     * Get numeroDocumento
     *
     * @return integer
     */
    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    /**
     * Set valorIva
     *
     * @param integer $valorIva
     *
     * @return Factura
     */
    public function setValorIva($valorIva)
    {
        $this->valorIva = $valorIva;

        return $this;
    }

    /**
     * Get valorIva
     *
     * @return integer
     */
    public function getValorIva()
    {
        return $this->valorIva;
    }

    /**
     * Set valorSubtotal
     *
     * @param integer $valorSubtotal
     *
     * @return Factura
     */
    public function setValorSubtotal($valorSubtotal)
    {
        $this->valorSubtotal = $valorSubtotal;

        return $this;
    }

    /**
     * Get valorSubtotal
     *
     * @return integer
     */
    public function getValorSubtotal()
    {
        return $this->valorSubtotal;
    }

    /**
     * Set valorTotal
     *
     * @param integer $valorTotal
     *
     * @return Factura
     */
    public function setValorTotal($valorTotal)
    {
        $this->valorTotal = $valorTotal;

        return $this;
    }

    /**
     * Get valorTotal
     *
     * @return integer
     */
    public function getValorTotal()
    {
        return $this->valorTotal;
    }

    /**
     * Set valorReteIva
     *
     * @param integer $valorReteIva
     *
     * @return Factura
     */
    public function setValorReteIva($valorReteIva)
    {
        $this->valorReteIva = $valorReteIva;

        return $this;
    }

    /**
     * Get valorReteIva
     *
     * @return integer
     */
    public function getValorReteIva()
    {
        return $this->valorReteIva;
    }

    /**
     * Set valorReteFuente
     *
     * @param integer $valorReteFuente
     *
     * @return Factura
     */
    public function setValorReteFuente($valorReteFuente)
    {
        $this->valorReteFuente = $valorReteFuente;

        return $this;
    }

    /**
     * Get valorReteFuente
     *
     * @return integer
     */
    public function getValorReteFuente()
    {
        return $this->valorReteFuente;
    }

    /**
     * Set estadoAnulado
     *
     * @param boolean $estadoAnulado
     *
     * @return Factura
     */
    public function setEstadoAnulado($estadoAnulado)
    {
        $this->estadoAnulado = $estadoAnulado;

        return $this;
    }

    /**
     * Get estadoAnulado
     *
     * @return boolean
     */
    public function getEstadoAnulado()
    {
        return $this->estadoAnulado;
    }

    /**
     * Set estadoImpreso
     *
     * @param boolean $estadoImpreso
     *
     * @return Factura
     */
    public function setEstadoImpreso($estadoImpreso)
    {
        $this->estadoImpreso = $estadoImpreso;

        return $this;
    }

    /**
     * Get estadoImpreso
     *
     * @return boolean
     */
    public function getEstadoImpreso()
    {
        return $this->estadoImpreso;
    }

    /**
     * Set estadoCerrado
     *
     * @param boolean $estadoCerrado
     *
     * @return Factura
     */
    public function setEstadoCerrado($estadoCerrado)
    {
        $this->estadoCerrado = $estadoCerrado;

        return $this;
    }

    /**
     * Get estadoCerrado
     *
     * @return boolean
     */
    public function getEstadoCerrado()
    {
        return $this->estadoCerrado;
    }

    /**
     * Set comprobanteRel
     *
     * @param \GeneralBundle\Entity\Comprobante $comprobanteRel
     *
     * @return Factura
     */
    public function setComprobanteRel(\GeneralBundle\Entity\Comprobante $comprobanteRel = null)
    {
        $this->comprobanteRel = $comprobanteRel;

        return $this;
    }

    /**
     * Get comprobanteRel
     *
     * @return \GeneralBundle\Entity\Comprobante
     */
    public function getComprobanteRel()
    {
        return $this->comprobanteRel;
    }

    /**
     * Set clienteRel
     *
     * @param \GeneralBundle\Entity\Cliente $clienteRel
     *
     * @return Factura
     */
    public function setClienteRel(\GeneralBundle\Entity\Cliente $clienteRel = null)
    {
        $this->clienteRel = $clienteRel;

        return $this;
    }

    /**
     * Get clienteRel
     *
     * @return \GeneralBundle\Entity\Cliente
     */
    public function getClienteRel()
    {
        return $this->clienteRel;
    }

    /**
     * Set formaPagoRel
     *
     * @param \GeneralBundle\Entity\FormaPago $formaPagoRel
     *
     * @return Factura
     */
    public function setFormaPagoRel(\GeneralBundle\Entity\FormaPago $formaPagoRel = null)
    {
        $this->formaPagoRel = $formaPagoRel;

        return $this;
    }

    /**
     * Get formaPagoRel
     *
     * @return \GeneralBundle\Entity\FormaPago
     */
    public function getFormaPagoRel()
    {
        return $this->formaPagoRel;
    }

    /**
     * Set centroCostoRel
     *
     * @param \GeneralBundle\Entity\CentroCosto $centroCostoRel
     *
     * @return Factura
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
