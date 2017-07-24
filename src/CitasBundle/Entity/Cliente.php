<?php

namespace CitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="cliente")
 * @ORM\Entity(repositoryClass="CitasBundle\Repository\ClienteRepository")
 */
class Cliente {

    /**
     * @ORM\Id
     * @ORM\Column(name="codigo_cliente_pk", type="integer", length=10)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoClientePk;

    /**
     * @ORM\Column(name="codigo_tipo_documento_fk", type="integer", nullable=true)
     */
    private $codigoTipoDocumentoFk;

    /**
     * @ORM\Column(name="num_documento", type="integer", length=15, nullable=true)
     */
    private $numDocumento;

    /**
     * @ORM\Column(name="primer_nombre", type="string", length=200, nullable=true)
     */
    private $primerNombre;

    /**
     * @ORM\Column(name="segundo_nombre", type="string", length=200)
     */
    private $segundoNombre;

    /**
     * @ORM\Column(name="primer_apellido", type="string", length=200, nullable=true)
     */
    private $primerApellido;

    /**
     * @ORM\Column(name="segundo_apellido", type="string", length=200)
     */
    private $segundoApellido;

    /**
     * @ORM\Column(name="telefono", type="string", length=200)
     */
    private $telefono;

    /**
     * @ORM\Column(name="celular", type="string", length=200)
     */
    private $celular;

    /**
     * @ORM\Column(name="direccion", type="string", length=200)
     */
    private $direccion;

    /**
     * @ORM\Column(name="nombre_completo", type="string", length=200)
     */
    private $nombre_completo;

    # public function __get($propiedad) {
    #     if(property_exists($this, $propiedad)){
    #         return $this->$propiedad;
    #     }
    # }
    # public function __set($propiedad, $valor){
    #     if(property_exists($this, $propiedad)){
    #         $this->$propiedad = $valor;
    #     }
    # }   

    /**
     * Get codigoClientePk
     *
     * @return int
     */
    public function getcodigoClientePk() {
        return $this->codigoClientePk;
    }

    /**
     *  Set codigoTipoDocumentoFk
     * 
     *  @return Citas
     */
    public function setCodigoTipoDocumentoFk() {
        $this->codigoTipoDocumentoFk = $codigoTipoDocumento;
        return $this->codigoTipoDocumentoFk;
    }

    /**
     * Get codigoTipoDocumentoFk
     *
     * @return \String
     */
    public function getCodigotipoDocumentoFk() {
        return $this->codigoTipoDocumentoFk;
    }

    /**
     * Set numDocumento
     * 
     * @return Citas
     */
    public function setNumdocumento(){
        $this->numDocumento=$numDocumento;
        return $this->numDocumento;
    }
    
    /**
     * Get numdocumento
     * 
     * 
     */
    
}
