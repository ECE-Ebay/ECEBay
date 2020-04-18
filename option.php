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
	<input type="submit" name='vendeur' value="Vendeur"/>
</body>
</html>

