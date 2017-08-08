<?php

namespace ContabilidadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comprobantes
 *
 * @ORM\Table(name="ctb_tipo_comprobante")
 * @ORM\Entity(repositoryClass="ContabilidadBundle\Repository\TipoComprobantesRepository")
 */
class TipoComprobante {

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_tipo_comprobante_pk", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoTipoComprobantePk;

    /**
     * @ORM\Column(name="nombre_tipo_comprobante", type="string", nullable=true)
     */
    private $nombreTipoComprobante;


 

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
