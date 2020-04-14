

<?php
//recuperer les données venant de la page HTML
$pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";
$mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";
//identifier votre BDD
$database = "projet_web";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
//si le bouton est cliqué
if ($_POST["button"]) {
	if ($db_found) {
		$sql = "SELECT * FROM administrateurs";
		if ($titre != "") {
//on cherche l'administrateur avec les paramètres pseudo et mdp
			$sql .= " WHERE pseudo LIKE '%$pseudo%'";
			if ($auteur != "") {
				$sql .= " AND MDP LIKE '%$mdp%'";
			}
		}
		$result = mysqli_query($db_handle, $sql);
//tester s'il y a de résultat
		if (mysqli_num_rows($result) == 0) {
//l'administrateur recherché n'existe pas
			echo "The pseudo or password is wrong";
		} else {
//on va vers la page admin
			while ($data = mysqli_fetch_assoc($result)) {
				echo "pseudo: " . $data['pseudo'] . "<br>";
				echo "<br>";
			
		}
	}
} else {
	echo "Database not found";
}
}
//fermer la connexion
mysqli_close($db_handle);
?>
