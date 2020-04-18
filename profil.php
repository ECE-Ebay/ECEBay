<?php
session_start();


$bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8','root','');

if (isset($_GET['id_membres']) AND $_GET['id_membres']>0)
    //verifie que la variable id_membres existe et supperieure a 0
{
    $getid = intval($_GET['id_membres']); //permet de securisé la variable id_membres
    $requser=$bdd->prepare('SELECT * FROM membres WHERE id_membres = ?'); //prépare la requète
    $requser->execute(array($getid));   //execute la requète
    $userinfo=$requser->fetch();    //va chercher les infos dans la table membres

?>

<html>
    <head>
        <title>login page</title>
        <meta charset="utf-8">
    </head>
    <body>

        <div align="center">
            <h2>Profil de <?php echo $userinfo['pseudo']; ?>: </h2>
            <!-- ce qu'il y a entre le <?php et ?> permet de récupérer le pseudo enrigistré dans la bdd -->

            <br /><br />
            Pseudo = <?php echo $userinfo['pseudo']; ?>
            <br />
            Mail = <?php echo $userinfo['mail']; ?>
            <br />
            <?php
            if(isset($_SESSION['id_membres']) AND $userinfo['id_membres']==$_SESSION['id_membres'])
            {
            ?>
            <!-- isset permet de visiter le profil en question que si l'id est connectée.-->
            <br>
            <a href="editionprofil.php"> Editer mon profil </a>
            <!-- redirige vers la page d'édition -->
            <br>
            <br>
            <!-- redirige vers la page de déconnexion -->
            <a href="deconnexion.php"> Deconnexion </a>

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