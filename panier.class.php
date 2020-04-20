<?php
class panier{
	
	private $DB;

	public function __construct($DB){
		if(!isset($_SESSION)){
			session_start();		//On démarre la session si ce n'est pas déjà fait
		}
		if(!isset($_SESSION['panier'])){
			$_SESSION['panier']=array();	//On initialise le panier comme un array null
		}
		$this->DB = $DB;

	}	
	public function add($product_id){		//Ajout d'un élément dans le panier
		if(!isset($_SESSION)){
			session_start();		//On démarre la session si ce n'est pas déjà fait
		}
		if(!isset($_SESSION['panier'])){
			$_SESSION['panier']=array();	//On initialise le panier comme un array null
		}
		$posProduct = array_search($product_id, $_SESSION['panier']);
		if($posProduct == false){		//Si pas déjà ajouté
			array_push($SESSION['panier'], $product_id); 
		}
	}

	public function del($product_id){
		unset($_SESSION['panier'][$product_id]);
	}

	public function total(){
		$total=0;
		$ids = array_keys($_SESSION['panier']);		//Combien d'items il y a dans le panier
		if (empty($ids)){
			$products = array();
		}
		else{
			$products = $this->DB->query('SELECT * FROM items WHERE id IN ('.implode(',',$ids).')');	//On récupère les éléments du panier
		}
		foreach ($products as $product) {
			$total += $product->prix_initial;
		} 
		return $total;
	}
}
?>