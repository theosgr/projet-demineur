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
	$nbBombes = 10
	//while($nbBombes <= 10) {
		
	//}

	?>
	<html>


	<body> 
		<h1 style="color:red;text-align: center"> Démineur </h1>
		<?php echo "Bienvenue " . $_SESSION["pseudo"]; ?> </br>
		Si vous quittez ou vous vous déconnectez la partie sera considérée comme perdue.
	</br></br></br></br></br></br>
	<p> 
		<table style="border:solid black 2 px;">
			<?php 
		// Création du plateau de jeu
			for($i = 0; $i <= 7; $i++){
				echo '<tr>';
				for($j = 0; $j <= 7;$j++){
					echo '<td style="width:30px;height:30px;text-align:center;border:solid black 1px;;"></td>';

				}
				echo '</tr>';
			}



			?>
		</table>
	</p>
</br></br>
<form method="post" action="index.php">
	<input type="submit" name="deconnexion" value="Deconnexion"/>
	<input type="submit" name="score" value="Score"/>
</form>

</body>
</html>
<?php
}



function genereVueScore($res){
	?>
	Les scores du jeu
	<?php
	if($res = "win") {
		echo "Bravo " . $_SESSION["pseudo"] . "vous avez gagné !";
	} elseif($res = "lose"){
		echo "Dommage " . $_SESSION["pseudo"] . "vous avez perdu ...";
	}
	?>

	<table style="border:solid black 2px">
		<tr>
			<th>Place</th>
			<th>Pseudo</th>
			<th>Victoires</th>
			<th>Ratio parties gagnées / jouées</th>
		</tr>
		<form method="post" action="index.php">
			<input type="submit" name="rejouer" value="Rejouer"/>
			<input type="submit" name="deconnexion" value="Deconnexion"/>
		</form>
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
