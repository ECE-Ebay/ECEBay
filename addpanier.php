<?php
require 'db.class.php';
require 'panier.class.php';
require 'verif_enchere.php';
$DB = new DB();
$panier = new panier($DB);
$json = array ('error'=>true);

if(isset($_GET['id'])){
	$identifiant = $_GET['id'];
	$product = $DB->query('SELECT id_item FROM items WHERE id_item="'.$identifiant.'"'); 		//On va chercher le produit avec cet id   
	//$products = $DB->query('SELECT * from items where id_item in(' . implode(', ', array_map(array($DB, 'quote'), $ids)) . ')');
	//SELECT * FROM items WHERE id_item = $_GET['id'];
	if(empty($product)){
		$json['message'] = "Ce produit n'existe pas ou n'est plus disponible";
	}
	$json['error'] = false;			//Pas d'erreur
	$panier->add($identifiant);		//Appel de la fonction d'ajout dand le panier avec en paramètre l'id de l'item
}
else{$json['message'] = "Vous n'avez pas selectionne de produit";} 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Ajout au panier</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">   
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
	<link rel="icon" href="Logo ECEBay.png" type="image/gif"> <!-- pour l'icon -->   
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>  
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
	<link rel="stylesheet" type="text/css" href="style.css"> 
</head>


<body style="text-align: center; background-color: #000000; color: #c1c1c1">
	
	<div style="margin-top: 12%">
		<?php 
		$total = 0;
		if($json['error'] == false) {
			$identifiant = $_GET['id'];
			$products = $DB->query('SELECT * FROM items WHERE id_item="'.$identifiant.'"'); 
			foreach ($products as $product) {
				$total = $product->categorie;
			}  
			?>
			<h2>Le produit est maintenant dans votre panier</h2><br>
		<?php } ?>
		<button class="btn btn-outline-secondary btn-lg" style="padding:25px;" onclick="window.location.href = 'http://localhost/projet1/page_categories.php?categorie=<?php echo $total; ?>';">Retour aux achats</button></div>
	</body>
	</html> 