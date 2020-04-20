<?php

session_start();

require 'verif_enchere.php';

$id_membres=$_SESSION['id_membres'];

$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

if(isset($_POST['formeditph']))
{

    //verifie si un champ a ete remplis
    if(!empty($_FILES['fichier1']) AND $_FILES['fichier1']['error'] == 0)
    {

        $file_name1 = $_FILES['fichier1']['name'];
        $file_extension1 = strrchr($file_name1, ".");
        $file_tmp_name1 = $_FILES['fichier1']['tmp_name'];
        $file_dest1 = 'photos/'.$file_name1;

        $extensions_autorisees = array('.png', '.PNG', '.jpeg', '.jpg', '.gif', '.JPEG', '.JPG', '.GIF');



        if(in_array($file_extension1, $extensions_autorisees)) {



            if(move_uploaded_file($file_tmp_name1, $file_dest1)) {

                $insertmdp=$bdd->prepare("UPDATE vendeur SET imgfond_nom = ? WHERE id_utilisateur =? ");
                $insertmdp->execute(array($file_name1, $_SESSION['id_membres']));
                $insertmdp=$bdd->prepare("UPDATE vendeur SET imgfond_url = ? WHERE id_utilisateur =? ");
                $insertmdp->execute(array($file_dest1, $_SESSION['id_membres']));
                $erreur = "Modification effectuée";
            } else {
                $erreur = "Une erreur est survenue lors de l'envoi du fichier";
            }
        } else {
            $erreur = 'Seuls les fichiers PNG, JPEG, JPG et GIF sont autorisés';
        }
    }

    //verifie si un champ a ete remplis
    if(!empty($_FILES['fichier2']) AND $_FILES['fichier2']['error'] == 0)
    {

        $file_name2 = $_FILES['fichier2']['name'];
        $file_extension2 = strrchr($file_name2, ".");
        $file_tmp_name2 = $_FILES['fichier2']['tmp_name'];
        $file_dest2 = 'photos/'.$file_name2;

        $extensions_autorisees = array('.png', '.PNG', '.jpeg', '.jpg', '.gif', '.JPEG', '.JPG', '.GIF');



        if(in_array($file_extension2, $extensions_autorisees)) {



            if(move_uploaded_file($file_tmp_name2, $file_dest2)) {

                $insertmdp=$bdd->prepare("UPDATE vendeur SET imgprofil_nom = ? WHERE id_utilisateur =? ");
                $insertmdp->execute(array($file_name2, $_SESSION['id_membres']));
                $insertmdp=$bdd->prepare("UPDATE vendeur SET imgprofil_url = ? WHERE id_utilisateur =? ");
                $insertmdp->execute(array($file_dest2, $_SESSION['id_membres']));
                $erreur = "Modification effectuée";

            } else {
                $erreur = "Une erreur est survenue lors de l'envoi du fichier";
            }
        } else {
            $erreur = 'Seuls les fichiers PNG, JPEG, JPG et GIF sont autorisés';
        }
    }
}

?>



<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- lien pour afficher les petites icones des carte accéptées et les petits icones dans adresse de livraison--> 
    <link rel="icon" href="Logo ECEBay.png" type="image/gif">
    <!-- pour l'icon -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
    <link rel="stylesheet" type="text/css" href="style.css"> 
</head>
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
<body style="background-color: #000000; color: white; text-align: center;">

    <form method="post" enctype="multipart/form-data">

        <h2 style="margin-top: 5%;">Informations vendeur :</h2>
        <div  style="margin-left: 35%; margin-top: 5%;">
            <table style="border-collapse: separate; border: 1px solid #000; border-spacing: 15px;">

                <tr>
                    <td><label for="fichier">Photo de fond :</label></td>
                    <td><input type="file" name="fichier1"></td>
                </tr>
                <tr>
                    <td><label for="fichier">Photo de profil :</label></td>
                    <td><input type="file" name="fichier2"></td>
                </tr>
                <tr><td></td>
                    <td>
                        <input style="background-color: #6f6f6f; color: #ffffff" type="submit" value="Mettre à jour mon profil" name="formeditph"/>
                        <a href="compte_vendeur.php?id_membres=<?php echo $_SESSION['id_membres']; ?>"><input style="background-color: #6f6f6f; color: #ffffff" type="button" value="Retour"/></a></td></tr>
                </table>
            </div>
        </form>


        <?php
        if(isset($erreur))
        {
            echo '<font color="red">' .$erreur."</font>";
        }
        require 'footer.php';
        ?>


    </body>
    </html>