<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
</head>
<body>
<div id="problema1" >	 
	<h2>Problema 1</h2>
	<p>En un concurso se establece que la cantidad de ganadores sea igual al número de ronda en la que se está participando, para elegir a los ganadores se obtiene un número aleatorio que será igual a la suma de los números de los participantes.<br>
	Ejemplo:<br>
	Se tiene que en el concurso están participando los números [10, 20, 80, 2, 0, 1, -3]
	<ul><li>En la ronda #1 sale el número 20, entonces el ganador es el número 20 de los participantes.</li>
	<li>En la ronda #2 sale el número 12, entonces los ganadores son 10 y 2</li>
	<li>En la ronda #3 sale el número 83, entonces los ganadores son 80, 2, 1</li>
	<li>En la ronda #4 sale el número 80, entonces los ganadores son 80, 2, 1, -3</li>
	Así hasta la ronda n.</ul>
	Implementa una función donde le pueda indicar los <b>participantes</b>, <b>la ronda</b> y el <b>número aleatorio</b>, el cual debe indicarme quiénes son los ganadores según la ronda indicada.</p>
	<h3>Resolucion</h3>
	<?php 
	//ejecutar la lógica del programa cuando se reciba información del formulario.
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//obteniendo los parametros del formulario
	$arrayParticipantes =explode(',',$_POST["participantes"]);
	$aleatorio = $_POST["aleatorio"];
	$rondas = $_POST["ronda"];

	//Inicializar arreglos de apoyo
	$resultadosRepetidos = array();
	$resultados = array();
	echo "<B>Resultado de ronda</B><br>";
	//llamar a funcion que calculara e imprimirá resultados
	calculaRonda($arrayParticipantes,$rondas,$aleatorio,$resultadosRepetidos,$resultados,$rondas);
	}
	?>
	<!--Dibujamos formulario para ingresar los datos que pide el problema propuesto-->

	<br><form action="" method="POST" autocomplete="false">
	    <label>Participantes(separado por coma):</label><input type="text" name="participantes" required autocomplete="false" placeholder="Ej :10, 20, 80, 2, 0, 1, -3" value="<?php echo isset($_POST['participantes'])?$_POST['participantes']:''; ?>"><br>
	    <label># de Ronda:</label><input type="text" name="ronda" required autocomplete="false" placeholder="Ej :2" value="<?php echo isset($_POST['ronda'])?$_POST['ronda']:''; ?>"><br>
	    <label>Aleatorio:</label><input type="text" name="aleatorio" required autocomplete="false"  placeholder="Ej :10" value="<?php echo isset($_POST['aleatorio'])?$_POST['aleatorio']:''; ?>"><br>
	    <center><input type="submit" name="guardar" value="Calcular Ronda"></center>
	</form>
</div>
<hr>
<div id="problema2">
	<h2>Problema 2</h2>
	<p>You have a list of dishes. Each dish is associated with a list of ingredients used to prepare it. You want to group the dishes by ingredients, so that for each ingredient you'll be able to find all the dishes that contain it (if there are at least 2 such dishes).
	Return an array where each element is a list with the first element equal to the name of the ingredient and all of the other elements equal to the names of dishes that contain this ingredient. The dishes inside each list should be sorted alphabetically. The result array should be sorted alphabetically by the names of the ingredients in its elements.
	<!--Dibujamos formulario para ingresar los datos que pide el problema propuesto-->
	<h3>Resolucion</h3>
	<?php 

	$dishes2=array(array("Pasta", "Tomato Sauce", "Onions", "Garlic"),array("Chicken Curry", "Chicken", "Curry Sauce"),array("Fried Rice", "Rice", "Onions", "Nuts"),array("Salad", "Spinach", "Nuts"),array("Sandwich", "Cheese", "Bread"),array("Quesadilla", "Chicken", "Cheese"));


	$dishes1=array(array("Salad", "Tomato", "Cucumber", "Salad", "Sauce"),array("Pizza", "Tomato", "Sausage", "Sauce", "Dough"),array("Quesadilla", "Chicken", "Cheese", "Sauce"),array("Sandwich", "Salad", "Bread", "Tomato", "Cheese"));

	//arreglo de pruebas
	//$dishes1=array(array("Salad", "Tomato", "Cucumber", "Lettuce", "Sauce"),array("Pizza", "Tomato", "Sausage", "Sauce", "Dough"),array("Quesadilla", "Chicken", "Cheese", "Sauce","Beans"),array("Sandwich", "Beans", "Bread", "Tomato", "Cheese","Lettuce"));

	//llamar a la funcion para reorganizar el arreglo de dishes
	$groupedDishes=groupingDishes($dishes1);

	//imprimir el arreglo inicial y el output para una mejor visualización del problema y su solución 
	echo "<h3>Arreglo dishes #1 </h3>";
	imprimirArreglo($dishes1);
	echo "<h4>Arreglo grouped dishes #1 </h4>";	
	imprimirArreglo($groupedDishes);

	$groupedDishes=groupingDishes($dishes2);
	echo "<h3>Arreglo dishes #2 </h3>";
	imprimirArreglo($dishes2);
	echo "<h4>Arreglo grouped dishes #1 </h4>";	
	imprimirArreglo($groupedDishes);
	?>
