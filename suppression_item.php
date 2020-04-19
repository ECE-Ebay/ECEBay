<?php 
//continue la session
session_start();

//accès à la bdd
$bdd = new PDO('mysql:host=localhost;dbname=test_items;charset=utf8','root','');

   $requser=$bdd->prepare('DELETE FROM items WHERE id_item = :num LIMIT 1'); //prépare la requète
   //liaison avec la variable id_item
   $requser->bindValue(':num', $_GET['id_item'], PDO::PARAM_INT);
    $executeIsOK = $requser->execute(); //execute la requète
 
   if ($executeIsOK) { 
      echo "Item supprimée.<br />"; 
   } 
   else { 
      echo "Echec de l'exécution de la requête.<br />"; 
   }
?>