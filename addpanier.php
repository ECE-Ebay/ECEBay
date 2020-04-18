<?php
require 'db.class.php';
require 'panier.class.php';
$DB = new DB();
$panier = new panier($DB);

if(isset($-GET['id'])){
	$product = $DB->query('SELECT id_item FROM items WHERE id_item=:id', array('id'=>$_GET['id']));
//SELECT * FROM items WHERE id_item = $_GET['id'];
	if(empty($product)){
		die("Ce produit n'existe pas ou n'est plus disponible");
	}

	$panier->add($product[0]->id);		//Appel de la fonction d'ajout dand le panier avec en paramètre l'id de l'item
}
else{die("Vous n'avez pas selectionne de produit");}




?>
