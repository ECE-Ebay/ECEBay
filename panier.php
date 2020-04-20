<?php
require 'db.class.php';
require 'panier.class.php';
require 'verif_enchere.php';
$DB = new DB();
$panier = new panier($DB);
?>

<!DOCTYPE html> 	
<html> 
<head>  
	<title>Main</title>  
	<meta charset="utf-8">  
	<meta name="viewport" content="width=device-width, initial-scale=1">   
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">   
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>  
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">  
	<script type="text/javascript">   
	//$(document).ready(function(){ $('.header').height($(window).height());});
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
				<li class="nav-item"><a class="nav-link" href="panier.php">Panier</a></li> 
			</ul>   
		</div>  
	</nav> 
	<h1 style="color: #ffffff; padding: 30px;">Panier</h1>
	<h3 style="color: #ffffff; padding: 30px;">Achat immédiat</h3> 

	<div class="container features"> 
		<?php
	$ids = $_SESSION['panier'];		//Combien d'items il y a dans le panier

	$products = $DB->query('SELECT * FROM items WHERE id_item IN ('.implode(',',$ids).')');	//On récupère les éléments du panier
	foreach ($products as $product):
		?>   
		<div class="row">     
			<div class="col-lg-4 col-md-4 col-sm-12">      
				<img src="column1.jpg" class="img-fluid">     
				<span><?= $product->marque; ?>€</span> 
				<span><?= number_format($product->prix_initial,2,','," "); ?>€</span>
			</div>     
		</div> 

		 

	<?php endforeach; ?>

</body>

<?php require 'footer.php'?>