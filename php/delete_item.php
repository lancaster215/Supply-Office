<?php
session_start();
include_once 'db_include.php';

if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];
	$oid = $_GET['fid']; //office_id
	$fid = $_GET['nid']; //form_id

	$insert = mysqli_query($conn, "INSERT INTO deleted(des, article, prop_num, total_amt, cat_id, off_id) SELECT des, article, prop_num, total_amt, cat_id, office_id FROM items WHERE item_no='$delete' AND office_id='$oid'");

	$query = "SELECT * FROM office, items WHERE items.office_id=office.off_id AND items.item_no='$delete'";
	$sum = mysqli_query($conn, $query);
	if ($chk = mysqli_num_rows($sum)) {
		while($row = mysqli_fetch_array($sum)){
			$item_total = $row['total_amt'];
			$office_total = $row['off_total'];
			$total = ($office_total - $item_total);
			$query = mysqli_query($conn, "UPDATE office SET off_total='$total' WHERE off_id='$oid'") or die ("ERROR: " .mysqli_error($conn));
		}
	}

	$sum = "SELECT SUM(off_total) AS super_total FROM office WHERE form_id='$fid'";
	$result = mysqli_query($conn, $sum);
	if ($chk = mysqli_num_rows($result)) {
		while($row = mysqli_fetch_array($result)){
			$super_total = $row['super_total'];
			$query1 = mysqli_query($conn, "UPDATE forms SET form_total='$super_total' WHERE form_id='$fid'") or die ("ERROR: " .mysqli_error($conn));
		}
	}

	$sql = "DELETE FROM items WHERE item_no = '$delete'";
	$res = mysqli_query($conn, $sql);

	echo'<script>
			alert("Item has been deleted");
			window.location.href="../table/table_1.php?oid='.$oid.'&nid='.$fid.'";
		</script>';
}

?>