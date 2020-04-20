<?php
//continue la session
session_start();

//$id_membres = $_SESSION['id_membres'];
$id_membres = 12;
//accès à la bdd
$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

//verification de id_membres
//if (isset($_GET['id_item']) AND $_GET['id_item']>0) {
	if(isset($_POST['echerie']))
	{
		//récupération des variables récoltées dans le formulaire
		$proposition = $_POST['offre'];
		//$id_enchere = $_GET['id_item'];
		$id_enchere = 58;

		//verifie que les infos récoltées sont pas vides
		if(!empty($_POST['offre']))  
		{
			//insertion dans la base de donnée des infos de l'offre d'enchere
			$insertproposition= $bdd->prepare("INSERT INTO offre_enchere(id_item, id_acheteur, offre)VALUES(?, ?, ?)");
			$insertproposition->execute(array($id_enchere, $id_membres, $proposition));
			echo "la proposition a bien été enregistrée.";
		}
	}
//}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Offre enchère</title>
	<link rel="icon" href="Logo ECEBay.png" type="image/gif"> <!-- pour l'icon --> 
</head>
<body>
	<h2>Montant de l'enchère:</h2>
	<form action="" method="post">
		<input type="number"
		name="offre">
		<input type="submit" name="echerie"/></form>
	</body>
	</html>