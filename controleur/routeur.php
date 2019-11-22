<?php

require_once 'ctrlAuthentification.php';

class Routeur {

	private $ctrlAuthentification;


	public function __construct(){
		$this->ctrlAuthentification = new ControleurAuthentification();
	}
	//Fonction pour exécuter les requêtes
	public function routerRequete(){
		session_start();
		$this->ctrlAuthentification->accueilAuth();


	}


}