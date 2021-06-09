<title>тест Струпа</title>
<?php
	$word = array('red', 'blue', 'green', 'yellow', 'lime', 'magenta', 'black', 'gold', 'gray', 'tomato');
	$color = array('red', 'blue', 'green', 'yellow', 'lime', 'magenta', 'black', 'gold', 'gray', 'tomato');
	$select_word = rand(0, count($word) - 1);
	$select_color = rand(0, count($color) - 1);
?>
<body>
	<?php
		for($i=1; $i<=5; $i++){
			while ($select_word == $select_color) {
				$select_word = rand(0, count($word) - 1);
				$select_color = rand(0, count($color) - 1);
			}
			echo "<div style='color:{$color[$select_color]}'> {$word[$select_word]} </div>";
			$select_word = 1;
			$select_color = 1;
		}
	?>
</body>
