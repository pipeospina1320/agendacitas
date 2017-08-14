<?php

namespace EmpleadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="empleado")
 * @ORM\Entity(repositoryClass="EmpleadoBundle\Repository\EmpleadoRepository")
 */
class Empleado {

    /**
     * @ORM\Id
     * @ORM\Column(name="codigo_empleado_pk", type="integer" , length=10)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoEmpleadoPk;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

   


    /**
     * Get codigoEmpleadoPk
     *
     * @return integer
     */
    public function getCodigoEmpleadoPk()
    {
        return $this->codigoEmpleadoPk;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Empleado
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
}
