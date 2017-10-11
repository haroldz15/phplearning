
<!DOCTYPE html>
<html>
<head>
    <title>Problemas</title>
</head>
<body>
<h2>Problema 2</h2>
<p>En un concurso se establece que la cantidad de ganadores sea igual al número de ronda en la que se está participando, para elegir a los ganadores se obtiene un número aleatorio que será igual a la suma de los números de los participantes.
Ejemplo:
Se tiene que en el concurso están participando los números [10, 20, 80, 2, 0, 1, -3]
En la ronda #1 sale el número 20, entonces el ganador es el número 20 de los participantes.
En la ronda #2 sale el número 12, entonces los ganadores son 10 y 2
En la ronda #3 sale el número 83, entonces los ganadores son 80, 2, 1
En la ronda #4 sale el número 80, entonces los ganadores son 80, 2, 1, -3
Así hasta la ronda n.
Implementa una función donde le pueda indicar los <b>participantes</b>, <b>la ronda</b> y el <b>número aleatorio</b>, el cual debe indicarme quiénes son los ganadores según la ronda indicada.</p>

<!--Dibujamos formulario para ingresar los datos que pide el problema propuesto-->
<h3>Resolucion</h3>
<form action="" method="POST" autocomplete="false">
    <label>Participantes(,):</label><input type="text" name="participantes" required autocomplete="false" placeholder="a,b,c,d"><br>
    <label># rondas:</label><input type="text" name="rondas" required autocomplete="false" placeholder="#"><br>
    <label>Aleatorio:</label><input type="text" name="aleatorio" required autocomplete="false"  placeholder="#"><br>
    <center><input type="submit" name="guardar" value="Calcular Jugada"></center>
</form>
</body>
</html>
<?php

function calculaJugada($arrayParticipantes ,$rondas,$aleatorio,$resultadosRepetidos, $resultados,$rondaInicial) {

    //primera iteración , los numeros a combinar son los participantes
    if (empty($resultados)) {
        $resultados = $arrayParticipantes;
    }

    //en caso la ronda actual de la iteración sea 1 evaluar
    if ($rondas == 1) {
        //si la ronda input del formulario es 1 se devuelve el mismo aleatorio
        if ($rondaInicial==1){
            if (in_array($aleatorio, $arrayParticipantes)){
                echo $aleatorio;
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
                            echo "En la ronda # :".$rondaInicial." sale el número ".$aleatorio.' entonces los ganadores son : '.$cadenaNuevoResultado.'<br/>';

                            //se guarda este resultado en nuestro arreglo para evitar mostrarlo nuevamente
                            $resultadosRepetidos[] = $cadenaNuevoResultado;
                            }

                    }

                }

            }  

        }

    }
    //se llama  denuevo a la función pero se le pasa una ronda actual menos , además de el arreglo de resultados ya con posibles resultados , se baja las rondas para que el programa finalice al llegar a las rondas 1 y se retorne true luego de obtener todas las combinaciones posibles.
    return calculaJugada($arrayParticipantes, $rondas - 1, $aleatorio,$resultadosRepetidos,$resultados,$rondaInicial);
}


//ejecutar la lógica del programa cuando se reciba información del formulario.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//obteniendo los parametros del formulario
$arrayParticipantes =explode(',',$_POST["participantes"]);
$aleatorio = $_POST["aleatorio"];
$rondas = $_POST["rondas"];

//Inicializar arreglos de apoyo
$resultadosRepetidos = array();
$resultados = array();
echo "<h2>Resultado</h2>";
//llamar a funcion que calculara e imprimirá resultados
calculaJugada($arrayParticipantes,$rondas,$aleatorio,$resultadosRepetidos,$resultados,$rondas);
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

</style>
