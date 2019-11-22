<?php

// Classe generale de définition d'exception
class MonException extends Exception{
  private $chaine;
  public function __construct($chaine){
    $this->chaine=$chaine;
  }
}

// Exception relative à un problème de connexion
class ConnexionException extends MonException{
}

// Exception relative à un problème d'accès à une table
class TableAccesException extends MonException{
}

// Classe modèle
class Dao {

	private $connexion;

	//Constructeur pour set-up la connexion à la base de données
	public function __construct(){
		try{  
			$chaine="mysql:host=".HOST.";dbname=".BD;
			$this->connexion = new PDO($chaine,LOGIN,PASSWORD);
			$this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			$exception=new ConnexionException("problème de connexion à la base");
			throw $exception;
		}
	}

	//fonction permettant de se connecter avec les informations dans la base de données en vérifiant la présence d'un couple (pseudo/mdp)
	public function connexion($login,$password){
		try {
			$statement = $this->connexion->prepare("select motDePasse from joueurs where pseudo = ?;");
			$statement->bindParam(1, $login);
			$statement->execute();
			$result=$statement->fetch(PDO::FETCH_ASSOC);
			if (password_hash($password, $result["motDePasse"]) == $result["motDePasse"]) return true;
			else return false;
		}
		catch(PDOException $e){
			$this->deconnexion();
			throw new TableAccesException("problème avec la table pseudonyme");
		}
	}

	//fonction permettant de se déconnecter
	public function deconnexion(){
		$this->connexion=null;
	}

}

?>