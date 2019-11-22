<?php

require_once 'ctrlAuthentification.php';
require_once 'ctrlJeu.php';

class Routeur {

	private $ctrlAuthentification;
	private $ctrlJeu;


	public function __construct(){
		$this->ctrlAuthentification = new ControleurAuthentification();
		$this->ctrlJeu = new ControleurJeu();
	}
	//Fonction pour exécuter les requêtes
	public function routerRequete(){
		session_start();

		if(isset($_POST["reset"])){
			session_unset();
			session_destroy();
			unset($_POST);
		}

		if(isset($_SESSION["pseudo"])){
			if(isset($_POST["deconnexion"])) {
				unset($_SESSION["pseudo"]);
				$this->ctrlAuthentification->accueilAuth();
				return;
			}
			
			


		}
		
		else $this->ctrlAuthentification->accueilAuth();


	}
}

?>