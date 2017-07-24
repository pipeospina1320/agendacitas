<?php

namespace CitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="CitasBundle\Repository\EmpleadoRepository")
 */
class usuario
{
    /**
     * @ORM\Id
     * @ORM\Column(name="codigo_usuario_pk", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoUsuarioPk;

    /**
     * @ORM\Column(name="nombre", type="string",length=200, nullable=true )
     */
    private $nombreUsuario;


 /**
     * Get codigoUsuarioPk
     *
     * @return int
     */
    public function getcodigoUsuarioPk()
    {
        return $this->codigoUsuarioPk;
    }
    
      /**
     * Set nombreUsuario
     *
     * @param \String $nombreUsuario
     *
     * @return RhuAcreditacion
     */
    public function setFecha($nombreUsuario)
    {
        $this->$nombreUsuario = $nombreUsuario;

        return $this;
    }

    /**
     * Get nombreUsuario
     *
     * @return \String
     */
    public function getFecha()
    {
        return $this->$nombreUsuario;
    }
    
}