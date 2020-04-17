<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

if(isset($_POST['forminscription']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);

    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND!empty($_POST['mail2'])  AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
    {


        if ($mail==$mail2)
        {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL))
            {
                if($mdp==$mdp2)
                {
                    $insertmbr= $bdd->prepare("INSERT INTO membres(pseudo, mail, motdepasse)VALUES(?, ?, ?)");
                    $insertmbr->execute(array($pseudo, $mail, $mdp));


                    $reponse = $bdd->query('SELECT * FROM membres');

                    while ($donnees = $reponse->fetch())
                    {
                        if ($donnees['pseudo']==$pseudo&&$donnees['mail']==$mail&&$donnees['motdepasse']==$mdp) 
                        {
                            $_SESSION['id']=$donnees['id'];
                            header("Location: option.php?id=".$_SESSION['id']);
                        }
                    }
                }
                else
                {
                    $erreur="Vos mots de passe ne correspondent pas";
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
    <title>login page</title>
    <meta charset="utf-8">
</head>
<body>

    <div align="center">
        <h2>Inscription : </h2>

        <br /><br />
        <form method="POST" action="">
            <table>
                <tr>
                    <td align="right">
                        <label> Pseudo :</label>
                        <input type="text" placeholder="Votre pseudo" name="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo; }?>"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label> Email :</label>
                        <input type="email" placeholder="Votre mail" name="mail" value="<?php if(isset($mail)) {echo $mail; }?>"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label> Confirmer votre Email :</label>
                        <input type="email" placeholder="Confirmez votre mail" name="mail2" value="<?php if(isset($mail2)) {echo $mail2; }?>"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label> Mot de passe :</label>
                        <input type="password" placeholder="votre mdp" name="mdp"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label> Confirmer le mot de passe :</label>
                        <input type="password" placeholder="Confirmez votre mdp" name="mdp2"/>
                    </td>
                </tr>

            </table>
            <br>

            <tr>
                <td></td>
                <td>    
                    <input type="submit" name='forminscription' value="Suite"/>
                </td>
            </tr>
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