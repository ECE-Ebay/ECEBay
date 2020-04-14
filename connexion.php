<?php
session_start();


$bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8','root','');

if(isset($_POST['formconnexion']))
{
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);

    if(!empty($mailconnect) and !empty($mdpconnect))
    {
        $requser = $bdd ->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
        $requser->execute(array($mailconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist==1)
        {
            $userinfo=$requser->fetch();
            $_SESSION['id']=$userinfo['id'];
            $_SESSION['pseudo']=$userinfo['pseudo'];
            $_SESSION['mail']=$userinfo['mail'];
            header("Location: profil.php?id=".$_SESSION['id']);

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
            </form>
            <?php
            if(isset($erreur))
            {
                echo $erreur;
            }
            ?>

        </div>
</body>
</html>