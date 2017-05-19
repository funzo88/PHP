<?php
function connect_db()
{
	$db = new mysqli('localhost','root','usbw','winkel');
	if ($db->connect_errno > 0){
        die ('Geen verbinding');
    }
	return $db;
}

function categorietoevoegen()
{
	$db = connect_db();
	if (isset($_POST['submit'])){
		$naam = $db->real_escape_string($_POST['naam']);
		$sql = "INSERT INTO Categorie (Naam) VALUES ('$naam')";
			
		if ( ! $resultaat = $db->query( $sql ) ) 
		{
			die( 'query kan niet worden uitgevoerd' );
		}
		else {
			echo "<br>Categorie is ingevoerd.<br><br>";
		}
	}
}

function categorietabel()
{
	$db = connect_db();
	echo "<table>";
	$sql_get = "SELECT * FROM Categorie";
	if (!$result = $db->query($sql_get)){
		die('De query kan niet worden uitgevoerd');
    }
	echo "<tr><td><b>ID</b></td><td><b>Naam</b></td></tr>";
	while($row = $result->fetch_assoc()){
		$categorieen[] = $row;
	}
	foreach($categorieen as $data){
		echo "<tr>";
		echo "<td>". $data['ID'] . "</td>";
		echo "<td>". $data['Naam'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
}

function producttoevoegen()
{
	$db = connect_db();
	if (isset($_POST['submit'])){
        $naam = $db->real_escape_string($_POST['naam']);
        $prijs = $db->real_escape_string($_POST['prijs']);
		$categorieid = $db->real_escape_string($_POST['categorieid']);
		$sql = "INSERT INTO Product (Productnaam, Prijs, CategorieID) VALUES ('$naam', '$prijs', '$categorieid')";
     		
		if ( ! $resultaat = $db->query( $sql ) ) 
		{
			die(mysqli_error($db));
		}
		else {
			echo "<br>Product is ingevoerd.<br><br>";
		}
	}
}

function producttabel()
{
	$db = connect_db();
	$sql_get = "SELECT Product.ID, Productnaam, Product.Prijs, Categorie.Naam FROM Product JOIN Categorie ON Product.CategorieID = Categorie.ID ORDER BY Productnaam ASC";
	if (!$resultproducten = $db->query($sql_get)){
		die('De query kan niet worden uitgevoerd');
    }
	echo "<div class=tabel><table>";
	echo "<tr class=header><td><b>ID</b></td><td><b>Naam</b></td><td><b>Prijs</b></td><td><b>Categorie</b></td></tr>";
	while($row = $resultproducten->fetch_assoc()){
		$producten[] = $row;
	}
	foreach($producten as $data){
		echo "<tr>";
		echo "<td>". $data['ID'] . "</td>";
		echo "<td>". $data['Productnaam'] . "</td>";
		echo "<td>&euro; ". $data['Prijs'] . "</td>";
		echo "<td>". $data['Naam'] . "</td>";
		echo "</tr>";
	}
	echo "</table></div>";
}

function categoriedropdown()
{
	$db = connect_db();
	$categoriequery = "SELECT * FROM Categorie";
	if (!$result = $db->query($categoriequery)){
		die ('Query kan niet');
	}
	echo "Categorie <select name=categorieid>";
	while ($row = $result->fetch_assoc()){
		$categorietjes[] = $row;
	}
	foreach($categorietjes as $data){
		echo '<option value="' . $data['ID'] . '">' . $data['Naam'] . '</option>';
	}

	echo "</select><br>";
}
?>