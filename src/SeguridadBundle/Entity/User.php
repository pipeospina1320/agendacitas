<?php

namespace SeguridadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="SeguridadBundle\Entity\UserRepository")
 * @DoctrineAssert\UniqueEntity(fields={"email"},message="Ya existe este correo") 
 */
class User

{

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(name="nombre_corto", type="string", length=255)
     */
    private $nombreCorto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $empresa;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $roles;

    /**
     * @ORM\Column(name="codigo_grupo_fk", type="integer", nullable=true)
     */
    private $codigoGrupoFk;
    
    /**
     * @ORM\Column(name="codigo_usuario_actividad_fk", type="integer", nullable=true)
     */
    private $codigoUsuarioActividadFk;

    /**
     * @ORM\Column(name="tareas_pendientes", type="integer")
     */
    private $tareasPendientes = 0;

    /**
     * @ORM\Column(name="notificaciones_pendientes", type="integer", options={"default":0}, nullable=true)
     */
    private $notificacionesPendientes = 0;

    /**
     * @ORM\Column(name="cargo", type="string", length=255)
     */
    private $cargo;

    /**
     * @ORM\Column(name="cambiar_clave", type="boolean", options={"default":false}, nullable=true)
     */
    private $cambiarClave = false;

    /**
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="SegRoles", inversedBy="usersRolRel")
     * @ORM\JoinColumn(name="roles", referencedColumnName="codigo_rol_pk")
     */
    protected $rolRel;

    /**
     * @ORM\ManyToOne(targetEntity="SegGrupo", inversedBy="usersGrupoRel")
     * @ORM\JoinColumn(name="codigo_grupo_fk", referencedColumnName="codigo_grupo_pk")
     */
    protected $grupoRel;
    
    /**
     * @ORM\ManyToOne(targetEntity="SegUsuarioActividad", inversedBy="usersUsuarioActividadRel")
     * @ORM\JoinColumn(name="codigo_usuario_actividad_fk", referencedColumnName="codigo_usuario_actividad_pk")
     */
    protected $usuarioActividadRel;

    /**
     * @ORM\OneToMany(targetEntity="SegUsuarioPermisoEspecial", mappedBy="usuarioRel")
     */
    protected $userUsuarioPermisoEspecialRel;

    /**
     * @ORM\OneToMany(targetEntity="SegUsuarioRol", mappedBy="usuarioRel")
     */
    protected $usuariosRolesUsuarioRel;

    /**
     * @ORM\OneToMany(targetEntity="SegPermisoDocumento", mappedBy="usuarioRel")
     */
    protected $permisosDocumentosUsuarioRel;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userUsuarioPermisoEspecialRel = new \Doctrine\Common\Collections\ArrayCollection();
        $this->usuariosRolesUsuarioRel = new \Doctrine\Common\Collections\ArrayCollection();
        $this->permisosDocumentosUsuarioRel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set nombreCorto
     *
     * @param string $nombreCorto
     *
     * @return User
     */
    public function setNombreCorto($nombreCorto)
    {
        $this->nombreCorto = $nombreCorto;

        return $this;
    }

