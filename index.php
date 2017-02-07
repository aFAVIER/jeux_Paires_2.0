<?php
//détecte si début de jeux ou victoire
	if (isset($_GET['name'])) {
		$name=htmlspecialchars($_GET['name']);
		$min=(int)htmlspecialchars($_GET['min']);
		$sec=(int)htmlspecialchars($_GET['sec']);
		$etat="victoire";
	//inscription dans un fichier txt
		$sauvegarde = fopen ("session.txt", "r+");
		fseek ($sauvegarde, 0);
		fputs ($sauvegarde, '"'.$name.'", "'.$min.'", "'.$sec.'"');
		fclose ($sauvegarde);

	}else{
		$etat="jeux";
	}
?>
<?php
//tableau et concat pour avoir le double d'images
	$tableau = array ("img/ane.jpg", "img/chat.jpg", "img/chien.jpg", "img/lama.jpg", "img/lapins.jpg", "img/lionne.jpg", "img/ours.jpg");
	$list = array_merge($tableau, $tableau);
?>
<?php
//random de la liste
	shuffle($list);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Jeux-des-paires</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link href="https://fonts.googleapis.com/css?family=Kumar+One" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="http://csshake.surge.sh/csshake.min.css">
	<link rel="stylesheet" type="text/css" href="css/theme4.css">
	<script type="text/javascript">
		//passerelle entre le PhP et le javaScript pour faire le lien entre le tableau PhP et les varible JS
		<?php
			echo 'var tab =[';	//----------------------début d'un tableau JS
			foreach ($list as $key =>$tab ) {	//		parcour le tableau
				echo'"'.$tab.'"' ;	//------------------milieu du tableau JS
				if ($key!= sizeof($list)-1 ) { //		compare a la longueur du tab pour ne pas mettre la dernière virgule 
					echo ', ';
				}
			}
			echo "];";	//-------------------------------fin du tableau JS
		?>
	</script>
</head>
	<body class="container">
		<h1 class="row text-center">JEU DES PAIRES</h1>
		<?php
		//lors du début du jeux affichage de tout cela
			if ($etat == "jeux") {
				echo '<div>
						<h3 class="text-center" ">Règles du jeu: Afficher toutes les paires pour gagner</h3>
						<p>Vous avez trouvé <span id="paires">0</span> paires cachées</p>
						<span id="chronotime">00:00</span>
					</div>
			
						<div id="photo">';
		//affiche le dos des cartes selon le nombre d'img du tableau
					 	for($dos=0; $dos< sizeof($list); $dos++) {
							echo '<img src="img/dos.png" class="photo" onclick="choisir('.$dos.')" draggable="false">';
				}
			}elseif($etat == "victoire"){
		//lorsque le jeux est fini
				echo "<h1 class='row text-center'> BRAVO vous avez gagné !! </h1>";
				echo "<div class='row  '><button class='btn btn-success center-block' id='btnReload'>recommencer</button></div>";
			}
		?>
		</div>
		<script type="text/javascript" src='js/jquery-3.1.1.slim.js'></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>