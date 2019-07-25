<?php
	include '../php/db_include.php';
	include '../php/check_user.php';
?>

<!DOCTYPE html>
<html>
<?php
$disp_item = mysqli_query($conn,"SELECT * FROM stocks");
$rename_cat = mysqli_query($conn,"SELECT * FROM stocks, categories WHERE stocks.cat_id= categories.cat_id");
while ($row = mysqli_fetch_array($rename_cat)){
	$cat_name = $row['cat_name'];
	$max = $row['qty_phys_count'];
	$itno = $row['item_no'];
}
?>
<head>
	<title>Stocks | Bicol University Supply Office</title>
	<?php include '../head/imports.php';?>
</head>
<body>
	<?php
		include '../clip/clip-table/navbar-stocks.php ';
	echo '
		<div class="w3-overlay" onclick="w3_close()" style="cursor:pointer"></div>
		<div style="height:75px;background-color:#003471;color:white;margin-top:-1%;padding:1%;width:100%;">
			<span class="w3-opennav" onclick="w3_open()"><h3>☰</h3></span> <br><br>';
	echo'</div>
		<div class="w3-container"><br>
	';
		include '../clip/clip-table/search-stock.php';
		include '../clip/clip-table/table-stocks.php';
	?>
</body>
</html>