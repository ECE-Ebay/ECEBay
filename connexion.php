<?php
session_start();       //permet d'utiliser les variables de session


$bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8','root','');

if(isset($_POST['formconnexion']))
{
    //déclaration des variables
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);   //sha1 permet d'encripter le mdp

    if(!empty($mailconnect) and !empty($mdpconnect))    //si les champs mailconnect et mdpconnect sont bien remplis alors ...
    {
        $requser = $bdd ->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");   //prepare la requete pour verifier si l'utilisateur existe
        $requser->execute(array($mailconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist==1)       //permet de verifier que le mail et mdp que l'utilisateur entre correspond bien a ceux de la bdd
        {
            $userinfo=$requser->fetch();
            $_SESSION['id_membres']=$userinfo['id_membres'];
            $_SESSION['pseudo']=$userinfo['pseudo'];
            $_SESSION['mail']=$userinfo['mail'];
            header("Location: profil.php?id_membres=".$_SESSION['id_membres']);     //permet de rediriger vers le profil de la personne

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
    </head>
    <body>

        <div align="center">
            <h2>Connexion : </h2>

            <br /><br />
            <form method="POST" action="">
                <input type="email" name="mailconnect" placeholder="Mail" />
                <input type="password" name="mdpconnect" placeholder="Mot de passe" />
                <input type="submit" name='formconnexion' value="je me connecte"/>
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
</html>