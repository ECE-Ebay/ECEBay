<?php
//continue la session
session_start(); 

//récupère la variable de session
$id_membres=$_SESSION['id_membres'];

//accès à la bdd
$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

//quand le bouton submit de form est cliqués
if(isset($_POST['formajoutitem']))
{
	//récupération des variables récoltées dans le formulaire
	$marque = $_POST['marque'];
	$modele = $_POST['modele'];
	$prix = $_POST['prix'];
	$description = $_POST['description'];

	//infos des dropdowns
	if(isset($_POST['categories'])) {
		$categorie = $_POST['categories'];
	}
	if(isset($_POST['type_vente'])) {
		$type_vente = $_POST['type_vente'];
	}

	//verifie que les infos récoltées sont pas vides
	if(!empty($_FILES['fichier1']) AND isset($_POST['categories']) AND isset($_POST['type_vente']) AND !empty($_POST['marque']) AND !empty($_POST['modele']) AND !empty($_POST['description']) AND !empty($_POST['prix'])) 
	{
		$statut = 0;
		$acheteur = 0;

		//insertion dans la base de donnée des infos de l'item
		$insertitem= $bdd->prepare("INSERT INTO items(id_vendeur, marque, modele, prix_initial, description, categorie, type_vente, id_acheteur, statut)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$insertitem->execute(array($id_membres, $marque, $modele, $prix, $description, $categorie, $type_vente, $acheteur, $statut));

				//on récupère l'id de item pour remplir photos
		$reponse = $bdd->query('SELECT * FROM items');
		$id_item = 0;
		while ($donnees = $reponse->fetch()) {
			if($donnees['id_item']>$id_item) {
				$id_item = $donnees['id_item'];
			}
		}

		//pour toutes les files mises dans le formulaire
		foreach ($_FILES as $file) {

			//on vérifie que ces files sont pleines, si elles sont vides, on continue, cad on les ignore et on passe à la suite
			if ($file['error']==UPLOAD_ERR_NO_FILE) {

				continue;

			}

			$file_name = $file['name'];
			//on récupère l'extension du fichier pour vérification
			$file_extension = strrchr($file_name, ".");
			$file_tmp_name = $file['tmp_name'];
			$file_dest = 'photos/'.$file_name;

			//on limite les types de fichiers autorisés
			$extensions_autorisees = array('.png', '.PNG', '.jpeg', '.jpg', '.gif', '.JPEG', '.JPG', '.GIF');

			//vérification que le fichier est bien dans les normes
			if(in_array($file_extension, $extensions_autorisees)) {

				//si le fichier à bien atterrit dans la file crée pour l'occasion
				if(move_uploaded_file($file_tmp_name, $file_dest)) {

					//insertion de la photo dans sa base de donnée
					$insertphoto = $bdd->prepare('INSERT INTO photos(id_item, name, file_url) VALUES(?,?,?)');
					$insertphoto->execute(array($id_item, $file_name, $file_dest));
					
					//si c'est une enchere, on renvoie vers une page qui demande la fin du compte à rebours
					if($type_vente==1) {
						header("Location: ajout_enchere.php?id_item=$id_item");
					}

				} else {
					$erreur = "Une erreur est survenue lors de l'envoi du fichier";
				}
			} else {
				$erreur = 'Seuls les fichiers PNG, JPEG, JPG et GIF sont autorisés';
			}

		}
	}




} else {
	$erreur ="VEUILLEZ COMPLETER TOUS LES CHAMPS";
}

?>

<!DOCTYPE html>
<html> 
<head>  
	<title>Main</title>  
	<meta charset="utf-8">  
	<meta name="viewport" content="width=device-width, initial-scale=1">   
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="Logo ECEBay.png" type="image/gif"> <!-- pour l'icon --> 
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>  
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
	<link rel="stylesheet" type="text/css" href="style.css">  
	<script type="text/javascript">   
		$(document).ready(function(){     
			$('.header').height($(window).height());    
		}); 
	</script> 
</head> 
<body style="background-color: #000000">  
	<nav class="navbar navbar-expand-md">    
		<img src="Logo ECEBay.png" alt="AllFruits Logo" style="width:100px;height:100px;">		
	</nav> 

	<div style="margin-top: 50px; margin-left: 150px; text-align: center;">
		<form action="" method="post" enctype="multipart/form-data">
			<table style="color: white; float: left;">
				<tr>
					<td>Une à trois photos:</td>
				</tr>
				<tr>
					<td><label for="fichier1">Photos1:</label></td>
					<td><input type="file" name="fichier1"></td>
				</tr>
				<tr>
					<td><label for="fichier2">Photos2:</label></td>
					<td><input type="file" name="fichier2"></td>
				</tr>
				<tr>
					<td><label for="fichier3">Photos3:</label></td>
					<td><input type="file" name="fichier3"></td>
				</tr>
				<tr>
					<td>Marque:</td>
					<td><input type="text" name="marque"></td>
				</tr>
				<tr>
					<td>Catégorie:</td>
					<td>
						<select name="categories">
							<option value="1" selected="selected">Voiture de luxe</option>
							<option value="2">Voiture d'occasion</option>
							<option value="3">Pièces détachées</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Modèle:</td>
					<td><input type="text" name="modele"></td>
				</tr>
				<tr>
					<td>Prix:</td>
					<td><input type="number" name="prix"></td>
				</tr>
				<tr>
					<td>Type de vente:</td>
					<td>
						<select name="type_vente">
							<option value="1" selected="selected">Enchère</option>
							<option value="2">Meilleure Offre</option>
							<option value="3">Vente Immédiate</option>
						</select>
					</td>
				</tr>
			</table>

			<p style="color: white;">
				<label for="description">Description:</label><br />
				<textarea name="description" id="description"></textarea>
			</p>
			<input type="submit" name="formajoutitem"/>

		</form><br><br><br><br><br>
		<a href="compte_vendeur.php?id_membres=<?php echo $_SESSION['id_membres'] ?>"><button class="btn btn-outline-secondary btn-lg">Retour</button> </a><br>
		<?php
		if(isset($erreur))
		{
			echo '<font color="red">' .$erreur."</font>";
		}
		?>

	</div>
</body> 
</html>
