<?php
// Vue authentification de l'utilisateur précédant la fenêtre de jeu
class Vue {


	function genereVueConnexion(){
		header("Content-type: text/html; charset=utf-8");
		?>
		<html>
		<head>
			<title> Demineur </title>
		</head>
		<body>
			<p> Connectez-vous pour pouvoir jouer </p>
		</br>

		<form action="index.php" method="post">
			login<input type="text" placeholder="Pseudonyme" name="login" id="login"/> 
		</br>
		mot de passe<input type="password" name="password" id="password"/>
		<input type="submit" name="connexion" value="connexion"/>
	</form>
</body>

<?php 
	}
}

	function genereVueJeu(){



	}



	function genereVueScore(){

	}


	function genereVueErreur($titre, $desc, $link){
    ?>
      <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $titre ?></h5>
  
          <div class="modal-body">
            <p><?php echo $desc ?></p>
          </div>
          <div class="modal-footer">
            <a href="index.php<?php echo $link ?>" class="btn btn-primary">Fermer</a>
          </div>

 
    <?php
  }

?>