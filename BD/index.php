<?php
	function creat_array($data, $key){
		//print_r($data);
		$result = array();
		while($el = $data->fetch_array()){
		//print_r($el);
			array_push($result, $el[$key]);
		}
		return $result;
	}

# подключение к БД
	$data_base = new mysqli("localhost", "mysql", "mysql", "example_mysql");
	if($data_base->connect_error){
		die("Ошибка: " . $data_base->connect_error);
	}else{
		echo "Подключение успешно установлено<br>";
		$data_base->query("SET NAMES 'utf8'");
	}


# вывод персонажа с текущим счетом
	$person_id = 7;
	$name = $data_base->query("SELECT `fullname` FROM `persons` WHERE `id` = $person_id")->fetch_assoc()['fullname'];
	$take = creat_array($data_base->query("SELECT * FROM `transactions` WHERE `to_person_id` = $person_id"), 'amount');
	$give = creat_array($data_base->query("SELECT `amount` FROM `transactions` WHERE `from_person_id` = $person_id"), 'amount');
	$money = 100 + array_sum($take) - array_sum($give);
	echo $name.": ".$money."<br>";

# Вывод паерсонажа учавствовавший в транзакциях наибольшее число раз
	$customers = array();
	$transaction = creat_array($data_base->query("SELECT `from_person_id`, `to_person_id` FROM `transactions`"), 'from_person_id');
	$transaction = array_merge($transaction, creat_array($data_base->query("SELECT `from_person_id`, `to_person_id` FROM `transactions`"), 'to_person_id'));
	foreach($transaction as $el){
		if(array_key_exists($el, $customers)){
			$customers[$el] += 1;
		}else{
			$customers[$el] = 1;
		}
	}
	$big_customer = array_search(max($customers), $customers);
	echo "Наибольшее участие в транзакциях принял: ".$data_base->query("SELECT `fullname` FROM `persons` WHERE `id` = $big_customer")->fetch_assoc()['fullname']."<br>";

# транзации осуществляемые в одном городе
	echo "Транзакции в одном городе: <br>";
	echo "Номер : от кого -> кому : сколько<br>";
	$city = array();
	$pers = $data_base->query("SELECT `id`, `city_id` FROM `persons`");
	while($el = $pers->fetch_array()){
		$city[$el['id']] = $el['city_id'];
	}
	$trans = $data_base->query("SELECT * FROM `transactions`");
	while($el = $trans->fetch_array()){
		if($city[$el['from_person_id']] == $city[$el['to_person_id']]){
			echo $el['transaction_id']." : ";
			echo $el['from_person_id']." -> ";
			echo $el['to_person_id']." : ";
			echo $el['amount']."<br>";
		}
	}

# закрытие БД
	$data_base->close();
	
?>