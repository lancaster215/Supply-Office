<?php
session_start();
include_once("db_include.php");

if(isset($_POST['transfer'])) {
	$i_no = $_POST["i_no"];
	$item_name  = $_POST["i_name"];
	$qty = $_POST["i_qty"];
	$des = $_POST["i_des"];
	$date_a = $_POST["i_date"];
	$prop_num = $_POST["i_prop"];
	$unit_m = $_POST["i_measure"];
	$unit_v = $_POST["i_value"];
	$qty_pc = $_POST["i_sr"];
	$qty_phc = $_POST["i_rs"];
	$remarks = $_POST["i_person"];
	$office = $_POST["i_office"];
	$form = $_POST["i_form"];
	$cat = $_POST["i_cat"];
	$total_d = $_POST['i_total'];
	/*$oid = $_POST['offid'];
	$xid = $_POST['xid'];*/
	$tot_amt = ($qty * $unit_v);
	$total_qty = ($qty_phc - $qty);
	$sup_total1 = ($qty * $unit_v);
	$sup_total = ($total_d - $sup_total1);
	/*if ($total_d == 0) {
		$total = (0 + $tot_amt);
	}else{
		$total = ($total_d + $tot_amt);
	}*/

	$des = trim($_POST['i_des']);
	$des = nl2br($des);

	$query = mysqli_query($conn,"INSERT INTO items
		(article, des, date_acquire, prop_num, unit_measure, unit_value, total_amt, qty_prop_card, qty_phys_count, remarks, office_id, cat_id, form_id)
		VALUES ('".$item_name."','".$des."','".$date_a."','".$prop_num."','".$unit_m."','".$unit_v."','".$tot_amt."','".$qty."','".$qty."','".$remarks."','".$office."','".$cat."','".$form."')")
		or die ("ERROR: " .mysqli_error($conn));

	$query2 = mysqli_query($conn, "UPDATE stocks SET qty_phys_count='$total_qty', total_amt='$sup_total' WHERE item_no='$i_no'")or die ("ERROR: " .mysqli_error($conn));

	$query3 = "SELECT SUM(total_amt) AS totals FROM items, forms, office WHERE items.office_id=office.off_id AND office.form_id=forms.form_id AND items.form_id='$form' AND items.office_id='$office'";
	$result1 = mysqli_query($conn, $query3);
	if ($check = mysqli_num_rows($result1)) {
		while ($row1 = mysqli_fetch_array($result1)) {
			$totalss = $row1['totals'];
			$query1=mysqli_query($conn, "UPDATE office SET off_total='$totalss' WHERE off_id='$office' AND form_id='$form'") or die ("ERROR: " .mysqli_error($conn));
		}
	}

	$sum = "SELECT SUM(off_total) AS super_total FROM office WHERE form_id='$form'";
	$result = mysqli_query($conn, $sum);
	if ($chk = mysqli_num_rows($result)) {
		while($row = mysqli_fetch_array($result)){
			$super_total = $row['super_total'];
			$query1 = mysqli_query($conn, "UPDATE forms SET form_total='$super_total' WHERE forms.form_id='$form'") or die ("ERROR: " .mysqli_error($conn));
		}
	}
	if($query){
		echo'<script>
		alert("Successfully Added!");
		window.location.href="../table/stocks.php";
		</script>';
	}
	else{
	header("location: ../table/stocks.php");
	}
}
?>