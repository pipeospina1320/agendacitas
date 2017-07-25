<?php

namespace CitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="CitasBundle\Repository\UsuarioRepository")
 */
class Usuario {

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
     * @return integer
     */
    public function getCodigoUsuarioPk() {
        return $this->codigoUsuarioPk;
    }

    /**
     * Set nombreUsuario
     *
     * @param string $nombreUsuario
     *
     * @return Usuario
     */
    public function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;

        return $this;
    }

    /**
     * Get nombreUsuario
     *
     * @return string
     */
    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

}
