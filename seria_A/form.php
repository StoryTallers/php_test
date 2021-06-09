<?php
	include("simple_html_dom.php");
	if(isset($_POST["team_name"])){
		$team_name = $_POST["team_name"];
	}
	$base = "https://terrikon.com";
	$html = file_get_html("https://terrikon.com/football/italy/championship/");
	foreach($html->find('a') as $el){
		if($el->innertext == "Все Сезоны"){
			$all_seson = $base.$el->href."/";
			break;
		}
	}
	$html_all_seson = file_get_html($all_seson);
	$seson_list = array();
	foreach($html_all_seson->find('a') as $el){
		if(substr($el->innertext, 7) == ". Чемпионат Италии" or substr($el->innertext, 7) == ", Чемпионат Италии"){
			$key_name = substr($el->innertext, 0, 4);
			$value = $el->href;
			if(!array_key_exists($key_name, $seson_list)){
				$seson_list[$key_name] = $value;
			}
		}
	}
	ksort($seson_list);
	$response = array();
	foreach($seson_list as $el){
		$cur_seson = file_get_html($base.$el);
		$stop = false;
		foreach($cur_seson->find(tr) as $s){
			$i = 0;
			foreach($s->find(td) as $t){
				if($i == 2){
					break;
				}elseif($i == 0){
					$pos = $t->innertext;
				}
				if(strpos($t->innertext, "{$team_name}") !== false){
					$response[array_search($el, $seson_list)] = $pos;
					$stop = true;
				}
				$i++;
			}
			if($stop){
				break;
			}
		}
	}
	if(!empty ($response)){
		while ($el = current($response)) {
			echo key($response)." - ".$el."<br>";
			next($response);
		}
	}else{
		echo "Неверное название команды";
	}
?>