<?php

namespace SeguridadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="seg_roles")
 * @ORM\Entity
 */
class SegRoles
{
    /**
     * @ORM\Id
     * @ORM\Column(name="codigo_rol_pk", type="string", length=50)     
     */
    private $codigoRolPk;
    
    /**
     * @ORM\Column(name="nombre", type="string", length=150, nullable=true)
     */    
    private $nombre;   
    
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="rolRel")
     */
    protected $usersRolRel;    

    /**
     * @ORM\OneToMany(targetEntity="SegUsuarioRol", mappedBy="rolRel")
     */
    protected $usuariosRolesRolRel;    
    
    /**
     * Set codigoRolPk
     *
     * @param string $codigoRolPk
     *
     * @return SegRoles
     */
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usersRolRel = new \Doctrine\Common\Collections\ArrayCollection();
        $this->usuariosRolesRolRel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set codigoRolPk
     *
     * @param string $codigoRolPk
     *
     * @return SegRoles
     */
    public function setCodigoRolPk($codigoRolPk)
    {
        $this->codigoRolPk = $codigoRolPk;

        return $this;
    }

    /**
     * Get codigoRolPk
     *
     * @return string
     */
    public function getCodigoRolPk()
    {
        return $this->codigoRolPk;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return SegRoles
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
     * Add usersRolRel
     *
     * @param \SeguridadBundle\Entity\User $usersRolRel
     *
     * @return SegRoles
     */
    public function addUsersRolRel(\SeguridadBundle\Entity\User $usersRolRel)
    {
        $this->usersRolRel[] = $usersRolRel;

        return $this;
    }

    /**
     * Remove usersRolRel
     *
     * @param \SeguridadBundle\Entity\User $usersRolRel
     */
    public function removeUsersRolRel(\SeguridadBundle\Entity\User $usersRolRel)
    {
        $this->usersRolRel->removeElement($usersRolRel);
    }

    /**
     * Get usersRolRel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsersRolRel()
    {
        return $this->usersRolRel;
    }

    /**
     * Add usuariosRolesRolRel
     *
     * @param \SeguridadBundle\Entity\SegUsuarioRol $usuariosRolesRolRel
     *
     * @return SegRoles
     */
    public function addUsuariosRolesRolRel(\SeguridadBundle\Entity\SegUsuarioRol $usuariosRolesRolRel)
    {
        $this->usuariosRolesRolRel[] = $usuariosRolesRolRel;

        return $this;
    }

    /**
     * Remove usuariosRolesRolRel
     *
     * @param \SeguridadBundle\Entity\SegUsuarioRol $usuariosRolesRolRel
     */
    public function removeUsuariosRolesRolRel(\SeguridadBundle\Entity\SegUsuarioRol $usuariosRolesRolRel)
    {
        $this->usuariosRolesRolRel->removeElement($usuariosRolesRolRel);
    }

    /**
     * Get usuariosRolesRolRel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuariosRolesRolRel()
    {
        return $this->usuariosRolesRolRel;
    }
}