</div>
</body>
</html>
<?php 

/*
Funciones para ambos problemas  
*/

//Función del primer problema
function calculaRonda($arrayParticipantes ,$rondas,$aleatorio,$resultadosRepetidos, $resultados,$rondaInicial) {

    //primera iteración , los numeros a combinar son los participantes
    if (empty($resultados)) {
        $resultados = $arrayParticipantes;
    }

    //en caso la ronda actual de la iteración sea 1 evaluar
    if ($rondas == 1) {
        //si la ronda input del formulario es 1 se devuelve el mismo aleatorio
        if ($rondaInicial==1){
            if (in_array($aleatorio, $arrayParticipantes)){
                echo "En la ronda # :<B>1</B> sale el número <B>".$aleatorio.'</B> entonces el ganador es  : <B>'.$aleatorio.'</B><br/>';
            } 
        }
        return true;
    }

    foreach ($resultados as $resultado) {
        //iterar sobre los resultados que se tienen hasta el momento

        foreach ($arrayParticipantes as $participante) {   
            //iterar sobre los participantes, que son los numeros que podemos usar para generar mas combinaciones

            if(strrpos($resultado,$participante)===false){
                //si el número no existe ya dentro de algun resultado entrar a generar una combinación , sino no pues tendriamos combinaciones con un mismo numero repedito Ej para 20 con 3 cifras : 20 0 0

                //se genera un nuevo resultado de los resultados anteriores y agregandole un numero participante
                $nuevoResultado= $resultado .','. $participante;
                //se agrega al arreglo de resultados obtenidos
                $resultados[]=$nuevoResultado;
                //se genera un arreglo de este resultado nuevo
                $arrayNuevoResultado = explode(',',$nuevoResultado);
                //se ordena el arreglo a fin de evitar mismos numeros en diferentes ordenes Ej: para 10 con 4 cifras : ¨10 1 2 -3 y 2 1 -3 10
                sort($arrayNuevoResultado);

                //si la longitud de este arreglo, es decir de los numeros participantes,es igual al numero de rondas del formulario se puede evaluar si se muestra.
                if (count($arrayNuevoResultado)==$rondaInicial){

                    //evaluar si la suma de este arreglo es igual al aleatorio que es lo que buscamos 
                    if(array_sum($arrayNuevoResultado) == $aleatorio){

                        //volvemos este arreglo a un string
                        $cadenaNuevoResultado = implode(' , ',$arrayNuevoResultado);

                        //evaluamos que esta cadena del resultado no la hayamos obtenido previamente
                        if(!in_array($cadenaNuevoResultado,$resultadosRepetidos)){

                            //si cumple que es una nueva cadena , tiene la longitud de las rondas indicadas y suma el aleatorio se muestra
                            echo "En la ronda # :<B>".$rondaInicial."</B> sale el número <B>".$aleatorio.'</B> entonces los ganadores son : <B>'.$cadenaNuevoResultado.'</B><br/>';

                            //se guarda este resultado en nuestro arreglo para evitar mostrarlo nuevamente
                            $resultadosRepetidos[] = $cadenaNuevoResultado;
                            }

                    }

                }

            }  

        }

    }
    //se llama  denuevo a la función pero se le pasa una ronda actual menos , además de el arreglo de resultados ya con posibles resultados , se baja las rondas para que el programa finalice al llegar a las rondas 1 y se retorne true luego de obtener todas las combinaciones posibles.
    return calculaRonda($arrayParticipantes, $rondas - 1, $aleatorio,$resultadosRepetidos,$resultados,$rondaInicial);
}


