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
					<a href="page_choix.html"><button class="dropbtn">Catégories</button></a>
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
<div class="row" style="margin-left: 200px; margin-top: 150px;">
	<div class="col-sm-3">
		<a href="page_categories.php?categorie=1"><img src="Accueil.jpg" width="304" height="236" style="border-radius: 50%; padding-right: 30px; padding-left: 30px;">
		<p style="color: white; text-align: center; margin-left: 50px;">Voiture de luxe</p></a>
	</div>
	<div class="col-sm-3">
		<a href="page_categories.php?categorie=2"><img src="https://i.ytimg.com/vi/uGoH8LCXIN8/maxresdefault.jpg" width="304" height="236" style="border-radius: 50%;padding-right: 30px; padding-left: 30px;">
		<p style="color: white;text-align: center; margin-left: 50px;">Voiture d'occasion</p></a>
	</div>
	<div class="col-sm-3">
		<a href="page_categories.php?categorie=3"><img src="https://image.freepik.com/vecteurs-libre/roue-de-voiture-realiste_1284-4977.jpg" width="304" height="236" style="border-radius: 50%;padding-right: 30px; padding-left: 30px;">
		<p style="color: white;text-align: center; margin-left: 50px;">Pièces détachées</p></a>
	</div>
</div>
</body> 
</html> 