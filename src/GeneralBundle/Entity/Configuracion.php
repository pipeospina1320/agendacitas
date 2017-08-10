<?php

namespace GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Configuracion
 *
 * @ORM\Table(name="gen_configuracion")
 * @ORM\Entity(repositoryClass="GeneralBundle\Repository\ConfiguracionRepository")
 */
class Configuracion
{
    /**
     * @var int
     *
     * @ORM\Column(name="codigo_configuracion_pk", type="integer")
     * @ORM\Id
     */
    private $codigoConfiguracionPk;




    /**
     * Set codigoConfiguracionPk
     *
     * @param integer $codigoConfiguracionPk
     *
     * @return Configuracion
     */
    public function setCodigoConfiguracionPk($codigoConfiguracionPk)
    {
        $this->codigoConfiguracionPk = $codigoConfiguracionPk;

        return $this;
    }

    /**
     * Get codigoConfiguracionPk
     *
     * @return integer
     */
    public function getCodigoConfiguracionPk()
    {
        return $this->codigoConfiguracionPk;
    }
}
