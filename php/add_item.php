<?php
session_start();
include_once("db_include.php");

if(isset($_POST['add_item'])) {
	$item_name  = $_POST["item_name"];
	$des = $_POST["description"];
	$date_a = $_POST["date_acq"];
	$prop_num = $_POST["prop_num"];
	$unit_m = $_POST["unit_measure"];
	$unit_v = $_POST["unit_value"];
	$qty_pc = $_POST["prop_card"];
	$qty_phc = $_POST["qty_phys_count"];
	$remarks = $_POST["remarks"];
	$office = $_POST["office"];
	$cat = $_POST["cat"];
	$total_d = $_POST['total'];
	$oid = $_POST['offid'];
	$xid = $_POST['xid'];

	$tot_amt = ($unit_v * $qty_pc);

	//if total is NULL walang laman table kasi walang ia-add sa tot_amt. So total_d will be set to 0 in order to have the number to add in tot_amt
	if ($total_d == 0) {
		$total = (0 + $tot_amt);
	}else{
		$total = ($total_d + $tot_amt);
	}

	$query1=mysqli_query($conn, "UPDATE office SET off_total='$total' WHERE off_id='$oid'") or die ("ERROR: " .mysqli_error($conn));

	$des = trim($_POST['description']);
	$des = nl2br($des);

	$query = mysqli_query($conn,"INSERT INTO items
		(article, des, date_acquire, prop_num, unit_measure, unit_value, total_amt, qty_prop_card, qty_phys_count, remarks, office_id, cat_id)
		VALUES ('".$item_name."','".$des."','".$date_a."','".$prop_num."','".$unit_m."','".$unit_v."','".$tot_amt."','".$qty_pc."','".$qty_phc."','".$remarks."','".$office."','".$cat."')")
		or die ("ERROR: " .mysqli_error($conn));

	$sum = "SELECT SUM(off_total) AS super_total FROM office WHERE form_id='$xid'";
	$result = mysqli_query($conn, $sum);
	if ($chk = mysqli_num_rows($result)) {
		while($row = mysqli_fetch_array($result)){
			$super_total = $row['super_total'];
			$query1 = mysqli_query($conn, "UPDATE forms SET form_total='$super_total' WHERE form_id='$xid'") or die ("ERROR: " .mysqli_error($conn));
		}
	}

	if($query){
		echo'<script>
		alert("Successfully Added!");
		window.location.href="../table/table_1.php?oid='.$oid.'&nid='.$xid.'";
		</script>';
	}	 

	else{
	header("location: ../table/table_1.php?oid='.$oid.'&nid='.$xid.'");
	}
}
?>