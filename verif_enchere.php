<?php 

date_default_timezone_set('Europe/Paris');

$test = date("Y-m-d H:i:s");
echo $test;

//accès à la bdd
$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

//on cherche les encheres qui seraient passées de date et non dj faites
$reponse = $bdd->query('SELECT * FROM enchere');

while ($donnees = $reponse->fetch()) {
	$rep = $bdd->query('SELECT * FROM items');
	while ($don = $rep->fetch()) {
		if($donnees['id_item']==$don['id_item']) {
			$prix_a_payer = $don['prix_initial'];
			$prix_gagnant = $don['prix_initial'];
			$id_gagnant = '';
			//si l'item est encore à la vente
			if($don['statut']==0) {
				//et que son heure est venue
				
				$birthday = $donnees['date_fin'];
				echo $birthday;
				
				$v1 = strtotime($test);
				$v2 = strtotime($birthday);

				//$val1 = date('Y-m-d\TH:i:s');
				//$val2 = $donnees['date_fin'];

				//$datetime1 = new DateTime($val1);
				//$datetime2 = new DateTime($val2);

				if($v1>$v2) {
					//on cherche le gagnant
					$req=$bdd->prepare("SELECT * FROM offre_enchere WHERE id_item=?");
					$req->execute(array($don['id_item']));
					$participants=$req->rowCount();

					//si des personnes ont enchéries on continue, sinon on met directement le statut de l'enchère à 1 (finie)
					if($participants!=0) {
						while ($d = $req->fetch()) {
							if($prix_gagnant<$d['offre']) {
								//on verifie que la personne qui enchérie à l'argent pour payer sinon on passe
								$r=$bdd->prepare("SELECT * FROM carte_banquaire WHERE id_membre=?");
								$r->execute(array($d['id_acheteur']));
								while ($monnaie = $r->fetch()) {
									if($monnaie['argent']>=$d['offre']) {
										$prix_gagnant = $d['offre'];
										$id_gagnant = $d['id_acheteur'];
									}
								}								
							}
						}
						if($participants>1) {
							$req=$bdd->prepare("SELECT * FROM offre_enchere WHERE id_item=?");
							$req->execute(array($don['id_item']));
							while ($d = $req->fetch()) {
								if($prix_a_payer<$d['offre']&&$d['offre']<$prix_gagnant) {
								//on verifie que la personne qui enchérie à l'argent pour payer sinon on passe
									$r=$bdd->prepare("SELECT * FROM carte_banquaire WHERE id_membre=?");
									$r->execute(array($d['id_acheteur']));
									while ($monnaie = $r->fetch()) {
										if($monnaie['argent']>=$d['offre']) {
											$prix_a_payer = $d['offre'];
										}
									}								
								}
							}
							$prix_a_payer = $prix_a_payer + 1;
						}
						else {
							$prix_a_payer = $prix_a_payer + 1;
						}
					}
					$r=$bdd->prepare("SELECT * FROM carte_banquaire WHERE id_membre=?");
					$r->execute(array($id_gagnant));
					$monnaie = $r->fetch();
					$argent_du_gagnant_apres = $monnaie['argent'] - $prix_a_payer;


					//on met l'argent de l'acheteur à jour
					$insertmoney=$bdd->prepare("UPDATE carte_banquaire SET argent = ? WHERE id_membre = ?");
					$insertmoney->execute(array($argent_du_gagnant_apres, $id_gagnant));
					//on met le statut de l'enchère à 1: terminée
					$insertstatut=$bdd->prepare("UPDATE items SET statut = ? WHERE id_item = ?");
					$insertstatut->execute(array(1, $don['id_item']));
					//on met l'appartenance à jour
					$insertstatut=$bdd->prepare("UPDATE items SET id_acheteur = ? WHERE id_item = ?");
					$insertstatut->execute(array($id_gagnant, $don['id_item']));
				}
				else {
					echo "pas encore";
				}
			}
		}
	}

}

?>