//función del segundo problema
function groupingDishes($dishes){
	
	//incializamos lo que sera el nuevo arreglo agrupado
	$arrayGroupedDishes=array();

		//iterar sobre el arreglo de platos
		foreach($dishes as $key => $rowDishes) { 

			/*
			iterar sobre cada fila del arreglo de platos sin contar el primero para obtener los solamente los ingredientes
			*/
			for($i=1;$i<count($rowDishes);$i++) {

				//Evaluar si existe en la primera columa del nuevo arreglo , es decir en la columna de ingredientes, un elemento de esta fila del arreglo dishes
				$key=array_search($rowDishes[$i], array_column($arrayGroupedDishes, 0));

				//si existe significa que ya existe ese ingrediente como cabecera de la fila
				if(is_numeric($key)){

					//agrega al arreglo de la fila del arreglo grouped dishes el nuevo plato del cual es parte
					array_push($arrayGroupedDishes[$key],$rowDishes[0]);

					//se almacena temporalmente el ingrediente del arreglo fila de grouped dishes
					$temporal=$arrayGroupedDishes[$key][0];		

					//se saca el ingrediente		
					array_shift($arrayGroupedDishes[$key]);

					//se ordena el arreglo que solo tiene platos y no el ingrediente que los identifica
					usort($arrayGroupedDishes[$key], "strnatcmp");

					//se vuelve a agregar el ingrediente que identifica a la fila de platos ya ordenados alfabeticamente
					array_unshift($arrayGroupedDishes[$key],$temporal);

				}else{
					//si no existe se agrega el ingrediente como cabecera de la fila acompañado de el plato del cual es parte como segundo elemento
					$arrayGroupedDishes[]=array($rowDishes[$i],$rowDishes[0]);

					//al agregarse un nuevo ingrediente se hace el ordenamiento para tener las filas del arreglo final ordenadas alfabeticamente por ingrediente.
					usort($arrayGroupedDishes, function($a, $b){
						return strnatcmp($a[0], $b[0]);
					});
				}

		 	}

		 }
	
	//finalmente se evalua el arreglo grouped dishes y se elimina los ingredientes que tengan una cantidad de platos menor a 2
	$arrayFinal=array_filter($arrayGroupedDishes,function($value){
		return count($value)>2;
	});

	//se eliminan las keys creadas por la funcion array filter
	$arrayFinal=array_values($arrayFinal);
	return $arrayFinal;

}


//funcion para representar el arreglo en pantalla del segundo problema
function imprimirArreglo($array){
	echo "[";
	for ($i=0; $i < count($array); $i++) { 
		$cadena=implode(" '','' ",$array[$i]);
		echo "[''".$cadena."'']";
		if($i<count($array)-1){
			echo ",<br>";}else{echo "]";
		}
	}
	echo "<br><br>";
}
 ?>
<!--Estilo ligero para dar facilidad de visualización a la página-->
<style type="text/css"> 
    form {    
    margin: 0 auto;
}

label, input {
    display: inline-block;
}

label {
    width: 30%;
    text-align: right;
}

label + input {
    width: 40%;
    margin: 0 30% 0 4%;
}

input[type=text] {
    padding: 2px 10px;
    margin: 8px 0;
    box-sizing: border-box;
}
body{
    font-family: Calibri;
}
.activo{
	display: block;
}
.inactivo{
	display: none;
}
</style>
