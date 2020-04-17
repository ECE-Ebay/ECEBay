<?php
session_start(); ?>
<!DOCTYPE html>
<html> 
<head>  
	<title>Main</title>  
	<meta charset="utf-8">  
	<meta name="viewport" content="width=device-width, initial-scale=1">   
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">   
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
				<li class="nav-item" style="margin-right: 30px;"><a class="nav-link" href="profil.php?id=<?php echo $_SESSION['id']; ?>">Votre compte</a></li> 
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
			$req = $bdd->query('SELECT * FROM photos');
			
			while ($donnees = $reponse->fetch())
			{
				if (isset($_GET['categorie'])&&isset($_GET['type_vente']))  
				{  
					$categorie = $_GET['categorie'];
					$type_vente = $_GET['type_vente'];
				}  
				else  
				{  
					echo "ce membre n'existe pas.";  
				}  
				
				if ($donnees['categorie']==$categorie&&$donnees['type_vente']==$type_vente) {
					?>


					<div class="col-sm-12" style="height:250px; border-color:red; ">
						<div class="col-sm-4" style="float: left; text-align: center;">
							<div id="myCarousel" class="carousel slide" data-ride="carousel" >

								<!-- The slideshow -->
								<div class="carousel-inner">
									<div class="carousel-item active">
										<?php while ($don = $req->fetch())
										{
											if ($donnees['id_item']==$don['id_item'])  
											{  
												echo('<img style="height: 200px; width: auto;" src="' . $don['src'] . '" />');
												$car = $car + 1;
											} }?>
										</div>
										
									</div>

									<!-- Carousel controls -->
									<?php if($car>1) { ?>
									<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
										<span class="carousel-control-prev-icon"></span>
									</a>
									<a class="carousel-control-next" href="#myCarousel" data-slide="next">
										<span class="carousel-control-next-icon"></span>
									</a>
								<?php } ?>
								</div>
							</div>
							<p style="color: white;"><br>Marque: <?php echo $donnees['marque']; ?><br><br>Modèle: <?php echo $donnees['modele']; ?><br><br>Qualitées: <?php echo $donnees['description']; ?><br><br>Prix: <?php echo $donnees['prix_initial']; ?></p>
						</div>



						<?php
					}}
					$reponse->closeCursor();
					?>

				</div>
			</div>
		</body> 
		</html>
