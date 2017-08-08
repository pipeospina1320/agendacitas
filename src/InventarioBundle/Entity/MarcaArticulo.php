<?php


namespace InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="inv_marca_articulo")
 * @ORM\Entity(repositoryClass="InventarioBundle\Repository\MarcaArticuloRepository")
 */

class MarcaArticulo {
   
    
     /**
     * @ORM\Id
     * @ORM\Column(name="codigo_marca_articulo_pk", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoMarcaArticuloPk;
    
     /**
     * @ORM\Column(name="nombre_marca_articulo", type="string", nullable=true)
     */
    private $nombreMarcaArticulo;



    /**
     * Get codigoMarcaArticuloPk
     *
     * @return integer
     */
    public function getCodigoMarcaArticuloPk()
    {
        return $this->codigoMarcaArticuloPk;
    }

    /**
     * Set nombreMarcaArticulo
     *
     * @param string $nombreMarcaArticulo
     *
     * @return MarcaArticulo
     */
    public function setNombreMarcaArticulo($nombreMarcaArticulo)
    {
        $this->nombreMarcaArticulo = $nombreMarcaArticulo;

        return $this;
    }

    /**
     * Get nombreMarcaArticulo
     *
     * @return string
     */
    public function getNombreMarcaArticulo()
    {
        return $this->nombreMarcaArticulo;
    }
}
