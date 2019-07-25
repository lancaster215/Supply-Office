<?php
session_start();
include_once("db_include.php");

if (isset($_POST['edit'])) {
	$name = mysqli_real_escape_string($conn, $_POST['item_name']);
	$date = mysqli_real_escape_string($conn, $_POST['date_acq']);
	$num = mysqli_real_escape_string($conn, $_POST['prop_num']);
	$measure = mysqli_real_escape_string($conn, $_POST['unit_measure']);
	$value = mysqli_real_escape_string($conn, $_POST['unit_value']);
	$card = mysqli_real_escape_string($conn, $_POST['prop_card']);
	$phys = mysqli_real_escape_string($conn, $_POST['qty_phys_count']);
	$des = mysqli_real_escape_string($conn, $_POST['description']);
	$remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
	$item_no = mysqli_real_escape_string($conn, $_POST['item_no']);
	$oid = mysqli_real_escape_string($conn, $_POST['offid']);
	$fid = mysqli_real_escape_string($conn, $_POST['xid']);

	$super_total = ($value * $card);				//total_amt

	$sql = "UPDATE items SET article='$name', des='$des', date_acquire='$date', prop_num='$num', unit_measure='$measure', unit_value='$value', total_amt='$super_total', qty_prop_card='$card', qty_phys_count='$phys', remarks='$remarks' WHERE item_no='$item_no'";
	$result = mysqli_query($conn, $sql);

	$query = "SELECT SUM(total_amt) AS total FROM items WHERE office_id='$oid'";
	$res = mysqli_query($conn, $query);
	if ($chk = mysqli_num_rows($res)) {
		while ($row = mysqli_fetch_array($res)) {
			$total = $row['total'];
			$query1 = mysqli_query($conn, "UPDATE office SET off_total='$total' WHERE off_id='$oid'") or die ("ERROR: " .mysqli_error($conn));
		}
	}

	$sum = "SELECT SUM(off_total) AS o_total FROM office WHERE form_id='$fid'";
	$result = mysqli_query($conn, $sum);
	if ($check = mysqli_num_rows($result)) {
		while($roww = mysqli_fetch_array($result)){
			$o_total = $roww['o_total'];
			$query2 = mysqli_query($conn, "UPDATE forms SET form_total='$o_total' WHERE form_id='$fid'") or die ("ERROR: " .mysqli_error($conn));
		}
	}

	echo'<script>
			alert("Successfully Edited Document");
			window.location.href="../table/table_1.php?oid='.$oid.'&nid='.$fid.'";
		</script>';
}
?>