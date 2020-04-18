<?php

session_start();

$id_membres=$_SESSION['id_membres'];

$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

if(isset($_POST['formcarte']))
{
    //déclare les variables
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mail = htmlspecialchars($_POST['email']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $ville = htmlspecialchars($_POST['ville']);
    $numtel = htmlspecialchars($_POST['numtel']);
    $zip = htmlspecialchars($_POST['zip']);
    $numerocarte = htmlspecialchars($_POST['numerocarte']);
    $nomcarte = htmlspecialchars($_POST['nomcarte']);
    $moicarte = htmlspecialchars($_POST['moicarte']);
    $cvv = htmlspecialchars($_POST['cvv']);
    $anneecarte = htmlspecialchars($_POST['anneecarte']);

    //permet de verifier que l'utilisateur a bien complété tous les champs requis
    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['adresse'])  AND !empty($_POST['ville']) AND !empty($_POST['numtel']) AND !empty($_POST['zip']) AND !empty($_POST['numerocarte']) AND !empty($_POST['nomcarte']) AND !empty($_POST['moicarte']) AND !empty($_POST['anneecarte']) AND !empty($_POST['cvv']))
    {


      //prepare la requète pour mettre les infos entrées par l'utilisateur dans la bdd
      $insertmbr= $bdd->prepare("INSERT INTO carte_banquaire(id_membre, nom, prenom, email, adresse, ville, numtel, zip, numerocarte, nomcarte, moicarte, anneecarte, cvv)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      //execute la requète précédente
      $insertmbr->execute(array($id_membres, $nom, $prenom, $mail, $adresse, $ville, $numtel, $zip, $numerocarte, $nomcarte, $moicarte, $anneecarte, $cvv));
      header("Location: connexion.php");
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

<h1>PAIEMENT</h1>


      <form method="post">
      
        <h3>Adresse de livraison :</h3>

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
              <td align="right">
                <label> <i class="fa fa-envelope"> Email :</label>
                <input type="email" placeholder="nom@gmail.com" name="email"/>
              </td>
            </tr>


            <tr>
              <td align="right">
                <label> <i class="fa fa-address-card-o"> Adresse :</label>
                <input type="text" placeholder="adresse de livraison" name="adresse"/>
              </td>
            </tr>

            <tr>
              <td align="right">
                <label> <i class="fa fa-institution"> Ville :</label>
                <input type="text" placeholder="ex: Paris" name="ville"/>
              </td>
            </tr>
          
            <tr>
              <td align="right">
                <label>N°Telphone :</label>
                <input type="text" placeholder="ex: 0102030405" pattern="[0-9]{10}" name="numtel"/>
              </td>
            </tr>

            <tr>
              <td align="right">
                <label>Zip :</label>
                <input type="text" placeholder="zip" pattern="[0-9]{5}" name="zip"/>
              </td>
            </tr>
          </table>



            <h3>Paiement :</h3>
            <label for="fname">Cartes acceptées :</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>



            <table>
              <tr>
                <td align="right">
                  <label>Numéro de la carte :</label>
                  <input type="text" pattern="[0-9]{13,16}" name="numerocarte" placeholder="ex: 1111-2222-3333-4444"> <!-- pattern permet de faire en sorte qu'il y ai une erreur qui s'affiche si l'utilisateur ne rentre pas entre 13 et 16 chiffres compris entre 0 et 9 -->
                  
                </td>
              </tr>

              <tr>
                <td align="right">
                  <label>Titulaire de la carte :</label>
                  <input type="text" placeholder="ex: Fieux Louis" name="nomcarte"/>
                </td>
              </tr>

              <tr>
                <td align="right">
                  <label>Moi d'expiration :</label>
                  <input type="text" placeholder="ex: 07" pattern="[0-12]{2}" name="moicarte"/>
                </td>
              </tr>

              <tr>
                <td align="right">
                  <label>Année d'expiration :</label>
                  <input type="text" placeholder="ex: 2021" pattern="[0-9]{4}" name="anneecarte"/>
                </td>
              </tr>
            
              <tr>
                <td align="right">
                  <label>CVC/CVV/CID :</label>
                 <input type="text" required="" pattern="[0-9]{3,4}" name="cvv" placeholder="ex: 123">
                </td>
              </tr>
            </table>
       <br>
        <tr>
        <td></td>
        <td>    
          <input type="submit" name='formcarte' value="Continuer"/>
        </td>
        </tr>

      </form>


      <?php
      if(isset($erreur))
      {
        echo '<font color="red">' .$erreur."</font>";
      }
      ?>


</body>
</html>