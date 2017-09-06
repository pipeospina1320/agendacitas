<?php

namespace CitasBundle\Controller;

use CitasBundle\Entity\Citas;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CalendarioController extends Controller {

	var $nombre_dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
	function calendario(){
		
	}
	
	function mostrarBarra(){
		//proximamente
		?>
        <div id="barcal">
        </div>
        <?php
	}
	
	function mostrar(){
		$mes=date('m',time());
		$anio=date('Y',time());
		//dias mes anterior
		if($mes==1){ $mes_anterior=12; $anio_anterior = $anio-1; }
		else{ $mes_anterior = $mes-1; $anio_anterior = $anio; }
		
		$ultimo_dia_mes_anterior = date('t',mktime(0,0,0,$mes_anterior,1,$anio_anterior));
		
		$dia=1;
		if(strlen($mes)==1) $mes='0'.$mes;
		?>
		<table id="minical" cellpadding="0" cellspacing="0">
        <thead>
		 <tr >
		  <th><?php echo $this->nombre_dias[0]?></th>
		  <th><?php echo $this->nombre_dias[1]?></th>
		  <th><?php echo $this->nombre_dias[2]?></th>
		  <th><?php echo $this->nombre_dias[3]?></th>
		  <th><?php echo $this->nombre_dias[4]?></th>
		  <th><?php echo $this->nombre_dias[5]?></th>
		  <th><?php echo $this->nombre_dias[6]?></th>
		 </tr>
        </thead>
        <tbody>
		<?php
	
		
		$numero_primer_dia = date('w', mktime(0,0,0,$mes,$dia,$anio)); //numero dia en semana
		
		$ultimo_dia = date('t', mktime(0,0,0,$mes,$dia,$anio));
		
		$diferencia_mes_anterior = $ultimo_dia_mes_anterior - ($numero_primer_dia-1);
		
		$total_dias=$numero_primer_dia+$ultimo_dia;
		$diames=1;
		//$j dias totales (dias que empieza a contarse el 1Âº + los dias del mes)
		$j=1;
		while($j<=$total_dias){
			//if($j%2==0) echo "<tr class=\"odd\"> \n";
			//else 
			echo "<tr> \n";
			//$i contador dias por semana
			$i=0;
			$k=1; //dias proximo mes
			while($i<7){
				if($j<=$numero_primer_dia){
					echo "<td class=\"disabled\"> \n";
					echo "<div class=\"headbox\"> \n";
					echo $diferencia_mes_anterior;
					echo "</div>";
					echo "<div class=\"bodybox\"></div> \n";
					echo "</td> \n";
					$diferencia_mes_anterior++;
				}elseif($diames>$ultimo_dia){
					echo "<td class=\"disabled\"> \n";
					echo "<div class=\"headbox\"> \n";
					echo $k;
					echo "</div>";
					echo "<div class=\"bodybox\"></div> \n";
					echo"</td> \n";
					$k++; //dias proximo mes
				}else{
					if($diames<10) $diames_con_cero='0'.$diames;
					else $diames_con_cero=$diames;
	
					echo "<td>";
					echo "<div class=\"headbox\"> \n";
					echo $diames;
					echo "</div> \n";
					echo "<div class=\"bodybox\"></div> \n";
					echo "</td> \n";
					$diames++;
				}
				$i++;
				$j++;
			}
			echo "</tr> \n";
		}
		?>
         </tbody>
		</table>
		<?php
	}

}