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


function genereVueJeu($x,$y){
	header("Content-type: text/html; charset=utf-8");

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
					echo '<td style="width:30px;height:30px;text-align:center;border:solid black 1px;;"><a href="index.php?x='.$j.'&y='.$i.'"alt="coordonnees demineur">X</a></td>';

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



function genereVueScore($res,$podium){
	?>
	Les scores du jeu
	<?php
	if($res = "win") {
		echo "Bravo " . $_SESSION["pseudo"] . " vous avez gagne !";
	} elseif($res = "lose"){
		echo "Dommage " . $_SESSION["pseudo"] . " vous avez perdu ...";
	}
	?>

	<table style="border:solid black 2px">
		<tr>
			<th>Place</th>
			<th>Pseudo</th>
			<th>Parties jouees</th>
			<th>Victoires</th>
			<th>Ratio</th>
		</tr>
		<?php
		$cpt = 1;

		foreach($podium as $row ){
			echo "<tr><td>".$cpt."</td> <td>". $row["pseudo"] ."</td> <td>". $row["nbPartiesJouees"] ."</td> <td>". $row["nbPartiesGagnees"] ."</td> <td>". $row["ratio"] ."</td></tr>";
			$cpt++;
		}
			





		?>
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
