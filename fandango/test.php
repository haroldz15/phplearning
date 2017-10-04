<?php 
$dishes=array(array("Pasta", "Tomato Sauce", "Onions", "Garlic"),array("Chicken Curry", "Chicken", "Curry Sauce"),array("Fried Rice", "Rice", "Onions", "Nuts"),array("Salad", "Spinach", "Nuts"),array("Sandwich", "Cheese", "Bread"),array("Quesadilla", "Chicken", "Cheese"));



function groupingDishes($dishes){
	//Getting the ingredients list
	$arrayIngredientes=array();
		foreach($dishes as $key => $rowDishes) { 
			for($i=1;$i<count($rowDishes);$i++) {
				$key=array_search($rowDishes[$i], array_column($arrayIngredientes, 0));
				if(is_numeric($key)){
					array_push($arrayIngredientes[$key],$rowDishes[0]);
				}else{
					$arrayIngredientes[]=array($rowDishes[$i],$rowDishes[0]);
				}
		 	}
		 }
	

	$arrayFinal=array_filter($arrayIngredientes,function($value){
		return count($value)>2;
	});
	//falta filtrar
	$arrayFinal=array_values($arrayFinal);
	print_r(json_encode($arrayFinal));

}

function sortArray($array){
foreach ($array as $key => $value) {
	foreach ($value as $key2 => $value2) {		
	}
}
}

groupingDishes($dishes);
/*
   dishes = [["Salad", "Tomato", "Cucumber", "Salad", "Sauce"],
o                ["Pizza", "Tomato", "Sausage", "Sauce", "Dough"],
o                ["Quesadilla", "Chicken", "Cheese", "Sauce"],
o                ["Sandwich", "Salad", "Bread", "Tomato", "Cheese"]]


[["Pasta", "Tomato Sauce", "Onions", "Garlic"],
o                ["Chicken Curry", "Chicken", "Curry Sauce"],
o                ["Fried Rice", "Rice", "Onions", "Nuts"],
o                ["Salad", "Spinach", "Nuts"],
o                ["Sandwich", "Cheese", "Bread"],
o                ["Quesadilla", "Chicken", "Cheese"]]

*/
 ?>