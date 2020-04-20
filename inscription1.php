<?php

$bdd = new PDO('mysql:host=localhost;dbname=espace_carte;charset=utf8','root',''); //accès à la bdd

if(isset($_POST['forminscription']))
{
    //déclaration des differentes variables
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);

    //verifie que tous les champs sont bien remplis par l'utilisateur
    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND!empty($_POST['mail2'])  AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
    {

            if ($mail==$mail2)  //verifie que les deux mails correspondent bien
            {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL))    //permet de verifier que l'adresse mail est bien valide
                {

                    //permet de verifier si le pseudo existe déjà dans la bdd
                    $reqpseudo=$bdd->prepare("SELECT * FROM membres WHERE pseudo=?");
                    $reqpseudo->execute(array($pseudo));
                    $pseudoexist=$reqpseudo->rowCount();

                    if ($pseudoexist==0)
                    {
                        //permet de verifier si le mail existe déjà dans la bdd
                        $reqmail=$bdd->prepare("SELECT * FROM membres WHERE mail=?");
                        $reqmail->execute(array($mail));
                        $mailexist=$reqmail->rowCount();

                         if($mailexist==0)
                        {
                            if($mdp==$mdp2) //verifie que les deux mdp correspondent bien
                            {
                                $insertmbr= $bdd->prepare("INSERT INTO membres(pseudo, mail, motdepasse)VALUES(?, ?, ?)");
                                //prepare une requète qui va envoyé les données remplies par l'utilisateur dans la bdd
                                $insertmbr->execute(array($pseudo, $mail, $mdp));   //execution de la requète précédente
                                $erreur = "Votre compte a bien été créé. <a href=\"connexion.php\">Me connecter</a>";
                            }
                            else
                            {
                                $erreur="Vos mots de passe ne correspondent pas";
                            }
                        }
                        else
                        {
                            $erreur="Adresse mail déjà utilisée";
                        }
                    }
                    else
                    {
                        $erreur="Pseudo déjà utilisé";
                    }
                }
                else
                {
                    $erreur="Vos adresses mails ne correspondent pas";
                }
        }
        else
        {
            $erreur = "Votre adresse mail n'est pas valide";
        }

    }
    else
    {
        $erreur ="VEUILLEZ COMPLETER TOUS LES CHAMPS";
    }
}

?>

<html>
    <head>  
        <title>Main</title>  
        <meta charset="utf-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">   
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>  
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
        <link rel="stylesheet" type="text/css" href="style1.css"> 

        <title>login page</title>
        <meta charset="utf-8">
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


        <body style="background-color: #111111;">
        <div align="center">
            <h2 style="color: #c1c1c1"> Inscription : </h2>

            <br /><br />
            <form method="POST" action="">
                <table>
                    <tr>
                        <td align="right">
                        <label style="color: #c1c1c1"> Pseudo :</label>
                        <input type="text" placeholder="Votre pseudo" name="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo; }?>"/>       <!-- ce qui est dans value permet de remplire automatiquement le champs en question si une erreur apparait lors de l'inscription (ex : adresse mail non valide) -->
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                        <label style="color: #c1c1c1"> Email :</label>
                        <input type="email" placeholder="Votre mail" name="mail" value="<?php if(isset($mail)) {echo $mail; }?>"/>
                        </td>
                    </tr>
                     <tr>
                        <td align="right">
                        <label style="color: #c1c1c1"> Confirmer votre Email :</label>
                        <input type="email" placeholder="Confirmez votre mail" name="mail2" value="<?php if(isset($mail2)) {echo $mail2; }?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                        <label style="color: #c1c1c1"> Mot de passe :</label>
                        <input type="password" placeholder="votre mdp" name="mdp"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                        <label style="color: #c1c1c1"> Confirmer le mot de passe :</label>
                        <input type="password" placeholder="Confirmez votre mdp" name="mdp2"/>
                        </td>
                    </tr>

                </table>
                <br>
                    <tr>
                        <td></td>
                        <td>    
                            <input style="background-color: #6f6f6f; color: #ffffff" type="submit" name='forminscription' value="je m'inscris"/>
                            <p style="color: #c1c1c1"><br>Déjà inscrit ?<a href=connexion.php>Me connecter</a> </p>
                        </td>
                    </tr>
            </form>
            <?php
            if(isset($erreur))
            {
                echo '<font color="red">' .$erreur."</font>";
            }
            ?>

        </div>

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