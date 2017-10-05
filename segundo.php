<?php 
//# ganadores igual numero de ronda 

$arrayParticipantes = array(10, 20, 80, 2, 0, 1, -3);

calculaGanadores($arrayParticipantes);


function calculaGanadores($arrayParticipantes){
	for ($i=0; $i < count($arrayParticipantes); $i++) {
		$claves_aleatorias = array_rand($arrayParticipantes, $i+1);
		imprimirRonda($claves_aleatorias,$arrayParticipantes);
	}
}

function imprimirRonda($arrayGandores,$arrayParticipantes){
	$arrayGandores=(array)$arrayGandores;
	$resultados=array();
	foreach($arrayGandores as $key => $value) {
		$resultados[]=$arrayParticipantes[$value];
	}


	echo "Ronda :".count($arrayGandores)."<br>";
	//array_sum($resultados));
	print_r($resultados);


}
 ?>
