<?php
	require_once('functions.php');
	$db = connect_db();
?>
<html>
	<head>
		<title>Producten</title>
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	<body>
		<ul>
			<li><a href="../PHP-ADVANCED-A/">Producten</a></li>
			<li><a href=product_toevoegen.php>Product toevoegen</a></li>
			<li><a href=categorie_toevoegen.php>Categorie toevoegen</a></li>
		</ul>
		<h1>Producten</h1>
		<?php
			producttabel();
		?>
	</body>
<html>