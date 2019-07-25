<?php
session_start();
include_once 'db_include.php';

if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];
	$sql = "DELETE FROM forms WHERE form_id='$delete'";
	$res = mysqli_query($conn, $sql);
	$sql1 = "DELETE FROM office WHERE form_id='$delete'";
	$result = mysqli_query($conn, $sql1);

	echo'<script>
			alert("This Document will be deleted");
			window.location.href="../main/home.php";
		</script>';
}

?>