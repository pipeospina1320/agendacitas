<?php

namespace GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Configuracion
 *
 * @ORM\Table(name="gen_configuracion")
 * @ORM\Entity(repositoryClass="GeneralBundle\Repository\ConfiguracionRepository")
 */
class Configuracion
{
    /**
     * @ORM\Column(name="codigo_configuracion_pk", type="integer", length=10)
     * @ORM\Id
     */
    private $codigoConfiguracionPk;

    /**
     * @ORM\Column(name="tipo_documento" ,type="string", length=10)
     */
    private $tipoDocumento;
    
    /**
     * @ORM\Column(name="hora_apertura", type="time")
     */
    private $horaApertura;
    
    /**
     * 
     * @ORM\Column(name="hora_cierre", type="time")
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
     * Set tipoDocumento
     *
     * @param string $tipoDocumento
     *
     * @return Configuracion
     */
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return string
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
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
