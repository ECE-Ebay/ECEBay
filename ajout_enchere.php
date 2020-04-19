<?php
//continue la session
session_start();

require 'verif_enchere.php';

$id_membres = $_SESSION['id_membres'];
//current date and time
$test = date('Y-m-d\TH:i:s');
//accès à la bdd
$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

//verification de id_membres
if (isset($_GET['id_item']) AND $_GET['id_item']>0) {
	if(isset($_POST['formajoutenchere']))
	{
		//récupération des variables récoltées dans le formulaire
		$date_fin = $_POST['ending-time'];
		$id_item = $_GET['id_item'];

		//verifie que les infos récoltées sont pas vides
		if(!empty($_POST['ending-time']))  
		{
			//insertion dans la base de donnée des infos de l'item
			$insertenchere= $bdd->prepare("INSERT INTO enchere(id_item, date_debut, date_fin)VALUES(?, ?, ?)");
			$insertenchere->execute(array($id_item, $test, $date_fin));
			header("Location: compte_vendeur.php?id_membres=$id_membres");
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Datetime de l'enchère</title>
</head>
<body>
	<h2>Date de fin de l'enchère:</h2>
	<form action="" method="post">
		<input type="datetime-local" id="ending-time"
		name="ending-time" value=""
		min="<?php echo $test ?>">
		<input type="submit" name="formajoutenchere"/></form>
	</body>
	</html>