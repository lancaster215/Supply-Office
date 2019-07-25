<?php
session_start();
include_once("db_include.php");

	if(isset($_POST['add_item']))
	{
		$qty_phc = '';
		$item_name  = $_POST["item_name"];
		$des = $_POST["description"];
		$date_a = $_POST["date_acq"];
		$prop_num = $_POST["prop_num"];
		$unit_m = $_POST["unit_measure"];
		$unit_v = $_POST["unit_value"];
		$qty_pc = $_POST["prop_card"];
		$qty_phc = $qty_pc;
		$cat = $_POST["cat"];
		//$total = $_POST["total"];
	}

	$total_d = ($unit_v * $qty_pc);
	$des = trim($_POST['description']);
	$des = nl2br($des);

	$query = mysqli_query($conn,"INSERT INTO stocks (article, des, date_acquire, prop_num, unit_measure, unit_value, total_amt, qty_prop_card, qty_phys_count, cat_id)
		VALUES ('".$item_name."','".$des."','".$date_a."','".$prop_num."','".$unit_m."','".$unit_v."','".$total_d."','".$qty_pc."','".$qty_phc."','".$cat."')")
		or die ("ERROR: " .mysqli_error($conn));

	if($query){
		echo'<script>
		alert("Successfully Added!");
		window.location.href="../table/stocks.php";
		</script>';
	}	 

	else{
	header("location: ../table/stocks.php");
	}

?>