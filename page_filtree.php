<?php
session_start();

require 'verif_enchere.php'; ?>
<!DOCTYPE html>
<html> 
<head>  
	<title>Main</title>  
	<meta charset="utf-8">  
	<meta name="viewport" content="width=device-width, initial-scale=1">   
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">   
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
<body>  
	<nav class="navbar navbar-expand-md">    
		<img src="Logo ECEBay.png" alt="AllFruits Logo" style="width:100px;height:100px;">
		<button class="navbar-toggler navbar-dark" type="button" datatoggle="collapse" data-target="#main-navigation">     
			<span class="navbar-toggler-icon"></span>    
		</button>    
		<div class="collapse navbar-collapse" id="main-navigation">     
			<ul class="navbar-nav">      
				<div class="dropdown">
					<a href="page_choix.php"><button class="dropbtn">Catégories</button></a>
					<div class="dropdown-content">
						<a href="page_categories.php?categorie=1">Voiture de luxe</a>
						<a href="page_categories.php?categorie=2">Voiture d'occasion</a>
						<a href="page_categories.php?categorie=3">Pièces détachées</a>
					</div>
				</div>   
				<li class="nav-item" style="margin-right: 30px;"><a class="nav-link" href="profil.php?id_membres=<?php echo $_SESSION['id_membres']; ?>">Votre compte</a></li> 
				<li class="nav-item"><a class="nav-link" href="#">Panier</a></li> 
			</ul>    
		</div>  
	</nav> 
	<div class="container-fluid">
		<div class="row" style="margin: 40px;">
			<?php
			$car = 0;
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}

			$reponse = $bdd->query('SELECT * FROM items');
			
			
			while ($donnees = $reponse->fetch())
			{
				$req = $bdd->query('SELECT * FROM photos');
				if (isset($_GET['categorie'])&&isset($_GET['type_vente']))  
				{  
					$categorie = $_GET['categorie'];
					$type_vente = $_GET['type_vente'];
				}  
				else  
				{  
					echo "ce membre n'existe pas.";  
				}  
				
				if ($donnees['categorie']==$categorie&&$donnees['type_vente']==$type_vente&&$donnees['statut']==0) {
					$tableau = [];
					$num = 0;
					while ($don = $req->fetch())
					{
						if ($donnees['id_item']==$don['id_item'])  
						{  
							$tableau[$num] = $don['file_url'];
							$num = $num + 1;

						}
					}					?>
					<div class="col-sm-12" style="height:250px; border-color:red; ">
						<div class="col-sm-4" style="float: left; text-align: center;">

							<?php require 'carousel.php' ?>



							
					</div>
					<p style="color: white;"><br>Marque: <?php echo $donnees['marque']; ?><br><br>Modèle: <?php echo $donnees['modele']; ?><br><br>Qualitées: <?php echo $donnees['description']; ?><br><br>Prix: <?php echo $donnees['prix_initial']; ?></p>
				</div><?php
						}}
						$reponse->closeCursor();
						?>
			</div>
		</div>
		<?php require 'footer.php' ?>
	</body> 
	</html>
