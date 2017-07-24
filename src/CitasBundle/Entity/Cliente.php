<?php

namespace CitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="cliente")
 * @ORM\Entity(repositoryClass="CitasBundle\Repository\EmpleadoRepository")
 */
class cliente {

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
     * @ORM\Column(name="num_documento", type="integer", nullable=true)
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
     * Get codigoCitasPk
     *
     * @return int
     */
    public function getcodigoCitasPk() {
        return $this->$codigoCitasPk;
    }

}
