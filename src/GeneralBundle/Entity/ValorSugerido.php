<?php

namespace GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="gen_valor_sugerido")
 * @ORM\Entity(repositoryClass="GeneralBundle\Repository\ValorSugeridoRepository")
 */
class ValorSugerido {

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_valor_sugerido_pk", length=11, type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoValorSugeridoPk;

    /**
     * @ORM\Column(name="nombre_valor_sugerido", type="string", nullable=true)
     */
    private $nombreValorSugerido;



    /**
     * Get codigoValorSugeridoPk
     *
     * @return integer
     */
    public function getCodigoValorSugeridoPk()
    {
        return $this->codigoValorSugeridoPk;
    }

    /**
     * Set nombreValorSugerido
     *
     * @param string $nombreValorSugerido
     *
     * @return ValorSugerido
     */
    public function setNombreValorSugerido($nombreValorSugerido)
    {
        $this->nombreValorSugerido = $nombreValorSugerido;

        return $this;
    }

    /**
     * Get nombreValorSugerido
     *
     * @return string
     */
    public function getNombreValorSugerido()
    {
        return $this->nombreValorSugerido;
    }
}
