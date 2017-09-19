<?php

namespace GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * periodos
 *
 * @ORM\Table(name="gen_periodos")
 * @ORM\Entity(repositoryClass="GeneralBundle\Repository\PeriodosRepository")
 */
class Periodos {

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_periodo_pk", length=11, type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoPeriodoPk;

    /**
     * @ORM\Column(name="periodo", type="string", nullable=true)
     */
    private $periodo;




    /**
     * Get codigoPeriodoPk
     *
     * @return integer
     */
    public function getCodigoPeriodoPk()
    {
        return $this->codigoPeriodoPk;
    }

    /**
     * Set periodo
     *
     * @param string $periodo
     *
     * @return Periodos
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get periodo
     *
     * @return string
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }
}
