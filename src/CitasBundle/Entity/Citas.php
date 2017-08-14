<?php

namespace CitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="citas")
 * @ORM\Entity(repositoryClass="CitasBundle\Repository\CitasRepository")
 */
class Citas {

    /**
     * @ORM\Id
     * @ORM\Column(name="codigo_citas_pk", type="integer", length=10)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoCitasPk;

    /**
     * @ORM\Column(name="hora_cita", type="time", nullable=true)
     */
    private $horaCita;

    /**
     * @ORM\Column(name="dia_cita", type="date", nullable=true)
     */
    private $diaCita;

    /**
     * @ORM\Column(name="asunto_cita", type="string", length=200, nullable=true)
     */
    private $asuntoCita;

    /**
     * @ORM\Column(name="codigo_cliente_fk", type="integer", nullable=true, length=10)
     */
    private $codigoClienteFk;

    /**
     * @ORM\Column(name="codigo_empleado_fk", type="integer", nullable=true, length=10 )
     */
    private $codigoEmpleadoFk;

    /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="clientesRel")
     * @ORM\JoinColumn(name="codigo_cliente_fk", referencedColumnName="codigo_cliente_pk")
     */
    protected $clienteRel;

    /**
     * @ORM\ManyToOne(targetEntity="\EmpleadoBundle\Entity\Empleado", inversedBy="empleadoRel")
     * @ORM\JoinColumn(name="codigo_empleado_fk", referencedColumnName="codigo_empleado_pk")
     */
    protected $empleadoRel;



    /**
     * Get codigoCitasPk
     *
     * @return integer
     */
    public function getCodigoCitasPk()
    {
        return $this->codigoCitasPk;
    }

    /**
     * Set horaCita
     *
     * @param \DateTime $horaCita
     *
     * @return Citas
     */
    public function setHoraCita($horaCita)
    {
        $this->horaCita = $horaCita;

        return $this;
    }

    /**
     * Get horaCita
     *
     * @return \DateTime
     */
    public function getHoraCita()
    {
        return $this->horaCita;
    }

    /**
     * Set diaCita
     *
     * @param \DateTime $diaCita
     *
     * @return Citas
     */
    public function setDiaCita($diaCita)
    {
        $this->diaCita = $diaCita;

        return $this;
    }

    /**
     * Get diaCita
     *
     * @return \DateTime
     */
    public function getDiaCita()
    {
        return $this->diaCita;
    }

    /**
     * Set asuntoCita
     *
     * @param string $asuntoCita
     *
     * @return Citas
     */
    public function setAsuntoCita($asuntoCita)
    {
        $this->asuntoCita = $asuntoCita;

        return $this;
    }

    /**
     * Get asuntoCita
     *
     * @return string
     */
    public function getAsuntoCita()
    {
        return $this->asuntoCita;
    }

    /**
     * Set codigoClienteFk
     *
     * @param integer $codigoClienteFk
     *
     * @return Citas
     */
    public function setCodigoClienteFk($codigoClienteFk)
    {
        $this->codigoClienteFk = $codigoClienteFk;

        return $this;
    }

    /**
     * Get codigoClienteFk
     *
     * @return integer
     */
    public function getCodigoClienteFk()
    {
        return $this->codigoClienteFk;
    }

    /**
     * Set codigoEmpleadoFk
     *
     * @param integer $codigoEmpleadoFk
     *
     * @return Citas
     */
    public function setCodigoEmpleadoFk($codigoEmpleadoFk)
    {
        $this->codigoEmpleadoFk = $codigoEmpleadoFk;

        return $this;
    }

    /**
     * Get codigoEmpleadoFk
     *
     * @return integer
     */
    public function getCodigoEmpleadoFk()
    {
        return $this->codigoEmpleadoFk;
    }

    /**
     * Set clienteRel
     *
     * @param \CitasBundle\Entity\Cliente $clienteRel
     *
     * @return Citas
     */
    public function setClienteRel(\CitasBundle\Entity\Cliente $clienteRel = null)
    {
        $this->clienteRel = $clienteRel;

        return $this;
    }

    /**
     * Get clienteRel
     *
     * @return \CitasBundle\Entity\Cliente
     */
    public function getClienteRel()
    {
        return $this->clienteRel;
    }

    /**
     * Set empleadoRel
     *
     * @param \EmpleadoBundle\Entity\Empleado $empleadoRel
     *
     * @return Citas
     */
    public function setEmpleadoRel(\EmpleadoBundle\Entity\Empleado $empleadoRel = null)
    {
        $this->empleadoRel = $empleadoRel;

        return $this;
    }

    /**
     * Get empleadoRel
     *
     * @return \EmpleadoBundle\Entity\Empleado
     */
    public function getEmpleadoRel()
    {
        return $this->empleadoRel;
    }
}
