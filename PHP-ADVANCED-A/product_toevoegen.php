<?php
	require_once('functions.php');
	$db = connect_db();
?>
<html>
	<head>
		<title>Product</title>
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	<body>
		<ul>
			<li><a href="../PHP-ADVANCED-A/">Producten</a></li>
			<li><a href=product_toevoegen.php>Product toevoegen</a></li>
			<li><a href=categorie_toevoegen.php>Categorie toevoegen</a></li>
		</ul>
		<h1>Product toevoegen</h1>
		<?php
			producttoevoegen();
		?>
		<form action='?' method='post'>
			Naam: <input type=text name='naam' required><br>
			Prijs: <input type=number name='prijs' min=0 required><br>
			<?php categoriedropdown(); ?>
			<input type=submit name=submit value='Voeg toe'>
		</form>	
		
		<?php
			//producttabel();
		?>
	</body>
</html>