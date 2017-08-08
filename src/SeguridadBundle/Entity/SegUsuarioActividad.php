<?php

namespace SeguridadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SegUsuarioActividad
 *
 * @ORM\Table(name="seg_usuario_actividad")
 * @ORM\Entity(repositoryClass="SeguridadBundle\Repository\SegUsuarioActividadRepository")
 */
class SegUsuarioActividad {

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_usuario_actividad_pk", type="integer")
     * @ORM\Id
     */
    private $codigoUsuarioActividadPk;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="usuarioActividadRel")
     */
    protected $usersUsuarioActividadRel;

   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usersUsuarioActividadRel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set codigoUsuarioActividadPk
     *
     * @param integer $codigoUsuarioActividadPk
     *
     * @return SegUsuarioActividad
     */
    public function setCodigoUsuarioActividadPk($codigoUsuarioActividadPk)
    {
        $this->codigoUsuarioActividadPk = $codigoUsuarioActividadPk;

        return $this;
    }

    /**
     * Get codigoUsuarioActividadPk
     *
     * @return integer
     */
    public function getCodigoUsuarioActividadPk()
    {
        return $this->codigoUsuarioActividadPk;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return SegUsuarioActividad
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add usersUsuarioActividadRel
     *
     * @param \SeguridadBundle\Entity\User $usersUsuarioActividadRel
     *
     * @return SegUsuarioActividad
     */
    public function addUsersUsuarioActividadRel(\SeguridadBundle\Entity\User $usersUsuarioActividadRel)
    {
        $this->usersUsuarioActividadRel[] = $usersUsuarioActividadRel;

        return $this;
    }

    /**
     * Remove usersUsuarioActividadRel
     *
     * @param \SeguridadBundle\Entity\User $usersUsuarioActividadRel
     */
    public function removeUsersUsuarioActividadRel(\SeguridadBundle\Entity\User $usersUsuarioActividadRel)
    {
        $this->usersUsuarioActividadRel->removeElement($usersUsuarioActividadRel);
    }

    /**
     * Get usersUsuarioActividadRel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsersUsuarioActividadRel()
    {
        return $this->usersUsuarioActividadRel;
    }
}
