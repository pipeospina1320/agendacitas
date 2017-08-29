<?php

namespace ContabilidadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="ctb_tarifa_iva")
 * @ORM\Entity(repositoryClass="ContabilidadBundle\Repository\TarifaIvaRepository")
 */
class TarifaIva {

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_tarifa_iva_pk", length=11, type="integer")
     * @ORM\Id
     */
    private $codigoTarifaIvaPk;

    /**
     * @ORM\Column(name="codigo_Iva", type="string", nullable=true)
     */
    private $codigoIva;

    /**
     * @ORM\Column(name="nombre_tarifa_Iva", type="string", nullable=true)
     */
    private $nombreTarifaIva;

    /**
     * @ORM\Column(name="porcentaje_Iva", type="integer", nullable=true)
     */
    private $porcentajeIva;


    /**
     * Set codigoTarifaIvaPk
     *
     * @param integer $codigoTarifaIvaPk
     *
     * @return TarifaIva
     */
    public function setCodigoTarifaIvaPk($codigoTarifaIvaPk)
    {
        $this->codigoTarifaIvaPk = $codigoTarifaIvaPk;

        return $this;
    }

    /**
     * Get codigoTarifaIvaPk
     *
     * @return integer
     */
    public function getCodigoTarifaIvaPk()
    {
        return $this->codigoTarifaIvaPk;
    }

    /**
     * Set codigoIva
     *
     * @param string $codigoIva
     *
     * @return TarifaIva
     */
    public function setCodigoIva($codigoIva)
    {
        $this->codigoIva = $codigoIva;

        return $this;
    }

    /**
     * Get codigoIva
     *
     * @return string
     */
    public function getCodigoIva()
    {
        return $this->codigoIva;
    }

    /**
     * Set nombreTarifaIva
     *
     * @param string $nombreTarifaIva
     *
     * @return TarifaIva
     */
    public function setNombreTarifaIva($nombreTarifaIva)
    {
        $this->nombreTarifaIva = $nombreTarifaIva;

        return $this;
    }

    /**
     * Get nombreTarifaIva
     *
     * @return string
     */
    public function getNombreTarifaIva()
    {
        return $this->nombreTarifaIva;
    }

    /**
     * Set porcentajeIva
     *
     * @param string $porcentajeIva
     *
     * @return TarifaIva
     */
    public function setPorcentajeIva($porcentajeIva)
    {
        $this->porcentajeIva = $porcentajeIva;

        return $this;
    }

    /**
     * Get porcentajeIva
     *
     * @return string
     */
    public function getPorcentajeIva()
    {
        return $this->porcentajeIva;
    }
}
