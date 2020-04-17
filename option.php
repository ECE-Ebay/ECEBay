<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Options</title>
</head>
<body>
	<a href="carte.php?id=<?php echo $_SESSION['id'] ?>"><input type="submit" name='acheteur' value="Acheteur"/></a>
	<input type="submit" name='vendeur' value="Vendeur"/>
</body>
</html>

