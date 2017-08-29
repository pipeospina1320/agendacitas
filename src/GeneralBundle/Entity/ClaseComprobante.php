<?php

namespace GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * clase comprobante
 *
 * @ORM\Table(name="gen_clase_comprobante")
 * @ORM\Entity(repositoryClass="GeneralBundle\Repository\ClaseComprobanteRepository")
 */
class ClaseComprobante {

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_clase_comprobante_pk",length=11, type="integer")
     * @ORM\Id
     */
    private $codigoClaseComprobantePk;

    /**
     * @ORM\Column(name="nombre_clase_comprobante", type="string", nullable=true)
     */
    private $nombreClaseComprobante;





    /**
     * Set codigoClaseComprobantePk
     *
     * @param integer $codigoClaseComprobantePk
     *
     * @return ClaseComprobante
     */
    public function setCodigoClaseComprobantePk($codigoClaseComprobantePk)
    {
        $this->codigoClaseComprobantePk = $codigoClaseComprobantePk;

        return $this;
    }

    /**
     * Get codigoClaseComprobantePk
     *
     * @return integer
     */
    public function getCodigoClaseComprobantePk()
    {
        return $this->codigoClaseComprobantePk;
    }

    /**
     * Set nombreClaseComprobante
     *
     * @param string $nombreClaseComprobante
     *
     * @return ClaseComprobante
     */
    public function setNombreClaseComprobante($nombreClaseComprobante)
    {
        $this->nombreClaseComprobante = $nombreClaseComprobante;

        return $this;
    }

    /**
     * Get nombreClaseComprobante
     *
     * @return string
     */
    public function getNombreClaseComprobante()
    {
        return $this->nombreClaseComprobante;
    }
}
