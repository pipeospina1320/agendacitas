<?php

namespace GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comprobantes
 *
 * @ORM\Table(name="gen_forma_pago")
 * @ORM\Entity(repositoryClass="GeneralBundle\Repository\FormaPagoRepository")
 */
class FormaPago {

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_forma_pago_pk",length=11, type="integer")
     * @ORM\Id
     */
    private $codigoFormaPagoPk;

    /**
     * @ORM\Column(name="nombre_forma_pago", type="string", nullable=true)
     */
    private $nombreFormaPago;
    
    /**
     * @ORM\Column(name="pazo_dias", type="integer", nullable=true)
     */
    private $plazoDias;


   

    /**
     * Set codigoFormaPagoPk
     *
     * @param integer $codigoFormaPagoPk
     *
     * @return FormaPago
     */
    public function setCodigoFormaPagoPk($codigoFormaPagoPk)
    {
        $this->codigoFormaPagoPk = $codigoFormaPagoPk;

        return $this;
    }

    /**
     * Get codigoFormaPagoPk
     *
     * @return integer
     */
    public function getCodigoFormaPagoPk()
    {
        return $this->codigoFormaPagoPk;
    }

    /**
     * Set nombreFormaPago
     *
     * @param string $nombreFormaPago
     *
     * @return FormaPago
     */
    public function setNombreFormaPago($nombreFormaPago)
    {
        $this->nombreFormaPago = $nombreFormaPago;

        return $this;
    }

    /**
     * Get nombreFormaPago
     *
     * @return string
     */
    public function getNombreFormaPago()
    {
        return $this->nombreFormaPago;
    }

    /**
     * Set plazoDias
     *
     * @param integer $plazoDias
     *
     * @return FormaPago
     */
    public function setPlazoDias($plazoDias)
    {
        $this->plazoDias = $plazoDias;

        return $this;
    }

    /**
     * Get plazoDias
     *
     * @return integer
     */
    public function getPlazoDias()
    {
        return $this->plazoDias;
    }
}
