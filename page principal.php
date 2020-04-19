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
	<script type="text/javascript" src="js/app.js"></script>
	<script type="text/javascript">   
	$(document).ready(function(){ $('.header').height($(window).height()); $('.scroll-fade').height($(window).height());   });
	</script> 
	<script type="text/javascript">
            
            $(function fade() {
                
                var documentEl = $(document),
                    fadeElem = $('.scroll-fade');
                
                
                documentEl.on('scroll', function fade() {
                    var currScrollPos = documentEl.scrollTop();
                    
                    fadeElem.each(function fade() {
                        var $this = $(this),
                            elemOffsetTop = $this.offset().top;
                        if (currScrollPos > elemOffsetTop) $this.css('opacity', 1 - (currScrollPos-elemOffsetTop)/1200);
                    }); 
                });
                
            });
        
        </script>
        <style> body {   padding: 0px;   margin: 0px;   background: #000; } </style>
</head> 
<body>  
	<nav class="navbar navbar-expand-md">    
		<img src="Logo ECEBay.png" alt="ECEBay Logo" style="width:100px;height:100px;">
		<button class="navbar-toggler navbar-dark" type="button" datatoggle="collapse" data-target="#main-navigation">     
			<span class="navbar-toggler-icon"></span>    
		</button>
	</nav> 
 
 <header class="page-header scroll-fade container-fluid"  style="background-image: url('Accueil.jpg');">   
 	<div class="overlay"></div>   
 	<div class="description">    
 	<h1>Bienvenue sur la page de ECEBay Paris!</h1>     
 	<p>     La référence de l'enchère en ligne à Paris. <br>	La plus grande collection de voitures de luxes en France     </p>     
 	<button class="btn btn-outline-secondary btn-lg"; onclick="window.location.href = 'connexion.php';">Let's go!</button>   
 	</div>  
</header> 
 
 <div class="container features">    
 	<div class="row">     
 		<div class="col-lg-4 col-md-4 col-sm-12">      
 			<h3 class="feature-title">Voitures d'occasion</h3>      
 			<img src="column1.jpg" class="img-fluid">      
 			<p>       Nos toutes nouvelles offres sur les voitures d'occasions avec un large choix[...]</p> 
 		</div>     
 		<div class="col-lg-4 col-md-4 col-sm-12">      
 			<h3 class="feature-title">Voitures de luxe</h3>      
 			<img src="column2.jpg" class="img-fluid">      
 			<p>      Un catalogue mis à jour quotidiennement, des dixaines de références et des vendeurs triés sur le volet, voici notre rubrique voiture de luxe[...]     </p>     
 		</div>     
 		<div class="col-lg-4 col-md-4 col-sm-12">      
 			<h3 class="feature-title">Entrer en contact!</h3>     
 			<div class="form-group">       
 				<input type="text" class="form-control" placeholder="Votre nom:" name="">     </div>     
 				<div class="form-group">       <input type="email" class="form-control" placeholder="Courriel:" name="email">     </div>     
 				<div class="form-group">       <textarea class="form-control" rows="4">Vos commentaires</textarea>     </div>     
 				<input type="submit" class="btn btn-secondary btn-block" value="Envoyer" name="">     </div>   
 			</div>  
 		</div> 
 
<?php require 'footer.php'; ?>