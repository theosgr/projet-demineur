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
				session_destroy();
				$this->ctrlAuthentification->accueilAuth();
				return;
			}
			if(isset($_POST["rejouer"])){
				$this->ctrlJeu->replay();
			}
			if(isset($_POST["score"])){
				$this->ctrlJeu->finDuJeu();
			}

			


		}
		
		else $this->ctrlAuthentification->accueilAuth();


	}
}

?>