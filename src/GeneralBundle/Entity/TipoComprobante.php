<?php

namespace GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comprobantes
 *
 * @ORM\Table(name="gen_tipo_comprobante")
 * @ORM\Entity(repositoryClass="GeneralBundle\Repository\TipoComprobanteRepository")
 */
class TipoComprobante {

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_tipo_comprobante_pk",length=11, type="integer")
     * @ORM\Id
     */
    private $codigoTipoComprobantePk;

    /**
     * @ORM\Column(name="nombre_tipo_comprobante", type="string", nullable=true)
     */
    private $nombreTipoComprobante;



    

    /**
     * Set codigoTipoComprobantePk
     *
     * @param integer $codigoTipoComprobantePk
     *
     * @return TipoComprobante
     */
    public function setCodigoTipoComprobantePk($codigoTipoComprobantePk)
    {
        $this->codigoTipoComprobantePk = $codigoTipoComprobantePk;

        return $this;
    }

    /**
     * Get codigoTipoComprobantePk
     *
     * @return integer
     */
    public function getCodigoTipoComprobantePk()
    {
        return $this->codigoTipoComprobantePk;
    }

    /**
     * Set nombreTipoComprobante
     *
     * @param string $nombreTipoComprobante
     *
     * @return TipoComprobante
     */
    public function setNombreTipoComprobante($nombreTipoComprobante)
    {
        $this->nombreTipoComprobante = $nombreTipoComprobante;

        return $this;
    }

    /**
     * Get nombreTipoComprobante
     *
     * @return string
     */
    public function getNombreTipoComprobante()
    {
        return $this->nombreTipoComprobante;
    }
}
