<?php
require 'db.class.php';
require 'panier.class.php';
$DB = new DB();
$panier = new panier($DB);
$json = array ('error'=>true);

if(isset($-GET['id'])){
	$product = $DB->query('SELECT id_item FROM items WHERE id_item=:id', array('id'=>$_GET['id']));
//SELECT * FROM items WHERE id_item = $_GET['id'];
	if(empty($product)){
		$json['message'] = "Ce produit n'existe pas ou n'est plus disponible";
	}
	$json['error'] = false;			//Pas d'erreur
	$panier->add($product[0]->id);		//Appel de la fonction d'ajout dand le panier avec en paramètre l'id de l'item
}
else{$json['message'] = "Vous n'avez pas selectionne de produit";}

echo json_encode($json);