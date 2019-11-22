<?php

require_once PATH_VUE."/Vue.php";
require_once PATH_MODELE."/modele.php";

class ControleurJeu{

	private $vue;
	private $dao;

	public function __construct(){
		$this->vue= new Vue();
		$this->dao= new Dao();
	}

	public function sortieJeu(){
		$this->vue->genereVueConnexion();
	}

	public function finDuJeu(){
		$this->vue->genereVueScore();
	}

	public function replay(){
		$this->vue->genereVueJeu();
	}




}

?>