<?php

namespace GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="cliente")
 * @ORM\Entity(repositoryClass="GeneralBundle\Repository\ClienteRepository")
 */
class Cliente {

    /**
     * @ORM\Id
     * @ORM\Column(name="codigo_cliente_pk", type="integer", length=10)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoClientePk;

    /**
     * @ORM\Column(name="codigo_tipo_documento_fk", type="integer", nullable=false)
     */
    private $codigoTipoDocumentoFk;

    /**
     * @ORM\Column(name="num_documento", type="integer", length=15, nullable=false)
     */
    private $numDocumento;

    /**
     * @ORM\Column(name="primer_nombre", type="string", length=200, nullable=false)
     */
    private $primerNombre;

    /**
     * @ORM\Column(name="segundo_nombre", type="string", length=200, nullable=true)
     */
    private $segundoNombre;

    /**
     * @ORM\Column(name="primer_apellido", type="string", length=200, nullable=false)
     */
    private $primerApellido;

    /**
     * @ORM\Column(name="segundo_apellido", type="string", length=200, nullable=true)
     */
    private $segundoApellido;

    /**
     * @ORM\Column(name="telefono", type="string", length=200, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(name="celular", type="string", length=200, nullable=true)
     */
    private $celular;

    /**
     * @ORM\Column(name="direccion", type="string", length=200, nullable=true)
     */
    private $direccion;

   


    /**
     * Get codigoClientePk
     *
     * @return integer
     */
    public function getCodigoClientePk()
    {
        return $this->codigoClientePk;
    }

    /**
     * Set codigoTipoDocumentoFk
     *
     * @param integer $codigoTipoDocumentoFk
     *
     * @return Cliente
     */
    public function setCodigoTipoDocumentoFk($codigoTipoDocumentoFk)
    {
        $this->codigoTipoDocumentoFk = $codigoTipoDocumentoFk;

        return $this;
    }

    /**
     * Get codigoTipoDocumentoFk
     *
     * @return integer
     */
    public function getCodigoTipoDocumentoFk()
    {
        return $this->codigoTipoDocumentoFk;
    }

    /**
     * Set numDocumento
     *
     * @param integer $numDocumento
     *
     * @return Cliente
     */
    public function setNumDocumento($numDocumento)
    {
        $this->numDocumento = $numDocumento;

        return $this;
    }

    /**
     * Get numDocumento
     *
     * @return integer
     */
    public function getNumDocumento()
    {
        return $this->numDocumento;
    }

    /**
     * Set primerNombre
     *
     * @param string $primerNombre
     *
     * @return Cliente
     */
    public function setPrimerNombre($primerNombre)
    {
        $this->primerNombre = $primerNombre;

        return $this;
    }

    /**
     * Get primerNombre
     *
     * @return string
     */
    public function getPrimerNombre()
    {
        return $this->primerNombre;
    }

    /**
     * Set segundoNombre
     *
     * @param string $segundoNombre
     *
     * @return Cliente
     */
    public function setSegundoNombre($segundoNombre)
    {
        $this->segundoNombre = $segundoNombre;

        return $this;
    }

    /**
     * Get segundoNombre
     *
     * @return string
     */
    public function getSegundoNombre()
    {
        return $this->segundoNombre;
    }

    /**
     * Set primerApellido
     *
     * @param string $primerApellido
     *
     * @return Cliente
     */
    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    /**
     * Get primerApellido
     *
     * @return string
     */
    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    /**
     * Set segundoApellido
     *
     * @param string $segundoApellido
     *
     * @return Cliente
     */
    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    /**
     * Get segundoApellido
     *
     * @return string
     */
    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Cliente
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set celular
     *
     * @param string $celular
     *
     * @return Cliente
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Cliente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }
}
