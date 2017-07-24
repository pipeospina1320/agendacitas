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
     * @return int
     */
    public function getcodigoCitasPk() {
        return $this->$codigoCitasPk;
    }

}
