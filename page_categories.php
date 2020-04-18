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
				<li class="nav-item" style="margin-right: 30px;"><a class="nav-link" href="profil.php?id_membres=<?php echo $_SESSION['id_membres']; ?>">Votre compte</a></li> 
				<li class="nav-item"><a class="nav-link" href="#">Panier</a></li> 
			</ul>   
		</div>  
	</nav> 


	<?php 
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8', 'root', '');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}

	$reponse = $bdd->query('SELECT * FROM items');

	
	if (isset($_GET['categorie']))  
	{  
		$categorie = $_GET['categorie'];
	}  
	else  
	{  
		echo "ce membre n'existe pas.";  
	} 
		?>
		<h1 style="color: white;margin: 50px;"><?php if($categorie==1) { ?>Voiture de luxe <?php } ?>
			<?php if($categorie==2) { ?>Voiture d'occasion <?php } ?>
			<?php if($categorie==3) { ?>Pièces détachées <?php } ?>
		</h1>
		<div class="row" style="margin: 40px;">
			<div class="col-sm-4">

				<h3><a href="page_filtree.php?categorie=<?php echo $categorie; ?>&type_vente=1">Enchères</a></h3>
				<?php
				while ($donnees = $reponse->fetch())
				{
					if ($donnees['categorie']==$categorie&&$donnees['type_vente']==1) {

						?>
						<img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
						<p style="color: white;">Marque: <?php echo $donnees['marque']; ?><br>Modèle: <?php echo $donnees['modele']; ?><br>Prix: <?php echo $donnees['prix_initial']; ?></p> <?php
					}}
					?>
				</div>
				<div class="col-sm-4"> 
					<h3><a href="page_filtree.phpcategorie=<?php echo $categorie; ?>&type_vente=2">Achetez-le maintenant</a></h3>
					<?php
					while ($donnees = $reponse->fetch())
					{
						if ($donnees['categorie']==$categorie&&$donnees['type_vente']==2) {
							?>
							<img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
							<p style="color: white;">Marque: <?php echo $donnees['marque']; ?><br>Modèle: <?php echo $donnees['modele']; ?><br>Prix: <?php echo $donnees['prix_initial']; ?></p> <?php
						}}
						?>   
					</div>
					<div class="col-sm-4"> 
						<h3><a href="page_filtree.phpcategorie=<?php echo $categorie; ?>&type_vente=3">Meilleure Offre</a></h3>
						<?php
						while ($donnees = $reponse->fetch())
						{
							if ($donnees['categorie']==$categorie&&$donnees['type_vente']==3) {
								?>
								<img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
								<p style="color: white;">Marque: <?php echo $donnees['marque']; ?><br>Modèle: <?php echo $donnees['modele']; ?><br>Prix: <?php echo $donnees['prix_initial']; ?></p>  <?php
							}}
							?>   
						</div>
						</div> 
				</body> 
				</html>