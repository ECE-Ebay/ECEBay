<?php
session_start();


$bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8','root','');

if (isset($_SESSION['id_membres']))
{
    //requète qui premet de récupérer les infos dans la bdd
    $requser=$bdd->prepare("SELECT * FROM membres WHERE id_membres = ?");   //requète pour actualisé le mail dans la bdd
    $requser->execute(array($_SESSION['id_membres']));
    $user=$requser->fetch();    //permet d'aller récupérer les infos dans la bdd

    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])   //verifie que les champs sont bien remplis par l'utilisateur
    {
        //permet de sauvegarder le nouveau pseudo dans la bdd
        $newpseudo=htmlspecialchars($_POST['newpseudo']);
        $insertpseudo=$bdd->prepare("UPDATE membres SET pseudo = ? WHERE id_membres = ?");  //requète pour actualisé le pseudo dans la bdd
        $insertpseudo->execute(array($newpseudo, $_SESSION['id_membres'])); //execute la requète
        header('Location: profil.php?id_membres='.$_SESSION['id_membres']); //redirige l'utilisateur vers son profil 
    }

    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
    {
        //permet de sauvegarder le nouveau mail dans la bdd
        $newmail=htmlspecialchars($_POST['newmail']);
        $insertmail=$bdd->prepare("UPDATE membres SET mail = ? WHERE id_membres = ?");  //requète pour actualisé le mdp dans la bdd
        $insertmail->execute(array($newmail, $_SESSION['id_membres']));
        header('Location: profil.php?id_membres='.$_SESSION['id_membres']);
    }

    if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
    {
        $mdp1=sha1($_POST['newmdp1']); //premet d'encripter les mdp
        $mdp2=sha1($_POST['newmdp2']);

        if($mdp1==$mdp2)
        {
            //permet de sauvegarder le nouveau mot de passe dans la bdd
            $insertmdp=$bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id_membres =? ");
            $insertmdp->execute(array($mdp1, $_SESSION['id_membres']));
            header('Location: profil.php?id_membres='.$_SESSION['id_membres']); //redirige vers le profil de l'utilisateur

        }
        else
        {
            $msg="vos deux mots de passe ne correspondent pas";
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
            <h2 style="color: #c1c1c1">Edition de mon profil: </h2>
            <br>
            <form method="POST" action="">
                <table>
                    <tr>
                        <td align="right">
                            <label style="color: #c1c1c1"> Pseudo :</label>
                            <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /> <br> <br>
                        </td>
                    </tr>
                    <tr>
                            <td align="right">
                            <label style="color: #c1c1c1"> Email :</label>
                            <input type="email" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>"/> <br> <br>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label style="color: #c1c1c1"> Mot de passe :</label>
                            <input type="password" name="newmdp1" placeholder="Mot de passe" /> <br> <br>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label style="color: #c1c1c1"> Confirmer votre mdp :</label>
                            <input type="password" name="newmdp2" placeholder="Confirmation du mdp" /> <br> <br>
                            <input style="background-color: #6f6f6f; color: #ffffff" type="submit" value="Mettre à jour mon profil"/>
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
<?php
}
else
{
    header("Location : connexion.php");
}
?>