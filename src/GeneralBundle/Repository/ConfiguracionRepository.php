<?php

namespace GeneralBundle\Repository;

/**
 * ConfiguracionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ConfiguracionRepository extends \Doctrine\ORM\EntityRepository {

    public function cerrarPeriodo($periodoActual) {
        $em = $this->getEntityManager();
        $arCierre = new \GeneralBundle\Entity\Configuracion();
        $arCierre = $em->getRepository('GeneralBundle:Configuracion')->find(1);

        $articulos = new \InventarioBundle\Entity\Articulo();
        $articulos = $em->getRepository('InventarioBundle:Articulo')->findAll();


        $kardex = new \InventarioBundle\Entity\KardexArticulo();
        $kardex = $em->getRepository('InventarioBundle:KardexArticulo')->findAll();


        $periodoAnterior = $periodoActual - 1;

        //consuta ultimo cierre inventario en configuracion
        $ultimoCierreInventario = $arCierre->getUltimoCierreInventario();

        $dql = "SELECT COUNT(mk.codigoKardexArticuloPk) as kardex FROM InventarioBundle:KardexArticulo mk  "
                . "WHERE mk.periodoMovimiento = " . $periodoAnterior
                . " ORDER by mk.fechaMovimiento ASC";
        $query = $em->createQuery($dql);
        $arrayResultado = $query->getResult();
        $codigoKardexPk = $arrayResultado[0]['kardex'];
        if ($ultimoCierreInventario == $periodoAnterior) {
            echo "periodo ya cerrado";
        } else {


            foreach ($articulos as $codigoArticulo) {
                $articulos = $em->getRepository('InventarioBundle:Articulo')->findOneBy(array('codigoArticuloPk' => $codigoArticulo));
                if ($articulos->getManejaKardex() == 1) {
                    if ($codigoKardexPk == 0) {
                        $articulo = new \InventarioBundle\Entity\Articulo();
                        $articulo = $em->getRepository('InventarioBundle:Articulo')->findOneBy(array('codigoArticuloPk' => $codigoArticulo));
                        $saldos = new \InventarioBundle\Entity\SaldosArticulos();

                        $saldos->setArticuloRel($articulo);
                        $saldos->setPeriodo($periodoAnterior);
                        $saldos->setSaldoInicial('0');
                        $saldos->setEntradas('0');
                        $saldos->setSalidas('0');
                        $saldos->setSaldoFinal('0');
                        $saldos->setCostoPromedio('0');
                        $saldos->setCostoUnitario('0');
                        $saldos->setUltimoCosto('0');
                        $em->persist($saldos);
                        $em->flush();
                    }
                    if ($codigoKardexPk > 0) {
                        $articulo = new \InventarioBundle\Entity\Articulo();

                        $articulo = $em->getRepository('InventarioBundle:Articulo')->findOneBy(array('codigoArticuloPk' => $codigoArticulo));
                        $codigo = $articulo->getCodigoArticuloPk();
                        $saldos = new \InventarioBundle\Entity\SaldosArticulos();

                        $dql = "SELECT COUNT(mk.codigoKardexArticuloPk) as kardex FROM InventarioBundle:KardexArticulo mk  "
                                . "WHERE mk.codigoArticuloFk = " . $codigo . " " . "AND mk.periodoMovimiento = " . $periodoAnterior
                                . " ORDER by mk.fechaMovimiento ASC";
                        $query = $em->createQuery($dql);
                        $arrayResultado = $query->getResult();
                        $numeroRegistros = $arrayResultado[0]['kardex'];

                        if ($numeroRegistros == 0) {
                            //saldos 
                            $saldos->setArticuloRel($articulo);
                            $saldos->setPeriodo($periodoAnterior);
                            $saldos->setSaldoInicial('0');
                            $saldos->setEntradas('0');
                            $saldos->setSalidas('0');
                            $saldos->setSaldoFinal('0');
                            $saldos->setCostoPromedio('0');
                            $saldos->setCostoUnitario('0');
                            $saldos->setUltimoCosto('0');
                            $em->persist($saldos);
                            $em->flush();
                        }

                        if ($numeroRegistros > 0) {
                            $saldos->setArticuloRel($articulo);
                            $saldos->setPeriodo($periodoAnterior);

                            $dql = "SELECT mk.saldoAnterior as kardex FROM InventarioBundle:KardexArticulo mk  "
                                    . "WHERE mk.codigoArticuloFk = " . $codigo . " " . "AND mk.periodoMovimiento = " . $periodoAnterior
                                    . " ORDER by mk.fechaMovimiento ASC";
                            $query = $em->createQuery($dql);
                            $arrayResultado = $query->getResult();
                            $saldoInicial = $arrayResultado[0]['kardex'];

                            $dql = "SELECT SUM(mk.salidas) as salidas FROM InventarioBundle:KardexArticulo mk  "
                                    . "WHERE mk.codigoArticuloFk = " . $codigo . " " . "AND mk.periodoMovimiento = " . $periodoAnterior
                                    . " ORDER by mk.fechaMovimiento ASC";
                            $query = $em->createQuery($dql);
                            $arrayResultado = $query->getResult();
                            $salidas = $arrayResultado[0]['salidas'];

                            $dql = "SELECT SUM(mk.entradas) as entradas FROM InventarioBundle:KardexArticulo mk  "
                                    . "WHERE mk.codigoArticuloFk = " . $codigo . " " . "AND mk.periodoMovimiento = " . $periodoAnterior
                                    . " ORDER by mk.fechaMovimiento ASC";
                            $query = $em->createQuery($dql);
                            $arrayResultado = $query->getResult();
                            $entradas = $arrayResultado[0]['entradas'];

                            $dql = "SELECT mk.costoPromedio as costoPromedio FROM InventarioBundle:KardexArticulo mk  "
                                    . "WHERE mk.codigoArticuloFk = " . $codigo . " " . "AND mk.periodoMovimiento = " . $periodoAnterior
                                    . " ORDER by mk.fechaMovimiento DESC";
                            $query = $em->createQuery($dql);
                            $arrayResultado = $query->getResult();
                            $costoPromedio = $arrayResultado[0]['costoPromedio'];

                            //saldos 
                            $saldos->setSaldoInicial($saldoInicial);
                            $saldos->setEntradas($entradas);
                            $saldos->setSalidas($salidas);
                            $saldoFinal = $saldoInicial + $entradas - $salidas;
                            $saldos->setSaldoFinal($saldoFinal);
                            $saldos->setCostoPromedio($costoPromedio);
                            $saldos->setCostoPromedioAnterior('0');
                            $costoUnitario = $costoPromedio / $saldoFinal;
                            $saldos->setCostoUnitario($costoUnitario);
                            $saldos->setCostoUnitarioAnterior('0');
                            $saldos->setUltimoCosto('0');
                            $saldos->setUltimoCostoAnterior('0');
                            $em->persist($saldos);
                            $em->flush();
                        }
                    }
                }
            }
            $arCierre->setUltimoCierreInventario($periodoAnterior);
            $em->persist($saldos);
            $em->flush();
        }
    }

}
