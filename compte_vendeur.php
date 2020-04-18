<?php
session_start();


$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

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
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">  
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>  
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
    	<link rel="stylesheet" type="text/css" href="style.css">  
    	<script type="text/javascript">   
    		$(document).ready(function(){     
    			$('.header').height($(window).height());    
    		}); 
    	</script> 
    </head> 
    <body style="background-image: url('<?php echo $userinfo['imgfond_url']; ?>'); color: white;">  
    	<nav class="navbar navbar-expand-md">    
    		<img src="Logo ECEBay.png" alt="AllFruits Logo" style="width:100px;height:100px;">		
    	</nav> 
    	<br>
    	<div class="row">
    		<div class="col-sm-11">
    			<h1 style="margin-left: 25px;">Votre compte vendeur</h1>
    		</div>
    		<div class="col-sm-1"><br><a href="#"><h10>Modifier?</h10></a></div>
    	</div>

    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-sm-12" style="height:150px; background-color:white;"><div class="col-sm-2"><img src="<?php echo $userinfo['imgprofil_url'] ?>"  style="width:100%; height: 120px; width: auto; margin: 15px;" alt="Image"></div></div>
    		</div><br>
    		<div class="row">
    			<div class="col-sm-9">
    				<h4 style="margin-left: 25px;">Nom:&nbsp <?php echo $userinfo['nom']; ?> <br>
    					Prénom:&nbsp <?php echo $userinfo['prenom']; ?> <br>
    					Nom:&nbsp <?php echo $info['mail']; ?> <br><br><br><br>
    					Items en ligne:<br><br>
    				</h4>
    			</div>
    			<div class="col-sm-3"><a href="#"><h3>&nbsp&nbsp&nbsp&nbspPoster un item</h3></a></div></div>
    			<?php
    			$reponse = $bdd->query('SELECT * FROM items');
    			while ($donnees = $reponse->fetch())
    			{
    				if ($donnees['id_vendeur']==$getid&&$donnees['statut']==0) {

    					?>
    					<div class="col-sm-4" style="float: left; margin-left: 25px;">

    						<img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
    						<p style="color: white;">Marque: <?php echo $donnees['marque']; ?><br>Modèle: <?php echo $donnees['modele']; ?><br>Prix: <?php echo $donnees['prix_initial']; ?></p> 
    					</div>
    					<?php
    				}
    			}
    			?>

    		</div><br><br><br><br><br><br><br><br><br><br><br><br><br>

    		<a href="page_principale.html" style="margin-left: 25px;"> Deconnexion </a><br><br>

    	</body> 
    	</html>

    	<?php
    }
    else
    {

    }
    ?>