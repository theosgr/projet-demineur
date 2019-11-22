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
		<input type="reset" name="effacer" value="Annuler"/>
	</form>
</body>

<?php 
}


function genereVueJeu(){
	header("Content-type: text/html; charset=utf-8");
	?>
	<html>


	<body> 
		<h1 style="color:red;text-align: center"> Démineur </h1>



		<form method="post" action="index.php">
			<input type="submit" name="deconnexion" value="Deconnexion"/>
			<input type="submit" name="rejouer" value="Rejouer"/>
		</form>

	</body>
	</html>
	<?php
}



function genereVueScore(){
	?>

	Les scores du jeu
	<?php
}


function genereVueErreur(){
	header("Content-type: text/html; charset=utf-8");
	?>
	<html>
	<body>



		<br/>
		<br/>
		<form method="post" action="index.php">
			Pseudo ou mot de passe incorrect
			<input type="submit" name="retry" value="Réessayer"/>
		</form>
		<br/>
		<br/>

		<?php
	}
}
?>
