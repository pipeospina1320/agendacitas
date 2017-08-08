<?php

namespace SeguridadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="seg_usuario_rol")
 * @ORM\Entity(repositoryClass="SeguridadBundle\Repository\SegUsuarioRolRepository")
 */
class SegUsuarioRol
{
    /**
     * @ORM\Id
     * @ORM\Column(name="codigo_usuario_rol_pk", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoUsuarioRolPk;
    
    /**
     * @ORM\Column(name="codigo_usuario_fk", type="integer", nullable=false)
     */    
    private $codigoUsuarioFk;
    
    /**
     * @ORM\Column(name="codigo_rol_fk", type="string", length=50)
     */    
    private $codigoRolFk;
     

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="usuariosRolesUsuarioRel")
     * @ORM\JoinColumn(name="codigo_usuario_fk", referencedColumnName="id")
     */
    protected $usuarioRel;
    
    /**
     * @ORM\ManyToOne(targetEntity="SegRoles", inversedBy="usuariosRolesRolRel")
     * @ORM\JoinColumn(name="codigo_rol_fk", referencedColumnName="codigo_rol_pk")
     */
    protected $rolRel;

    

    

    /**
     * Get codigoUsuarioRolPk
     *
     * @return integer
     */
    public function getCodigoUsuarioRolPk()
    {
        return $this->codigoUsuarioRolPk;
    }

    /**
     * Set codigoUsuarioFk
     *
     * @param integer $codigoUsuarioFk
     *
     * @return SegUsuarioRol
     */
    public function setCodigoUsuarioFk($codigoUsuarioFk)
    {
        $this->codigoUsuarioFk = $codigoUsuarioFk;

        return $this;
    }

    /**
     * Get codigoUsuarioFk
     *
     * @return integer
     */
    public function getCodigoUsuarioFk()
    {
        return $this->codigoUsuarioFk;
    }

    /**
     * Set codigoRolFk
     *
     * @param string $codigoRolFk
     *
     * @return SegUsuarioRol
     */
    public function setCodigoRolFk($codigoRolFk)
    {
        $this->codigoRolFk = $codigoRolFk;

        return $this;
    }

    /**
     * Get codigoRolFk
     *
     * @return string
     */
    public function getCodigoRolFk()
    {
        return $this->codigoRolFk;
    }

    /**
     * Set usuarioRel
     *
     * @param \SeguridadBundle\Entity\User $usuarioRel
     *
     * @return SegUsuarioRol
     */
    public function setUsuarioRel(\SeguridadBundle\Entity\User $usuarioRel = null)
    {
        $this->usuarioRel = $usuarioRel;

        return $this;
    }

    /**
     * Get usuarioRel
     *
     * @return \SeguridadBundle\Entity\User
     */
    public function getUsuarioRel()
    {
        return $this->usuarioRel;
    }

    /**
     * Set rolRel
     *
     * @param \SeguridadBundle\Entity\SegRoles $rolRel
     *
     * @return SegUsuarioRol
     */
    public function setRolRel(\SeguridadBundle\Entity\SegRoles $rolRel = null)
    {
        $this->rolRel = $rolRel;

        return $this;
    }

    /**
     * Get rolRel
     *
     * @return \SeguridadBundle\Entity\SegRoles
     */
    public function getRolRel()
    {
        return $this->rolRel;
    }
}
