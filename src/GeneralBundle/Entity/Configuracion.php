<?php

namespace GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Configuracion
 *
 * @ORM\Table(name="gen_configuracion")
 * @ORM\Entity(repositoryClass="GeneralBundle\Repository\ConfiguracionRepository")
 */
class Configuracion {

    /**
     * @ORM\Column(name="codigo_configuracion_pk", type="integer", length=10)
     * @ORM\Id
     */
    private $codigoConfiguracionPk;

    /**
     * @ORM\Column(name="nit_empresa" ,type="float")
     */
    private $nitEmpresa;

    /**
     * @ORM\Column(name="nombre_comercial" ,type="string")
     */
    private $nombreComercial;

    /**
     * @ORM\Column(name="razon_social" ,type="string")
     */
    private $razonSocial;

    /**
     * @ORM\Column(name="direccion" , type="string")
     */
    private $direccion;

    /**
     * @ORM\Column(name="telefono", type="string")
     */
    private $telefono;

    /**
     * @ORM\Column(name="tipo_regimen_fk", type="integer")
     */
    private $tipoRegimenFk;

    /**
     * @ORM\Column(name="hora_apertura", type="time" ,nullable=true)
     */
    private $horaApertura;

    /**
     * 
     * @ORM\Column(name="hora_cierre", type="time", nullable=true)
     */
    private $horaCierre;

    /**
     * 
     * @ORM\Column(name="ultimo_cierre_inventario", type="float")
     */
    private $ultimoCierreInventario;

    /**
     * 
     * @ORM\Column(name="periodo_actual", type="float")
     */
    private $periodoActual;

  

    /**
     * Set codigoConfiguracionPk
     *
     * @param integer $codigoConfiguracionPk
     *
     * @return Configuracion
     */
    public function setCodigoConfiguracionPk($codigoConfiguracionPk)
    {
        $this->codigoConfiguracionPk = $codigoConfiguracionPk;

        return $this;
    }

    /**
     * Get codigoConfiguracionPk
     *
     * @return integer
     */
    public function getCodigoConfiguracionPk()
    {
        return $this->codigoConfiguracionPk;
    }

    /**
     * Set nitEmpresa
     *
     * @param float $nitEmpresa
     *
     * @return Configuracion
     */
    public function setNitEmpresa($nitEmpresa)
    {
        $this->nitEmpresa = $nitEmpresa;

        return $this;
    }

    /**
     * Get nitEmpresa
     *
     * @return float
     */
    public function getNitEmpresa()
    {
        return $this->nitEmpresa;
    }

    /**
     * Set nombreComercial
     *
     * @param string $nombreComercial
     *
     * @return Configuracion
     */
    public function setNombreComercial($nombreComercial)
    {
        $this->nombreComercial = $nombreComercial;

        return $this;
    }

    /**
     * Get nombreComercial
     *
     * @return string
     */
    public function getNombreComercial()
    {
        return $this->nombreComercial;
    }

    /**
     * Set razonSocial
     *
     * @param string $razonSocial
     *
     * @return Configuracion
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

    /**
     * Get razonSocial
     *
     * @return string
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Configuracion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Configuracion
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set tipoRegimenFk
     *
     * @param integer $tipoRegimenFk
     *
     * @return Configuracion
     */
    public function setTipoRegimenFk($tipoRegimenFk)
    {
        $this->tipoRegimenFk = $tipoRegimenFk;

        return $this;
    }

    /**
     * Get tipoRegimenFk
     *
     * @return integer
     */
    public function getTipoRegimenFk()
    {
        return $this->tipoRegimenFk;
    }

    /**
     * Set horaApertura
     *
     * @param \DateTime $horaApertura
     *
     * @return Configuracion
     */
    public function setHoraApertura($horaApertura)
    {
        $this->horaApertura = $horaApertura;

        return $this;
    }

    /**
     * Get horaApertura
     *
     * @return \DateTime
     */
    public function getHoraApertura()
    {
        return $this->horaApertura;
    }

    /**
     * Set horaCierre
     *
     * @param \DateTime $horaCierre
     *
     * @return Configuracion
     */
    public function setHoraCierre($horaCierre)
    {
        $this->horaCierre = $horaCierre;

        return $this;
    }

    /**
     * Get horaCierre
     *
     * @return \DateTime
     */
    public function getHoraCierre()
    {
        return $this->horaCierre;
    }

    /**
     * Set ultimoCierreInventario
     *
     * @param float $ultimoCierreInventario
     *
     * @return Configuracion
     */
    public function setUltimoCierreInventario($ultimoCierreInventario)
    {
        $this->ultimoCierreInventario = $ultimoCierreInventario;

        return $this;
    }

    /**
     * Get ultimoCierreInventario
     *
     * @return float
     */
    public function getUltimoCierreInventario()
    {
        return $this->ultimoCierreInventario;
    }

    /**
     * Set periodoActual
     *
     * @param float $periodoActual
     *
     * @return Configuracion
     */
    public function setPeriodoActual($periodoActual)
    {
        $this->periodoActual = $periodoActual;

        return $this;
    }

    /**
     * Get periodoActual
     *
     * @return float
     */
    public function getPeriodoActual()
    {
        return $this->periodoActual;
    }
}
