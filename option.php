<?php
session_start();

require 'verif_enchere.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Options</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
        <link rel="icon" href="Logo ECEBay.png" type="image/gif"> <!-- pour l'icon -->   
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>  
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
        <link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<nav class="navbar navbar-expand-md">    
            <img src="Logo ECEBay.png" alt="AllFruits Logo" style="width:100px;height:100px;">
                <button class="navbar-toggler navbar-dark" type="button" datatoggle="collapse" data-target="#main-navigation">     
                    <span class="navbar-toggler-icon"></span>    
                </button>    
            <div class="collapse navbar-collapse" id="main-navigation">     
                <ul class="navbar-nav">      

                </ul>    
            </div>  
        </nav> 
<body style="text-align: center; background-color: #000000; color: #c1c1c1">
	<div style="margin-top: 12%">
		<h2>Etes vous un vendeur ou un acheteur?</h2><br>
		<button class="btn btn-outline-secondary btn-lg" style="padding:25px;" onclick="window.location.href = 'carte.php?id_membres=<?php echo $_SESSION['id_membres'] ?>';">Vendeur</button>&nbsp&nbsp&nbsp&nbsp
		  <button class="btn btn-outline-secondary btn-lg" style="padding:25px;" onclick="window.location.href = 'carte.php?id_membres=<?php echo $_SESSION['id_membres'] ?>';">Acheteur</button></div>
		  <?php require 'footer.php' ?>
</body>
</html>

