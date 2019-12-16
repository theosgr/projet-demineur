<?php 
class Demineur{

	private $matrice;
	private $visible;
	private $nbmine;


	public function __construct(){
		$this->matrice=array();
		$this->visible=array();
		$this->nbmine=0;
		for ($x=0; $x < 10; $x++) {
			for ($y=0; $y < 10; $y++) {
				$this->matrice[$x][$y]=5;
				$this->visible[$x][$y]=10;
			}
		}
		while($this->nbmine!=10){
			$x=rand(1,8);
			$y=rand(1,8);
			if ($this->matrice[$x][$y]!=9) {
				$this->matrice[$x][$y]=9;
				$this->nbmine+=1;
			}
		}

		$cpt=0;
		if($this->matrice[$x][$y]!=9){
			for($i=$x-1;$i<=$x+1;$i++){
				for ($j=$y-1;$j<=$y+1;$j++){
					if($this->matrice[$i][$j] == 9){
						$cpt+=1;
					}
				}
			}
		}
	}
	public function decouvrir($x,$y)
	{
		if ($this->visible[$x][$y]==10) {
			$this->visible[$x][$y]=$this->matrice[$x][$y];
			if ($this->matrice[$x][$y]==0){
				for ($i=$x-1;$i<=$x+1;$i++) { 
					for ($j=$y-1;$j<=$y+1;$j++) { 
						$_SESSION['grille']->decouvrir($i,$j);
					}
				}
			}
		}
	}

	public function isWin(){
		if($this->visible == $this->matrice){
			return True;
		} else return False;
	}

	public function isLost($x,$y){
		if($this->matrice[$x][$y]==9) {
			return True;
		} else return False;
	}

	
	
}


?>
