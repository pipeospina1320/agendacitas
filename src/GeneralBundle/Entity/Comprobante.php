<?php

namespace GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comprobantes
 *
 * @ORM\Table(name="gen_comprobante")
 * @ORM\Entity(repositoryClass="GeneralBundle\Repository\ComprobanteRepository")
 */
class Comprobante {

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_comprobante_pk",length=11, type="integer")
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
     * @ORM\ManyToOne(targetEntity="ValorSugerido", inversedBy="valorSugeridoRel")
     * @ORM\JoinColumn(name="codigo_valor_sugerido_fk", referencedColumnName="codigo_valor_sugerido_pk")
     */
    private $valorSugeridoRel;

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
     * @param \GeneralBundle\Entity\ClaseComprobante $claseComprobanteRel
     *
     * @return Comprobante
     */
    public function setClaseComprobanteRel(\GeneralBundle\Entity\ClaseComprobante $claseComprobanteRel = null)
    {
        $this->claseComprobanteRel = $claseComprobanteRel;

        return $this;
    }

    /**
     * Get claseComprobanteRel
     *
     * @return \GeneralBundle\Entity\ClaseComprobante
     */
    public function getClaseComprobanteRel()
    {
        return $this->claseComprobanteRel;
    }

    /**
     * Set tipoComprobanteRel
     *
     * @param \GeneralBundle\Entity\TipoComprobante $tipoComprobanteRel
     *
     * @return Comprobante
     */
    public function setTipoComprobanteRel(\GeneralBundle\Entity\TipoComprobante $tipoComprobanteRel = null)
    {
        $this->tipoComprobanteRel = $tipoComprobanteRel;

        return $this;
    }

    /**
     * Get tipoComprobanteRel
     *
     * @return \GeneralBundle\Entity\TipoComprobante
     */
    public function getTipoComprobanteRel()
    {
        return $this->tipoComprobanteRel;
    }

    /**
     * Set valorSugeridoRel
     *
     * @param \GeneralBundle\Entity\ValorSugerido $valorSugeridoRel
     *
     * @return Comprobante
     */
    public function setValorSugeridoRel(\GeneralBundle\Entity\ValorSugerido $valorSugeridoRel = null)
    {
        $this->valorSugeridoRel = $valorSugeridoRel;

        return $this;
    }

    /**
     * Get valorSugeridoRel
     *
     * @return \GeneralBundle\Entity\ValorSugerido
     */
    public function getValorSugeridoRel()
    {
        return $this->valorSugeridoRel;
    }
}
