<?php
session_start();
header('Location: inscription1.php?id_membres='.$_SESSION['id_membres']);
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>login page</title>
	<meta charset="utf-8">
</head>
<body>
	<div align="center">
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<h1>vous êtes bien déconnecté</h1>
	</div>

</body>
</html>