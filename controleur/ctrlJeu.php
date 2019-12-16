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
	}

	public function jeu(){
		if(isset($_SESSION["pseudo"])){
			$login = $_SESSION['pseudo'];
			$_SESSION['grille'] = $this->demineur;
			$_SESSION['mode'] = 1;

			/*if(isset($_POST["rejouer"])){
				if($this->dao->firstGame($login)){
					$this->dao->firstGameLose($login);
				} else {
					$this->dao->perdu($login);
				}
				$this->demineur = new Demineur();
				$_SESSION["grille"] = $this->demineur;
				$this->vue->genereVueJeu(-1,-1);
			}*/

			if(isset($_GET["x"]) and isset($_GET["y"])){
				if(($this->demineur->isLost($_GET["x"],$_GET["y"]) == False) and ($this->demineur->isWin() == False)){
					if(isset($_SESSION['grille'])){
						$_SESSION['grille']->decouvrir($_GET["x"],$_GET["y"]);
						$this->vue->genereVueJeu($_GET["x"],$_GET["y"]);		
					} 
					
				}

				else {
					
					if($this->dao->firstGame($login)){
						if($this->demineur->isWin()){
							$this->dao->firstGameWin($login);
							$podium = $this->dao->getPodium();
							$this->vue->genereVueScore("win",$podium);
						}else if($this->demineur->isLost($_GET["x"],$_GET["y"])){
							$this->dao->firstGameLose($login);
							$podium = $this->dao->getPodium();
							$this->vue->genereVueScore("lose",$podium);
						}	
					}
					else{
						if($this->demineur->isWin()){
							$this->dao->gagne($login);
							$podium = $this->dao->getPodium();
							$this->vue->genereVueScore("win",$podium);
						}
						elseif($this->demineur->isLost($_GET["x"],$_GET["y"])){
							$this->dao->perdu($login);
							$podium = $this->dao->getPodium();
							$this->vue->genereVueScore("lose",$podium);
						}
					}


				}
				
			}

		}
		
		
	}




}

?>