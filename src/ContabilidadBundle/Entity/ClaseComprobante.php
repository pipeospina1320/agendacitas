<?php

namespace ContabilidadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comprobantes
 *
 * @ORM\Table(name="ctb_clase_comprobante")
 * @ORM\Entity(repositoryClass="ContabilidadBundle\Repository\ClaseComprobantesRepository")
 */
class ClaseComprobante {

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_clase_comprobante_pk", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoClaseComprobantePk;

    /**
     * @ORM\Column(name="nombre_clase_comprobante", type="string", nullable=true)
     */
    private $nombreClaseComprobante;


   

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
