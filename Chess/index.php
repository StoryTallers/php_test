<?php
	interface IChessmen
	{
		public function move($x, $y);
		
		public function getPosition($name);
	}
	
	abstract class AbstractChessmen implements IChessmen
	{
		public $x;
		public $y;

		public function __construct($x = 0, $y = 0){
			if($x > 8 or $x < 1 or $y > 8 or $y < 1){
				echo "выход за пределы доски<br>";
			}else{
				$this->x = $x;
				$this->y = $y;
			}
		}
		
		public function getPosition($name){
			echo $name.": ".$this->x." ".$this->y."<br>";
		}
	}

	class King extends AbstractChessmen
	{
		public function move($x, $y){
			try{
				if($this->x - $x > 1 or $this->x - $x < -1 or $this->y - $y > 1 or $this->y - $y < -1 or $x > 8 or $x < 1 or $y > 8 or $y < 1){
					throw new Exception('Недопустимый ход');
				} else{
					$this->x = $x;
					$this->y = $y;
				}
			} catch(Exception $e){
				echo $e->getMessage()."<br>";
			}
		}
	}

	class Queen extends AbstractChessmen
	{
		public function move($x, $y){
			try{
				if($this->x - $x != 0 and $this->y - $y != 0){
					if($x > 8 or $x < 1 or $y > 8 or $y < 1 or abs($this->x - $x) != abs($this->y - $y)){
						throw new Exception('Недопустимый ход');
					} else{
						$this->x = $x;
						$this->y = $y;
					}
				}else{
					if($x > 8 or $x < 1 or $y > 8 or $y < 1){
						throw new Exception('Недопустимый ход');
					} else{
						$this->x = $x;
						$this->y = $y;
					}
				}
			} catch(Exception $e){
				echo $e->getMessage()."<br>";
			}
		}
	}
	
$queen = new Queen(1, 1);
$king = new King(4, 3);
echo "statr position: x y<br>";
$queen->getPosition("q");
$king->getPosition("k");

$queen->move(7, 1);
$king->move(3, 3);

$queen->getPosition("q");
$king->getPosition("k");

$queen->move(7, 3);
$king->move(2, 2);

$queen->getPosition("q");
$king->getPosition("k");

?>