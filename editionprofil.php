<?php
session_start();

require 'verif_enchere.php';

$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

if (isset($_SESSION['id_membres']))
{
    //requète qui premet de récupérer les infos dans la bdd
    $requser=$bdd->prepare("SELECT * FROM membres WHERE id_utilisateur = ?"); //requète pour actualisé le mail dans la bdd
    $requser->execute(array($_SESSION['id_membres']));
    $user=$requser->fetch();    //permet d'aller récupérer les infos dans la bdd

    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) //verifie que les champs sont bien remplis par l'utilisateur
    {
        //permet de sauvegarder le nouveau pseudo dans la bdd
        $newpseudo=htmlspecialchars($_POST['newpseudo']);
        $insertpseudo=$bdd->prepare("UPDATE membres SET pseudo = ? WHERE id_utilisateur = ?"); //requète pour actualisé le mdp dans la bdd
        $insertpseudo->execute(array($newpseudo, $_SESSION['id_membres']));
        header('Location: compte_vendeur.php?id_membres='.$_SESSION['id_membres']);
    }

    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
    {
        $newmail=htmlspecialchars($_POST['newmail']);
        $insertmail=$bdd->prepare("UPDATE membres SET mail = ? WHERE id_utilisateur = ?");
        $insertmail->execute(array($newmail, $_SESSION['id_membres']));
        header('Location: compte_vendeur.php?id_membres='.$_SESSION['id_membres']);
    }

    if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
    {
        $mdp1=sha1($_POST['newmdp1']); //premet d'encripter les mdp
        $mdp2=sha1($_POST['newmdp2']);

        if($mdp1==$mdp2)
        {
            //permet de sauvegarder le nouveau mot de passe dans la bdd
            $insertmdp=$bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id_utilisateur =? ");
            $insertmdp->execute(array($mdp1, $_SESSION['id_membres']));
            header('Location: compte_vendeur.php?id_membres='.$_SESSION['id_membres']); //redirige vers le profil de l'utilisateur

        }
        else
        {
            $msg="vos deux mots de passe ne correspondent pas";
        }
    }

    ?>

    <html>
    <head>
        <title>login page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">  
        <link rel="icon" href="Logo ECEBay.png" type="image/gif"> <!-- pour l'icon -->  
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>  
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
        <link rel="stylesheet" type="text/css" href="style.css"> 
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

        <body style="background-color: #111111; color: #c1c1c1;">

            <div align="center">
                <h2>Edition de mon profil: </h2>
                <form method="POST" action="">
                    <table>
                        <tr>
                            <td align="right">
                                <label> Pseudo :</label>
                                <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /> <br> <br>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label> Email :</label>
                                <input type="email" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>"/> <br> <br>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label> Mot de passe :</label>
                                <input type="password" name="newmdp1" placeholder="Mot de passe" /> <br> <br>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label> Confirmer votre mdp :</label>
                                <input type="password" name="newmdp2" placeholder="Confirmation du mdp" /> <br> <br>
                                <input style="background-color: #6f6f6f; color: #ffffff" type="submit" value="Mettre à jour mon profil"/>
                                <?php 

                                //requète qui premet de récupérer les infos dans la bdd
                                $req=$bdd->prepare("SELECT * FROM vendeur WHERE id_utilisateur = ?"); 
                                $req->execute(array($_SESSION['id_membres']));
                                $vendeurexist=$req->rowCount();
                                //si c'est un vendeur on renvoie vers compte_vendeur sinon vers profil
                                if($vendeurexist==0) {

                                ?>
                                <a href="profil.php?id_membres=<?php echo $_SESSION['id_membres']; ?>"><input style="background-color: #6f6f6f; color: #ffffff" type="button" value="Retour"/></a>
                                <?php 

                                } else {

                                ?>

                                <a href="compte_vendeur.php?id_membres=<?php echo $_SESSION['id_membres']; ?>"><input style="background-color: #6f6f6f; color: #ffffff" type="button" value="Retour"/></a>

                                <?php 

                                } 

                                ?>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php if(isset($msg))
                {
                    echo $msg;
                }
                ?>

            </div>
        </body>

        <?php require 'footer.php' ?>

    </body>
    </html>
    <?php
}
else
{
    header("Location : connexion.php");
}
?>