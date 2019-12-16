<?php

require_once PATH_VUE."/Vue.php";
require_once PATH_MODELE."/modele.php";
require_once PATH_MODELE."/demineur.php";

class ControleurJeu{

	private $vue;
	private $dao;
	private $demineur;

	public function __construct(){
		$this->vue= new Vue();
		$this->dao= new Dao();
		$this->demineur = new Demineur();
		$_SESSION["grille"] = $this->demineur;
	}

	public function continuer(){
		$this->vue->genereVueJeu(-1,-1);
	}

	public function jeu(){
		if(isset($_SESSION["pseudo"])){

			$podium = $this->dao->getPodium();
			if(isset($_POST["rejouer"])){
				if($this->dao->firstGame($login)){
					$this->dao->firstGameLose($login);
				} else {
					$this->dao->perdu($login);
				}
				$this->demineur = new Demineur();
				$_SESSION["grille"] = $this->demineur;
				$this->vue->genereVueJeu(-1,-1);
			}

			if(isset($_GET["x"]) and isset($_GET["y"])){
				if(($this->demineur->isLost() == False) and ($this->demineur->isWin() == False)){
					$_SESSION['grille']->decouvrir($x,$y);
					$val=$_SESSION['grille']->attribution_nombre($x,$y);
					$this->vue->genereVueJeu($x,$y,$val);	
				}

				else {
					$login = $_SESSION['pseudo'];
					if($this->dao->firstGame($login)){
						if($this->demineur->isWin()){
							$this->dao->firstGameWin($login);
							$this->vue->genereVueScore("win",$podium);
						}else if($this->demineur->isLost()){
							$this->dao->firstGameLose($login);
							$this->vue->genereVueScore("lose",$podium);
						}	
					}
					else{
						if($this->demineur->isWin()){
							$this->dao->gagne($login);
							$this->vue->genereVueScore("win",$podium);
						}
						elseif($this->demineur->isLost()){
							$this->dao->perdu($login);
							$this->vue->genereVueScore("lose",$podium);
						}
					}


				}
				
			}

		}
		
		
	}

	//Méthode à revoir, je ne suis pas sur de son utilisation
	public function score(){
		
	}


	public function replay(){
		
	}




}

?>