<?php
session_start();


$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

if (isset($_SESSION['id']))
{
    $requser=$bdd->prepare("SELECT * FROM membres WHERE id_utilisateur = ?");
    $requser->execute(array($_SESSION['id']));
    $user=$requser->fetch();

    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
    {
        $newpseudo=htmlspecialchars($_POST['newpseudo']);
        $insertpseudo=$bdd->prepare("UPDATE membres SET pseudo = ? WHERE id_utilisateur = ?");
        $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }

    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
    {
        $newmail=htmlspecialchars($_POST['newmail']);
        $insertmail=$bdd->prepare("UPDATE membres SET mail = ? WHERE id_utilisateur = ?");
        $insertmail->execute(array($newmail, $_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }

    if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
    {
        $mdp1=sha1($_POST['newmdp1']);
        $mdp2=sha1($_POST['newmdp2']);

        if($mdp1==$mdp2)
        {
            $insertmdp=$bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id_utilisateur =? ");
            $insertmdp->execute(array($mdp1, $_SESSION['id']));
            header('Location: profil.php?id='.$_SESSION['id']);

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