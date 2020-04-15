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
				<li><a class="nav-link" style="color: white;" href="page_principale.html">Accueil</a></li>
				<div class="dropdown">
					<button class="dropbtn">Catégories</button>
					<div class="dropdown-content">
						<a href="page_categories.php">Ferraille ou Trésor</a>
						<a href="page_categories.php">Bon pour le Musée</a>
						<a href="page_categories.php">Accessoire VIP</a>
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">Achat</button>
					<div class="dropdown-content">
						<a href="page_type_vente.php">Enchères</a>
						<a href="page_type_vente.php">Achetez-le maintenant</a>
						<a href="page_type_vente.php">Meilleure offre</a>
					</div>
				</div>   
				<li class="nav-item"><a class="nav-link" href="#">Vendre</a></li> 
				<li class="nav-item"><a class="nav-link" href="#">Votre compte</a></li> 
				<li class="nav-item"><a class="nav-link" href="#">Panier</a></li> 
				<li class="nav-item"><a class="nav-link" href="#">Admin</a></li> 
			</ul>    
		</div>  
	</nav> 

	<div class="row" style="margin: 40px;">
		<div class="col-sm-4">
			<h3><a href="page_filtree.php">Voitures d'occasion</a></h3>
			<?php
			for($i = 0; $i < 10; $i++) {
			?>
			<img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
			<p style="color: white;">Nom<br>Prix</p><?php
			}
			?>
		</div>
		<div class="col-sm-4"> 
			<h3><a href="page_filtree.php">Voitures de luxe</a></h3>
			<?php
			for($i = 0; $i < 10; $i++) {
			?>
			<img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
			<p style="color: white;">Nom<br>Prix</p> <?php
			}
			?>   
		</div>
		<div class="col-sm-4"> 
			<h3><a href="page_filtree.php">Pièces détachées</a></h3>
			<?php
			for($i = 0; $i < 10; $i++) {
			?>
			<img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
			<p style="color: white;">Nom<br>Prix</p>  <?php
			}
			?>  
		</div>
	</div>

</body> 
</html>