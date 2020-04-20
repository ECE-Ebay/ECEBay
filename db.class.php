<?php
class DB{
	
	private $db;

	public function __construct(){
		try
	{
		$this->db = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8', 'root', '');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}

	}

	public function query($sql){
		$req = $this->db->prepare($sql);
		$req->execute();
		//$req->execute();
		return $req->fetchAll(PDO::FETCH_OBJ);

	}






} ?>