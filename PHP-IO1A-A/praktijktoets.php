<style type="text/css">
table,td {
	border-collapse: collapse;
	border: 1px solid black;
}
</style>

<?php
include('functions.php');
connect_database();
echo "<form action=? method=post>";
	productLinesDropDown();
	echo "<input type=submit name=Submit>";
echo "</form>";

toonOrderDetails();
?>