<?php

//continue la session
session_start();

require 'verif_enchere.php';

//accès à la bdd
$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

//verification de id_membres
if (isset($_GET['id_membres']) AND $_GET['id_membres']>0)
    //verifie que la variable id_membres existe et supperieure a 0
{
    $getid = intval($_GET['id_membres']); //permet de securisé la variable id_membres
    $requser=$bdd->prepare('SELECT * FROM vendeur WHERE id_utilisateur = ?'); //prépare la requète
    $requser->execute(array($getid)); //execute la requète
    $userinfo=$requser->fetch(); //va chercher les infos dans la table vendeur

    $req=$bdd->prepare('SELECT * FROM membres WHERE id_utilisateur = ?'); //prépare la requète
    $req->execute(array($getid)); //execute la requète
    $info=$req->fetch(); //va chercher les infos dans la table membres
    ?>

    <!DOCTYPE html>
    <html> 
    <head>  
    	<title>Main</title>  
    	<meta charset="utf-8">  
    	<meta name="viewport" content="width=device-width, initial-scale=1">   
    	<!-- stylesheet bootstrap -->
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">  
    	<!-- stylesheet pour les petites formes comme le triangle des dropdowns -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    	<link rel="icon" href="Logo ECEBay.png" type="image/gif">
    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>  
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
    	<!-- lien avec la page css -->
    	<link rel="stylesheet" type="text/css" href="style.css">  
    	<script type="text/javascript">   
    		$(document).ready(function(){     
    			$('.header').height($(window).height());    
    		}); 
    	</script> 
    </head> 
    <!-- on récupère l'image de fond enregistré par le vendeur -->
    <body style="background-image: url('<?php echo $userinfo['imgfond_url']; ?>'); color: white;"> 
    	<!-- la barre de navigation mais uniquement avec le logo du site --> 
    	<nav class="navbar navbar-expand-md">    
    		<img src="Logo ECEBay.png" alt="AllFruits Logo" style="width:100px;height:100px;">		
    	</nav> 
    	<br>
    	<!-- pour séparer la page en deux parties -->
    	<div class="row" style="background-color: black;">
    		<div class="col-sm-9">
    			<h1 style="margin-left: 25px;">Votre compte vendeur</h1>
    		</div>
    		<!-- emmène vers la page de modification des données du vendeur ou deconnexion -->
    		<div class="col-sm-3">
    			<a href="page_principale.html"> Deconnexion </a><br><a href="editionprofil.php"><h10>Modifier mot de passe?</h10></a><br><a href="editionphotos.php"><h10>Modifier photos de profil et/ou de fond?</h10></a>
    		</div>
    	</div>

    	<div class="container-fluid">
    		<div class="row">
    			<!-- bande blanche avec la photo de profil du vendeur -->
    			<div class="col-sm-12" style="height:150px; background-color:white;"><div class="col-sm-2"><img src="<?php echo $userinfo['imgprofil_url'] ?>"  style="width:100%; height: 120px; width: auto; margin: 15px;" alt="Image"></div></div>
    		</div><br>
    		<!-- pour séparer la page en deux parties -->
    		<div class="row">
    			<div class="col-sm-9">
    				<div class="col-sm-5" style="background-color: black;">
    					<h4 style="margin-left: 25px;">Nom:&nbsp <?php echo $userinfo['nom']; ?> <br>
    						Prénom:&nbsp <?php echo $userinfo['prenom']; ?> <br>
    						Mail:&nbsp <?php echo $info['mail']; ?> <br><br><br><br>
    						Items en ligne:<br><br>
    					</h4>
    				</div>
    			</div>
    			<!-- emmène vers ajout_item pour rajouter une voiture ou des pièces détachées -->
    			<div class="col-sm-3" style="background-color: black;"><a href="ajout_item.php?id_membres=<?php echo $_SESSION['id_membres'] ?>"><h3>&nbsp&nbsp&nbsp&nbspPoster un item</h3></a></div></div>
    			<?php
    			//affiche uniquement les items qui appartiennent au vendeur et qui n'ont pas encore été vendus
    			$reponse = $bdd->query('SELECT * FROM items');
    			while ($donnees = $reponse->fetch())
    			{
    				$req = $bdd->query('SELECT * FROM photos');
    				if ($donnees['id_vendeur']==$getid&&$donnees['statut']==0) {
    					$tableau = [];
    					$num = 0;
    					while ($don = $req->fetch())
    					{
    						if ($donnees['id_item']==$don['id_item'])  
    						{  
    							$tableau[$num] = $don['file_url'];
    							$num = $num + 1;

    						}
    					}
    					?>
    					<div class="col-sm-4" style="float: left; margin-left: 25px; text-align: center; background-color: black;">

    						<div id="myCarousel" class="carousel slide" data-ride="carousel" >

    							<!-- The slideshow -->
    							<div class="carousel-inner">
    								<div class="carousel-item active">
    									<?php 
    									echo('<img style="height: 200px; width: auto;" src="' . $tableau[0] . '" />');

    									?>
    								</div>

    								<?php if(count($tableau)>=2) { ?>
    									<div class="carousel-item">
    										<?php 
    										echo('<img style="height: 200px; width: auto;" src="' . $tableau[1] . '" />');

    										?>
    										</div><?php } ?> <?php if(count($tableau)>=3) { ?>
    											<div class="carousel-item">
    												<?php 
    												echo('<img style="height: 200px; width: auto;" src="' . $tableau[2] . '" />');

    												?>
    												</div><?php } ?>
    											</div>


    											<!-- Carousel controls -->
    											<?php if(count($tableau)>1) { ?>
    												<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
    													<span class="carousel-control-prev-icon"></span>
    												</a>
    												<a class="carousel-control-next" href="#myCarousel" data-slide="next">
    													<span class="carousel-control-next-icon"></span>
    												</a>
    												<?php } ?></div>
    												<p style="color: white;">Marque: <?php echo $donnees['marque']; ?><br>Modèle: <?php echo $donnees['modele']; ?><br>Prix: <?php echo $donnees['prix_initial']; ?></p> 
    												<a href="suppression_item.php?id_item=<?php echo $donnees['id_item']; ?>"><button type="button" style="background-color: red;">Supprimer</button></a><br><br>
    											</div>
    											<?php
    										}
    									}
    									?>

    								</div>

    								
    							</body> 
    							</html>
    							<!-- ferme la première boucle if -->
    							<?php
    						}
    						else
    						{

    						}
    						?>