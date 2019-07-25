<?php
//include 'db_include.php';

$q = intval($_GET["q"]);

$conn = mysqli_connect("localhost","root","supply_office");
mysqli_select_db($conn, "supply_office");
$sql = "SELECT * FROM stocks WHERE item_no = '".$q."'";
$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_array($result)) {
		echo"".$row['article']."";
		echo "".$row['qty_phys_count']."";
	}
mysqli_close($conn);
?>