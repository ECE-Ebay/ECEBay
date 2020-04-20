<?php 

session_start();
//accès à la bdd
$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

$id_membres = $_SESSION['id_membres'];

if (isset($_GET['id_item']))  
{  
	$id_item = $_GET['id_item'];
}  
else  
{  
	echo "cet item n'existe pas.";  
} 

$rep = $bdd->prepare('SELECT * FROM items WHERE id_item = ?');
$rep->execute(array($id_item));
$don = $rep->fetch();
$prix_a_payer = $don['prix_initial'];

$r=$bdd->prepare("SELECT * FROM carte_banquaire WHERE id_membre=?");
$r->execute(array($id_membres));
while ($monnaie = $r->fetch()) {	 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Achat immediat</title>
</head>
<body>
	<?php 

	if($monnaie['argent']>=$prix_a_payer) {
		$argent_apres = $monnaie['argent'] - $prix_a_payer;

					//on met l'argent de l'acheteur à jour
		$insertmoney=$bdd->prepare("UPDATE carte_banquaire SET argent = ? WHERE id_membre = ?");
		$insertmoney->execute(array($argent_apres, $id_membres));
					//on met le statut de l'enchère à 1: terminée
		$insertstatut=$bdd->prepare("UPDATE items SET statut = ? WHERE id_item = ?");
		$insertstatut->execute(array(1, $id_item));
					//on met l'appartenance à jour
		$insertstatut=$bdd->prepare("UPDATE items SET id_acheteur = ? WHERE id_item = ?");
		$insertstatut->execute(array($id_membres, $id_item));

		echo "achat confirmé"; ?>
<br>
		<a href="panier.php"><input style="background-color: #6f6f6f; color: #ffffff" type="button" value="Retour"/></a> <?php
	}else {
		echo "l'achat n'a pas pu avoir lieu, vérifiez que votre carte n'est pas périmée ou/et que vous avez toujours de l'argent sur votre compte";
	}

}



	?>
</body>
</html>

