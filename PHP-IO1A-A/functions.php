<?php

function connect_database()
{
    mysql_connect("localhost", "root", "usbw");
    return mysql_select_db("classicmodels") or die(mysql_error());
}

function get_data($query)
{
    if (! connect_database() )
        return false;
        
    $result = mysql_query($query) or die(mysql_error());
    mysql_close();
    return $result;
}

function get_data_array($query)
{
    if (! $result = get_data($query) )
        return false;

    $array = array();
    while($row = mysql_fetch_assoc($result))
        $array[] = $row;

    return $array;
}

function query_html($query)
{
    $array = array();
    if ( ! $array = get_data_array($query) )
        return false;
    
    if (! count($array) )
        return false;

    $table = "<table class='tabel'>";
    $row = $array[0];    
    // header
    $table .= "<thead><tr>";
    $head = array_keys($row);
    foreach($head as $key)
    {
        $table .= "<th class='$key'>$key</th>";
    }
    $table .= "</tr></thead>";
    // body
    $table .= "<tbody>";
    foreach($array as $key => $row)
    {
        $table .= "<tr>";
        foreach($row as $value)
        {
            $table .= "<td class='$key'>$value</td>";
        }
        $table .= "</tr>";
    }
    $table .= "</tbody></table>";
    return $table;
}

function table_html($tablename)
{
    return query_html("SELECT * FROM $tablename");
}

function productLinesDropDown()
{
	if(isset($_POST['product'])){
		$previousselected = $_POST['product'];
	}
	$result = mysql_query("SELECT `productCode`,`productName` FROM `products`");
	echo "<select name=product>";
	while ($data = mysql_fetch_assoc($result)){
		if ($data['productCode'] == $previousselected){
			echo '<option value="' . $data['productCode'] . '" selected>' . $data['productName'] . '</option>';
		} else {
			echo '<option value="' . $data['productCode'] . '">' . $data['productName'] . '</option>';			
		}
	}
	echo "</select>";
}

function toonOrderDetails()
{
	if(isset($_POST['Submit'])){
	$hoogste = 0;
	$laagste = 9999999;
	$totaal = 0;
	$teller = 0;
	echo "<table>";
	$product = $_POST['product'];
	$result2 = mysql_query("SELECT * FROM `orderdetails` WHERE `productCode` =  '$product' ");
	echo "<tr><td><b>Order Number</td><td><b>Product Code</td><td><b>Quantity Ordered</td><td><b>Price Each</td><td><b>Order Line Number</td></tr>";
	while($data = mysql_fetch_assoc($result2)){
		if ($data['productCode'] == $_POST['product']){
			echo "<tr>";
			echo "<td>". $data['orderNumber'] . "</td>";
			echo "<td>". $data['productCode'] . "</td>";
			echo "<td "; if($data['quantityOrdered'] <= 20){ echo "style=color:red;";} echo">". $data['quantityOrdered'] . "</td>";
			echo "<td>". $data['priceEach'] . "</td>";
			echo "<td>". $data['orderLineNumber'] . "</td>";
			echo "</tr>";
		}
		$orderedh = $data['quantityOrdered'];
		if($orderedh > $hoogste) {
			$hoogste = $orderedh;
		}
		$orderedl = $data['quantityOrdered'];
		if($orderedl < $laagste) {
			$laagste = $orderedl;
		}
		$totaal += $data['quantityOrdered'];
		$teller += 1;
	}
	$gem = ($totaal / $teller);
	echo "</table> <br>";
	echo "Het hoogste is: " . $hoogste . "<br>";
	echo "Het laagste is: " . $laagste . "<br>";
	echo "Het totaal is: " . $totaal . "<br>";
	echo "Het gemiddelde is: " . $gem . "<br>";
	}
}

?>