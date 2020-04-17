<?php
session_start();


$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

if (isset($_GET['id']) AND $_GET['id']>0)
{
    $getid = intval($_GET['id']);
    $requser=$bdd->prepare('SELECT * FROM membres WHERE id_utilisateur = ?');
    $requser->execute(array($getid));
    $userinfo=$requser->fetch();

    ?>

    <!DOCTYPE html>
    <html> 
    <head>  
        <title>Login Page</title>  
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
                    <li class="nav-item" style="margin-right: 30px;"><a class="nav-link" href="#">Votre compte</a></li> 
                    <li class="nav-item"><a class="nav-link" href="#">Panier</a></li> 
                </ul>   
            </div>  
        </nav> 



        <div align="center" style="margin-top: 150px;">
            <h2 style="color: white;">Profil de <?php echo $userinfo['pseudo']; ?>: </h2>

            <br /><br /><p style="color: white;">
            Pseudo = <?php echo $userinfo['pseudo']; ?>
            <br />
            Mail = <?php echo $userinfo['mail']; ?></p>
            <br />
            <?php
            if(isset($_SESSION['id']) AND $userinfo['id_utilisateur']==$_SESSION['id'])
            {
                ?>
                <a href="editionprofil.php"> Editer mon profil </a><br>
                <a href="page_principale.html"> Deconnexion </a>

                <?php
            }
            ?>

        </div>
    </body>
    </html>
    <?php
}
else
{

}
?>


