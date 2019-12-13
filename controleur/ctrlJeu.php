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

	public function sortieJeu(){
		$this->vue->genereVueConnexion();
	}

	public function finDuJeu(){
		if(isset($_POST["score"])){
			$this->vue->genereVueScore("win");	
		}
		
	}

	public function replay(){
		if(isset($_POST["rejouer"])){
		$this->vue->genereVueJeu();
	}
	}




}

?>