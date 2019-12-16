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
			//session_destroy();
			if(isset($_POST["deconnexion"])) {
				$this->ctrlAuthentification->accueilAuth();
				session_unset();
				session_destroy();
				return;
			}
			else {
				$this->ctrlJeu->jeu();
			}


			


		}
		
		else $this->ctrlAuthentification->accueilAuth();


	}
}

?>