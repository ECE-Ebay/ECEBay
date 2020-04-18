<?php

session_start();

$id_membres=$_SESSION['id_membres'];

$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

if(isset($_POST['formcarte']))
{
    //déclare les variables
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);

    //permet de verifier que l'utilisateur a bien complété tous les champs requis
    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_FILES['fichier1']) AND !empty($_FILES['fichier2']) AND $_FILES['fichier1']['error'] == 0 AND $_FILES['fichier2']['error'] == 0)
    {

        $file_name1 = $_FILES['fichier1']['name'];
        $file_extension1 = strrchr($file_name1, ".");
        $file_tmp_name1 = $_FILES['fichier1']['tmp_name'];
        $file_dest1 = 'photos/'.$file_name1;

        $file_name2 = $_FILES['fichier2']['name'];
        $file_extension2 = strrchr($file_name2, ".");
        $file_tmp_name2 = $_FILES['fichier2']['tmp_name'];
        $file_dest2 = 'photos/'.$file_name2;

        $extensions_autorisees = array('.png', '.PNG', '.jpeg', '.jpg', '.gif', '.JPEG', '.JPG', '.GIF');



        if(in_array($file_extension1, $extensions_autorisees) AND in_array($file_extension2, $extensions_autorisees)) {



            if(move_uploaded_file($file_tmp_name1, $file_dest1) AND move_uploaded_file($file_tmp_name2, $file_dest2)) {

                $insertvendeur = $bdd->prepare('INSERT INTO `vendeur` VALUES(?,?,?,?,?,?,?)');
                $insertvendeur->execute(array($id_membres, $nom, $prenom, $file_name1, $file_dest1, $file_name2, $file_dest2));
                header("Location: connexion.php");

            } else {
                $erreur = "Une erreur est survenue lors de l'envoi du fichier";
            }
        } else {
            $erreur = 'Seuls les fichiers PNG, JPEG, JPG et GIF sont autorisés';
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
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- lien pour afficher les petites icones des carte accéptées et les petits icones dans adresse de livraison-->
</head>
<body>

    <form method="post" enctype="multipart/form-data">

        <h2>Informations vendeur :</h2>

        <table>
          <tr>
            <td align="right">
              <label> <i class="fa fa-user"> Nom :</label> <!-- la classe fa fa permet d'afficher les petits icones devant et après le text -->
                  <input type="fname" placeholder="Nom" name="nom"/>
              </td>
          </tr>

          <tr>
              <td align="right">
                <label> <i class="fa fa-user"> Prénom :</label>
                    <input type="fname" placeholder="prénom" name="prenom"/>
                </td>
            </tr>
            <tr>
                <td><label for="fichier">Photo de fond :</label></td>
                <td><input type="file" name="fichier1"></td>
            </tr>
            <tr>
                <td><label for="fichier">Photo de profil :</label></td>
                <td><input type="file" name="fichier2"></td>
            </tr>
           
        </table>
 <input type="submit" name="formcarte"/>
    </form>


    <?php
    if(isset($erreur))
    {
        echo '<font color="red">' .$erreur."</font>";
    }
    ?>


</body>
</html>