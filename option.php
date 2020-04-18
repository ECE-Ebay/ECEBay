<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Options</title>
</head>
<body>
	<a href="carte.php?id_membres=<?php echo $_SESSION['id_membres'] ?>"><input type="submit" name='acheteur' value="Acheteur"/></a>
	<a href="inscription_vendeur.php?id_membres=<?php echo $_SESSION['id_membres'] ?>"><input type="submit" name='vendeur' value="Vendeur"/></a>
</body>
</html>

