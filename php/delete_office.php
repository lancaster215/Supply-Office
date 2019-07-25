<?php
session_start();
include_once 'db_include.php';

if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];
	$form = $_GET['form'];
	$sql = "DELETE FROM office WHERE off_id='$delete'";
	$res = mysqli_query($conn, $sql);

	echo'<script>
			alert("This Document has been deleted!");
			window.location.href="../main/office.php?fid='.$form.'";
		</script>';
}

?>