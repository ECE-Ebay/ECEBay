<?php 

//datetime actuel
$test = date('Y-m-d\TH:i:s');

//accès à la bdd
$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

//on cherche les encheres qui seraient passées de date et non dj faites
$reponse = $bdd->query('SELECT * FROM enchere');

while ($donnees = $reponse->fetch()) {
	$rep = $bdd->query('SELECT * FROM items');
	while ($don = $rep->fetch()) {
		if($donnees['id_item']==$don['id_item']) {
			if($don['statut']==0) {
				if($donnees['date_fin']<=$test) {
					//on cherche le gagnant
					$req=$bdd->prepare("SELECT * FROM offre_enchere WHERE id_item=?");
					$req->execute(array($don['id_item']));
					$participants=$req->rowCount();

					//si des personnes ont enchéries on continue, sinon on met le statut de l'enchère à 1 (finie)
					if($participants!=0) {
						$prix_gagnant = $don['prix_initial'];
						$id_gagnant = '';
						while ($d = $req->fetch()) {
							if($prix_gagnant<$d['offre']) {
								$prix_gagnant = $d['offre'];
								$id_gagnant = $d['id_acheteur'];
							}
							//fonction pour débiter l'acheteur à ajouter
						}
					}
					//on met le statut de l'enchère à 1: terminée
					$insertstatut=$bdd->prepare("UPDATE items SET statut = ? WHERE id_item = ?");
					$insertstatut->execute(array(1, $don['id_item']));
				}
			}
		}
	}
	
}

?>