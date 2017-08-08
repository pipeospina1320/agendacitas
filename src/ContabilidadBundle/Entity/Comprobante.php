<?php

namespace ContabilidadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comprobantes
 *
 * @ORM\Table(name="ctb_comprobante")
 * @ORM\Entity(repositoryClass="ContabilidadBundle\Repository\ComprobantesRepository")
 */
class Comprobante {

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_comprobante_pk", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoComprobantePk;

    /**
     * @ORM\Column(name="nombre_comprobante", type="string", nullable=true)
     */
    private $nombreComprobante;
    
     /**
     * @ORM\Column(name="prefijo_comprobante", type="string", nullable=true, length=3)
     */
    private $prefijoComprobante;
    
     /**
     * @ORM\Column(name="ultimo_consecutivo", type="string", nullable=true)
     */
    private $ultimoConsecutivo;
    
      /**
     * @ORM\Column(name="descripcion", type="string", nullable=true)
     */
    private $descripcion;
    
     /**
     * @ORM\ManyToOne(targetEntity="ClaseComprobante", inversedBy="claseComprobanteRel")
     * @ORM\JoinColumn(name="codigo_clase_comprobante_fk", referencedColumnName="codigo_clase_comprobante_pk")
     */
    private $claseComprobanteRel;
    
     /**
     * @ORM\ManyToOne(targetEntity="TipoComprobante", inversedBy="tipoComprobanteRel")
     * @ORM\JoinColumn(name="codigo_tipo_comprobante_fk", referencedColumnName="codigo_tipo_comprobante_pk")
     */
    private $tipoComprobanteRel;
    
    /**
     * @ORM\Column(name="consecutivo_unico", type="boolean", nullable=true)
     */
    private $consecutivoUnico = true;



    /**
     * Get codigoComprobantePk
     *
     * @return integer
     */
    public function getCodigoComprobantePk()
    {
        return $this->codigoComprobantePk;
    }

    /**
     * Set nombreComprobante
     *
     * @param string $nombreComprobante
     *
     * @return Comprobante
     */
    public function setNombreComprobante($nombreComprobante)
    {
        $this->nombreComprobante = $nombreComprobante;

        return $this;
    }

    /**
     * Get nombreComprobante
     *
     * @return string
     */
    public function getNombreComprobante()
    {
        return $this->nombreComprobante;
    }

    /**
     * Set prefijoComprobante
     *
     * @param string $prefijoComprobante
     *
     * @return Comprobante
     */
    public function setPrefijoComprobante($prefijoComprobante)
    {
        $this->prefijoComprobante = $prefijoComprobante;

        return $this;
    }

    /**
     * Get prefijoComprobante
     *
     * @return string
     */
    public function getPrefijoComprobante()
    {
        return $this->prefijoComprobante;
    }

    /**
     * Set ultimoConsecutivo
     *
     * @param string $ultimoConsecutivo
     *
     * @return Comprobante
     */
    public function setUltimoConsecutivo($ultimoConsecutivo)
    {
        $this->ultimoConsecutivo = $ultimoConsecutivo;

        return $this;
    }

    /**
     * Get ultimoConsecutivo
     *
     * @return string
     */
    public function getUltimoConsecutivo()
    {
        return $this->ultimoConsecutivo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Comprobante
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set consecutivoUnico
     *
     * @param boolean $consecutivoUnico
     *
     * @return Comprobante
     */
    public function setConsecutivoUnico($consecutivoUnico)
    {
        $this->consecutivoUnico = $consecutivoUnico;

        return $this;
    }

    /**
     * Get consecutivoUnico
     *
     * @return boolean
     */
    public function getConsecutivoUnico()
    {
        return $this->consecutivoUnico;
    }

    /**
     * Set claseComprobanteRel
     *
     * @param \ContabilidadBundle\Entity\ClaseComprobante $claseComprobanteRel
     *
     * @return Comprobante
     */
    public function setClaseComprobanteRel(\ContabilidadBundle\Entity\ClaseComprobante $claseComprobanteRel = null)
    {
        $this->claseComprobanteRel = $claseComprobanteRel;

        return $this;
    }

    /**
     * Get claseComprobanteRel
     *
     * @return \ContabilidadBundle\Entity\ClaseComprobante
     */
    public function getClaseComprobanteRel()
    {
        return $this->claseComprobanteRel;
    }

    /**
     * Set tipoComprobanteRel
     *
     * @param \ContabilidadBundle\Entity\TipoComprobante $tipoComprobanteRel
     *
     * @return Comprobante
     */
    public function setTipoComprobanteRel(\ContabilidadBundle\Entity\TipoComprobante $tipoComprobanteRel = null)
    {
        $this->tipoComprobanteRel = $tipoComprobanteRel;

        return $this;
    }

    /**
     * Get tipoComprobanteRel
     *
     * @return \ContabilidadBundle\Entity\TipoComprobante
     */
    public function getTipoComprobanteRel()
    {
        return $this->tipoComprobanteRel;
    }
}
