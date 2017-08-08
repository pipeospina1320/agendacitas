<?php

namespace InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="inv_grupo_articulos")
 * @ORM\Entity(repositoryClass="InventarioBundle\Repository\GrupoArticulosRepository")
 */
class GrupoArticulo {

    /**
     * @ORM\Id
     * @ORM\Column(name="codigo_grupo_articulo_pk", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoGrupoArticuloPk;

    /**
     * @ORM\Column(name="nombre_grupo_articulo", type="string", nullable=true)
     */
    private $nombreGrupoArticulo;




    /**
     * Get codigoGrupoArticuloPk
     *
     * @return integer
     */
    public function getCodigoGrupoArticuloPk()
    {
        return $this->codigoGrupoArticuloPk;
    }

    /**
     * Set nombreGrupoArticulo
     *
     * @param string $nombreGrupoArticulo
     *
     * @return GrupoArticulo
     */
    public function setNombreGrupoArticulo($nombreGrupoArticulo)
    {
        $this->nombreGrupoArticulo = $nombreGrupoArticulo;

        return $this;
    }

    /**
     * Get nombreGrupoArticulo
     *
     * @return string
     */
    public function getNombreGrupoArticulo()
    {
        return $this->nombreGrupoArticulo;
    }
}
