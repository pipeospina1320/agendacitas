<?php


namespace InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="inv_unidad_manejo")
 * @ORM\Entity(repositoryClass="InventarioBundle\Repository\UnidadManejoRepository")
 */

class UnidadManejo {
   
    
     /**
     * @ORM\Id
     * @ORM\Column(name="codigo_unidad_manejo_pk", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $unidadManejoPk;
    
     /**
     * @ORM\Column(name="nombre_unidad_manejo", type="string", nullable=true)
     */
    private $nombreUnidadManejo;

    /**
     * Get unidadManejoPk
     *
     * @return integer
     */
    public function getUnidadManejoPk()
    {
        return $this->unidadManejoPk;
    }

    /**
     * Set nombreUnidadManejo
     *
     * @param string $nombreUnidadManejo
     *
     * @return UnidadManejo
     */
    public function setNombreUnidadManejo($nombreUnidadManejo)
    {
        $this->nombreUnidadManejo = $nombreUnidadManejo;

        return $this;
    }

    /**
     * Get nombreUnidadManejo
     *
     * @return string
     */
    public function getNombreUnidadManejo()
    {
        return $this->nombreUnidadManejo;
    }
}
