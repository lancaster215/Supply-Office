<?php
session_start();
include_once 'db_include.php';

if (isset($_POST['add_o'])) {
	$fid = mysqli_real_escape_string($conn, $_POST['fid']);
	$office = mysqli_real_escape_string($conn, $_POST['office']);
	$total = mysqli_real_escape_string($conn, $_POST['total']);
	$sql = "INSERT INTO office(off_id, form_id, off_name, off_total) VALUES ('', '$fid', '$office', '$total')" or die("ERROR:" .mysqli_error($conn));
	$result = mysqli_query($conn, $sql);
	echo '<script>
		window.location.href="../main/office.php?fid='.$fid.'";
	</script>';
}
?>