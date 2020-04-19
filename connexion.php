<?php
session_start(); //permet d'utiliser les variables de session


$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

if(isset($_POST['formconnexion']))
{
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']); //sha1 permet d'encripter le mdp

    if(!empty($mailconnect) and !empty($mdpconnect)) //si les champs mailconnect et mdpconnect sont bien remplis alors ...
    {
        $requser = $bdd ->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?"); //prepare la requete pour verifier si l'utilisateur existe
        $requser->execute(array($mailconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist==1) //permet de verifier que le mail et mdp que l'utilisateur entre correspond bien a ceux de la bdd
        {
            $userinfo=$requser->fetch();
            $_SESSION['id_membres']=$userinfo['id_utilisateur'];
            $_SESSION['pseudo']=$userinfo['pseudo'];
            $_SESSION['mail']=$userinfo['mail'];


            $getid = intval($userinfo['id_utilisateur']); //permet de securisé la variable id_membres
            $req=$bdd->prepare('SELECT * FROM carte_banquaire WHERE id_membre = ?'); //prépare la requète
            $req->execute(array($getid)); //execute la requète
            $exist = $req->rowCount();
            if($exist==1) {
                header("Location: profil.php?id_membres=".$_SESSION['id_membres']); //permet de rediriger vers le profil de la personne
            } else {
                $req=$bdd->prepare('SELECT * FROM vendeur WHERE id_utilisateur = ?'); //prépare la requète
            $req->execute(array($getid)); //execute la requète
            $exist = $req->rowCount();
            if($exist==1) {
                header("Location: compte_vendeur.php?id_membres=".$_SESSION['id_membres']); //permet de rediriger vers le profil de la personne
            }
        }


    }
    else
    {
        $erreur="mauvais mail ou mot de passe";
    }

}
else
{
    $erreur = "Veuillez compléter tous les champs";
}
}


?>

<html>
<head>
    <title>login page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
    <link rel="stylesheet" type="text/css" href="style.css">  
    <script type="text/javascript">   
        $(document).ready(function(){     
            $('.header').height($(window).height());    });  
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

                </ul>    
            </div>  
        </nav> 

        <body style="background-color: #111111; color: #c1c1c1">

            <div align="center">
                <h2>Connexion : </h2>

                <br /><br />
                <form method="POST" action="">
                    <input type="email" name="mailconnect" placeholder="Mail" />
                    <input type="password" name="mdpconnect" placeholder="Mot de passe" />
                    <input style="background-color: #6f6f6f; color: #ffffff" classe="btn btn-secondary btn-block" type="submit" name='formconnexion' value="je me connecte"/>
                    <br>
                    <br>
                    <p>Pas encore de compte ?<a href=inscription1.php>  M'inscrire</a> </p>
                </form>
                <?php
                if(isset($erreur))
                {
                    echo '<font color="red">' .$erreur."</font>";
                }
                ?>

            </div>

        </body>

        <footer class="page-footer">    
            <div class="container">     
                <div class="row">      
                    <div class="col-lg-8 col-md-8 col-sm-12">       
                        <h6 class="text-uppercase font-weight-bold">Information additionnelle</h6>       
                        <p>        Nous sommes un collectif d'étudiants ayant pour but de redonner envie au gens de cultiver       </p>       
                        <p>        Notre objectif est de transmettre ces connaissances et de permettre aux personnes animées par cette passion de se rencontrer       </p>      
                    </div>     

                    <div class="col-lg-4 col-md-4 col-sm-12">       
                        <h6 class="text-uppercase font-weightbold">Contact</h6>       
                        <p> 40, avenue des Ternes, 75017 Paris, France <br>        
                            info@ECEbay.ece.fr <br>        
                            +33 01 03 05 07 09 <br>        
                            +33 06 05 04 03 02
                        </p>      
                    </div>    
                </div>    

                <div class="footer-copyright text-center">&copy; 2020 Copyright | Droit d'auteur: ECEBay@ece.fr</div>  
            </div>
        </footer> 
    </body>
    </html>