    /**
     * Get nombreCorto
     *
     * @return string
     */
    public function getNombreCorto()
    {
        return $this->nombreCorto;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set empresa
     *
     * @param string $empresa
     *
     * @return User
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return string
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set codigoGrupoFk
     *
     * @param integer $codigoGrupoFk
     *
     * @return User
     */
    public function setCodigoGrupoFk($codigoGrupoFk)
    {
        $this->codigoGrupoFk = $codigoGrupoFk;

        return $this;
    }

    /**
     * Get codigoGrupoFk
     *
     * @return integer
     */
    public function getCodigoGrupoFk()
    {
        return $this->codigoGrupoFk;
    }

    /**
     * Set codigoUsuarioActividadFk
     *
     * @param integer $codigoUsuarioActividadFk
     *
     * @return User
     */
    public function setCodigoUsuarioActividadFk($codigoUsuarioActividadFk)
    {
        $this->codigoUsuarioActividadFk = $codigoUsuarioActividadFk;

        return $this;
    }

    /**
     * Get codigoUsuarioActividadFk
     *
     * @return integer
     */
    public function getCodigoUsuarioActividadFk()
    {
        return $this->codigoUsuarioActividadFk;
    }

    /**
     * Set tareasPendientes
     *
     * @param integer $tareasPendientes
     *
     * @return User
     */
    public function setTareasPendientes($tareasPendientes)
    {
        $this->tareasPendientes = $tareasPendientes;

        return $this;
    }

    /**
     * Get tareasPendientes
     *
     * @return integer
     */
    public function getTareasPendientes()
    {
        return $this->tareasPendientes;
    }

    /**
     * Set notificacionesPendientes
     *
     * @param integer $notificacionesPendientes
     *
     * @return User
     */
    public function setNotificacionesPendientes($notificacionesPendientes)
    {
        $this->notificacionesPendientes = $notificacionesPendientes;

        return $this;
    }

    /**
     * Get notificacionesPendientes
     *
     * @return integer
     */
    public function getNotificacionesPendientes()
    {
        return $this->notificacionesPendientes;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     *
     * @return User
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set cambiarClave
     *
     * @param boolean $cambiarClave
     *
     * @return User
     */
    public function setCambiarClave($cambiarClave)
    {
        $this->cambiarClave = $cambiarClave;

        return $this;
    }

    /**
     * Get cambiarClave
     *
     * @return boolean
     */
    public function getCambiarClave()
    {
        return $this->cambiarClave;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return User
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set rolRel
     *
     * @param \SeguridadBundle\Entity\SegRoles $rolRel
     *
     * @return User
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

    /**
     * Set grupoRel
     *
     * @param \SeguridadBundle\Entity\SegGrupo $grupoRel
     *
     * @return User
     */
    public function setGrupoRel(\SeguridadBundle\Entity\SegGrupo $grupoRel = null)
    {
        $this->grupoRel = $grupoRel;

        return $this;
    }

    /**
     * Get grupoRel
     *
     * @return \SeguridadBundle\Entity\SegGrupo
     */
    public function getGrupoRel()
    {
        return $this->grupoRel;
    }

    /**
     * Set usuarioActividadRel
     *
     * @param \SeguridadBundle\Entity\SegUsuarioActividad $usuarioActividadRel
     *
     * @return User
     */
    public function setUsuarioActividadRel(\SeguridadBundle\Entity\SegUsuarioActividad $usuarioActividadRel = null)
    {
        $this->usuarioActividadRel = $usuarioActividadRel;

        return $this;
    }

    /**
     * Get usuarioActividadRel
     *
     * @return \SeguridadBundle\Entity\SegUsuarioActividad
     */
    public function getUsuarioActividadRel()
    {
        return $this->usuarioActividadRel;
    }

    /**
     * Add userUsuarioPermisoEspecialRel
     *
     * @param \SeguridadBundle\Entity\SegUsuarioPermisoEspecial $userUsuarioPermisoEspecialRel
     *
     * @return User
     */
    public function addUserUsuarioPermisoEspecialRel(\SeguridadBundle\Entity\SegUsuarioPermisoEspecial $userUsuarioPermisoEspecialRel)
    {
        $this->userUsuarioPermisoEspecialRel[] = $userUsuarioPermisoEspecialRel;

        return $this;
    }

    /**
     * Remove userUsuarioPermisoEspecialRel
     *
     * @param \SeguridadBundle\Entity\SegUsuarioPermisoEspecial $userUsuarioPermisoEspecialRel
     */
    public function removeUserUsuarioPermisoEspecialRel(\SeguridadBundle\Entity\SegUsuarioPermisoEspecial $userUsuarioPermisoEspecialRel)
    {
        $this->userUsuarioPermisoEspecialRel->removeElement($userUsuarioPermisoEspecialRel);
    }

    /**
     * Get userUsuarioPermisoEspecialRel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserUsuarioPermisoEspecialRel()
    {
        return $this->userUsuarioPermisoEspecialRel;
    }

    /**
     * Add usuariosRolesUsuarioRel
     *
     * @param \SeguridadBundle\Entity\SegUsuarioRol $usuariosRolesUsuarioRel
     *
     * @return User
     */
    public function addUsuariosRolesUsuarioRel(\SeguridadBundle\Entity\SegUsuarioRol $usuariosRolesUsuarioRel)
    {
        $this->usuariosRolesUsuarioRel[] = $usuariosRolesUsuarioRel;

        return $this;
    }

    /**
     * Remove usuariosRolesUsuarioRel
     *
     * @param \SeguridadBundle\Entity\SegUsuarioRol $usuariosRolesUsuarioRel
     */
    public function removeUsuariosRolesUsuarioRel(\SeguridadBundle\Entity\SegUsuarioRol $usuariosRolesUsuarioRel)
    {
        $this->usuariosRolesUsuarioRel->removeElement($usuariosRolesUsuarioRel);
    }

    /**
     * Get usuariosRolesUsuarioRel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuariosRolesUsuarioRel()
    {
        return $this->usuariosRolesUsuarioRel;
    }

    /**
     * Add permisosDocumentosUsuarioRel
     *
     * @param \SeguridadBundle\Entity\SegPermisoDocumento $permisosDocumentosUsuarioRel
     *
     * @return User
     */
    public function addPermisosDocumentosUsuarioRel(\SeguridadBundle\Entity\SegPermisoDocumento $permisosDocumentosUsuarioRel)
    {
        $this->permisosDocumentosUsuarioRel[] = $permisosDocumentosUsuarioRel;

        return $this;
    }

    /**
     * Remove permisosDocumentosUsuarioRel
     *
     * @param \SeguridadBundle\Entity\SegPermisoDocumento $permisosDocumentosUsuarioRel
     */
    public function removePermisosDocumentosUsuarioRel(\SeguridadBundle\Entity\SegPermisoDocumento $permisosDocumentosUsuarioRel)
    {
        $this->permisosDocumentosUsuarioRel->removeElement($permisosDocumentosUsuarioRel);
    }

    /**
     * Get permisosDocumentosUsuarioRel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPermisosDocumentosUsuarioRel()
    {
        return $this->permisosDocumentosUsuarioRel;
    }
}
