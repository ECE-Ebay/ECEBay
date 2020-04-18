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
        <title>login page</title>
        <meta charset="utf-8">
    </head>
    <body>

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
                            <input type="submit" value="Mettre à jour mon profil"/>
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
</html>
<?php
}
else
{
    header("Location : connexion.php");
}
?>