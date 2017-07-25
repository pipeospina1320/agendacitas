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
     * @ORM\Column(name="codigo_citas_pk", type="integer")
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
     * @ORM\Column(name="codigo_cliente_fk", type="integer", nullable=true )
     */
    private $codigoClienteFk;

    /**
     * @ORM\Column(name="codigo_usuario_fk", type="integer", nullable=true )
     */
    private $codigoUsuarioFk;

    /**
     * @ORM\ManyToOne(targetEntity="cliente", inversedBy="clientesRel")
     * @ORM\JoinColumn(name="codigo_cliente_fk", referencedColumnName="codigo_cliente_pk")
     */
    protected $clienteRel;

    /**
     * @ORM\ManyToOne(targetEntity="usuario", inversedBy="usuarioRel")
     * @ORM\JoinColumn(name="codigo_usuario_fk", referencedColumnName="codigo_usuario_pk")
     */
    protected $usuarioRel;

    /**
     * Get codigoCitasPk
     *
     * @return integer
     */
    public function getCodigoCitasPk() {
        return $this->codigoCitasPk;
    }

    /**
     * Set horaCita
     *
     * @param \DateTime $horaCita
     *
     * @return Citas
     */
    public function setHoraCita($horaCita) {
        $this->horaCita = $horaCita;

        return $this;
    }

    /**
     * Get horaCita
     *
     * @return \DateTime
     */
    public function getHoraCita() {
        return $this->horaCita;
    }

    /**
     * Set diaCita
     *
     * @param \DateTime $diaCita
     *
     * @return Citas
     */
    public function setDiaCita($diaCita) {
        $this->diaCita = $diaCita;

        return $this;
    }

    /**
     * Get diaCita
     *
     * @return \DateTime
     */
    public function getDiaCita() {
        return $this->diaCita;
    }

    /**
     * Set asuntoCita
     *
     * @param string $asuntoCita
     *
     * @return Citas
     */
    public function setAsuntoCita($asuntoCita) {
        $this->asuntoCita = $asuntoCita;

        return $this;
    }

    /**
     * Get asuntoCita
     *
     * @return string
     */
    public function getAsuntoCita() {
        return $this->asuntoCita;
    }

    /**
     * Set codigoClienteFk
     *
     * @param integer $codigoClienteFk
     *
     * @return Citas
     */
    public function setCodigoClienteFk($codigoClienteFk) {
        $this->codigoClienteFk = $codigoClienteFk;

        return $this;
    }

    /**
     * Get codigoClienteFk
     *
     * @return integer
     */
    public function getCodigoClienteFk() {
        return $this->codigoClienteFk;
    }

    /**
     * Set codigoUsuarioFk
     *
     * @param integer $codigoUsuarioFk
     *
     * @return Citas
     */
    public function setCodigoUsuarioFk($codigoUsuarioFk) {
        $this->codigoUsuarioFk = $codigoUsuarioFk;

        return $this;
    }

    /**
     * Get codigoUsuarioFk
     *
     * @return integer
     */
    public function getCodigoUsuarioFk() {
        return $this->codigoUsuarioFk;
    }

    /**
     * Set clienteRel
     *
     * @param \CitasBundle\Entity\cliente $clienteRel
     *
     * @return Citas
     */
    public function setClienteRel(\CitasBundle\Entity\cliente $clienteRel = null) {
        $this->clienteRel = $clienteRel;

        return $this;
    }

    /**
     * Get clienteRel
     *
     * @return \CitasBundle\Entity\cliente
     */
    public function getClienteRel() {
        return $this->clienteRel;
    }

    /**
     * Set usuarioRel
     *
     * @param \CitasBundle\Entity\usuario $usuarioRel
     *
     * @return Citas
     */
    public function setUsuarioRel(\CitasBundle\Entity\usuario $usuarioRel = null) {
        $this->usuarioRel = $usuarioRel;

        return $this;
    }

    /**
     * Get usuarioRel
     *
     * @return \CitasBundle\Entity\usuario
     */
    public function getUsuarioRel() {
        return $this->usuarioRel;
    }

}
