<?php

namespace InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="movimientos_articulo")
 * @ORM\Entity(repositoryClass="InventarioBundle\Repository\MovimientosArticuloRepository")
 */
class MovimientosArticulo {

    /**
     * @ORM\Id
     * @ORM\Column(name="codigo_maovimientos_articulo_pk", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoMovimientosArticuloPk;


    /**
     * Get codigoMovimientosArticuloPk
     *
     * @return integer
     */
    public function getCodigoMovimientosArticuloPk()
    {
        return $this->codigoMovimientosArticuloPk;
    }
}
