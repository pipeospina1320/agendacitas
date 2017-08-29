<?php

namespace GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * centro costo
 *
 * @ORM\Table(name="gen_centro_costo")
 * @ORM\Entity(repositoryClass="GeneralBundle\Repository\CentroCostoRepository")
 */
class CentroCosto {

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_centro_costo_pk", length=11, type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoCentroCostoPk;

    /**
     * @ORM\Column(name="nombre_centro_costo", type="string", nullable=true)
     */
    private $nombreCentroCosto;




  

    /**
     * Get codigoCentroCostoPk
     *
     * @return integer
     */
    public function getCodigoCentroCostoPk()
    {
        return $this->codigoCentroCostoPk;
    }

    /**
     * Set nombreCentroCosto
     *
     * @param string $nombreCentroCosto
     *
     * @return CentroCosto
     */
    public function setNombreCentroCosto($nombreCentroCosto)
    {
        $this->nombreCentroCosto = $nombreCentroCosto;

        return $this;
    }

    /**
     * Get nombreCentroCosto
     *
     * @return string
     */
    public function getNombreCentroCosto()
    {
        return $this->nombreCentroCosto;
    }
}
