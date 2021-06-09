<?php
		$denomination = explode(", ", $_POST["denomination"]);
		sort($denomination);
		$value = $_POST['money'];
		$botel = $value;
		$money_visor = array();
		for ($i = 0; $i < count($denomination); $i++){
			array_push($money_visor, 0);
		}
		while($botel != 0){
			for($i = count($denomination) - 1; $i >= 0; $i--){
				if($botel)
				if($botel >= $denomination[$i]){
					$botel -= $denomination[$i];
					$money_visor[$i] = $money_visor[$i] + 1;
					break;
				}
			}
			if ($denomination[0] > $botel){
				$up_limit = $value + $denomination[0] - $botel;
				$down_limit = $value - $botel;
				// Формируем массив для JSON ответа
				$str = "Неверная сумма. Введите другую сумму или одну из ближайших к вашей:<br>{$up_limit} или {$down_limit}";
				break;
			}
		}
		if ($botel == 0) {
			// Формируем массив для JSON ответа
			$str = "<table>";
			for($i = 0; $i < count($denomination); $i++){
				$str .= "<tr><td>{$denomination[$i]}</td><td>{$money_visor[$i]}</td></tr>";
			}
			$str .= "</table>";
		}
		// Переводим массив в JSON
		echo json_encode($str);
?>