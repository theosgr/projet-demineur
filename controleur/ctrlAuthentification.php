<?php 

require_once PATH_VUE."/Vue.php";
require_once PATH_MODELE."/modele.php";

class ControleurAuthentification{

	private $vue;
	private $dao;

	function __construct(){
		$this->vue=new Vue();
		$this->dao=new Dao();
	}

	public function accueilAuth(){

		if(isset($_POST["login"]) && isset($_POST["password"])){
			if($this->dao->connexion($_POST["login"], $_POST["password"])){
				$_SESSION["pseudo"] = $_POST["login"];
				$this->vue->genereVueJeu(-1,-1);
			}
			else {
				$this->vue->genereVueErreur();
				if(isset($_POST["retry"])){
					$this->vue->genereVueConnexion();
					unset($_POST["retry"]);
				}
			}
			
		} else 
		$this->vue->genereVueConnexion();

	}
}