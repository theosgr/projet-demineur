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
			if (password_verify($password, $result["motDePasse"])) return true;
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

	//fonction modifiant le nombre de parties jouées et gagnées
	public function gagne($pseudo){
		try{
			$statement = $this->connexion->prepare("UPDATE parties set nbPartiesJouees =  nbPartiesJouees + 1 and nbPartiesGagnees =  nbPartiesGagnees + 1 and ratio = nbPartiesGagnees/nbPartiesJouees where pseudo = ?;");
			$statement->bindParam(1, $pseudo);
			$statement->execute();
		} catch(PDOException $e){
			$this->deconnexion();
			throw new TableAccesException("probleme d'acces a la table parties");
		}

	}

	//fonction modifiant le nombre de parties jouées et gagnées
	public function perdu($pseudo){
		try{
			$statement = $this->connexion->prepare("UPDATE parties set nbPartiesJouees = nbPartiesJouees + 1  where pseudo = ?;");
			$statement->bindParam(1, $pseudo);
			$statement->execute();
			} catch(PDOException $e){
			$this->deconnexion();
			throw new TableAccesException("probleme d'acces a la table parties");
		}
	}

	//première game
	public function firstGame($pseudo){
		try{
			$statement = $this->connexion->prepare("SELECT count(*) as ligne from parties where pseudo = ?");
			$statement->bindParam(1, $pseudo);
			$statement->execute();
			$result=$statement->fetch(PDO::FETCH_ASSOC);
			$statement->closeCursor();
			if($result["ligne"] == 0){
				return True;
			} else return False;
		} catch(PDOException $e){
			$this->deconnexion();
			throw new TableAccesException("probleme d'acces a la table parties");
		}

	} 

	//fonction pour la première game 
	public function firstGameWin($pseudo){
		try{
			$statement = $this->connexion->prepare("INSERT into parties values(?,1,1,1.0);");
			$statement->bindParam(1, $pseudo);
			$statement->execute();
			//$result=$statement->fetch(PDO::FETCH_ASSOC);
		} catch(PDOException $e){
			$this->deconnexion();
			throw new TableAccesException("probleme d'acces a la table parties");
		}


	}

	//fonction pour la première game lose 
	public function firstGameLose($pseudo){
		try{
			$statement = $this->connexion->prepare("INSERT into parties values(?,1,0,0.0);");
			$statement->bindParam(1, $pseudo);
			$statement->execute();
			//$result=$statement->fetch(PDO::FETCH_ASSOC);
		} catch(PDOException $e){
			$this->deconnexion();
			throw new TableAccesException("probleme d'acces a la table parties");
		}

	}

	//collecte les informations permettant d'établir les statistiques concernant les
	//3 meilleurs joueurs
	// si un problème est rencontré, une exception de type TableAccesException est levée
	public function getPodium(){
		try{
			$stmt=$this->connexion->prepare("SELECT pseudo, nbPartiesJouees ,nbPartiesGagnees,ratio from parties order by ratio DESC;");
			$stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $res;
		}catch(PDOException $e){
			$this->deconnexion();
			throw new TableAccesException("problème avec la table parties");
		}
	}




}

?>