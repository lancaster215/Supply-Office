<?php
session_start();
include_once 'db_include.php';

if (isset($_POST['edit'])) {
	$eid = mysqli_real_escape_string($conn, $_POST['eid']);
	$fid = mysqli_real_escape_string($conn, $_POST['fid']);	
	$form = mysqli_real_escape_string($conn, $_POST['form']);

	$sql = mysqli_query($conn, "UPDATE office SET off_name='$form' WHERE off_id = '$eid'") or die ("ERROR: " .mysqli_error($conn));

	echo'<script>
			alert("Successfully Edited Document");
			window.location.href="../main/office.php?fid='.$fid.'";
		</script>';
}
?>