<?php
session_start();
include_once 'db_include.php';

if (isset($_POST['edit'])) {
	$eid = mysqli_real_escape_string($conn, $_POST['eid']);
	$form = mysqli_real_escape_string($conn, $_POST['form']);
	$pid = mysqli_real_escape_string($conn, $_POST['person']);

	$sql = "UPDATE forms SET form_name='$form', person_id='$pid' WHERE form_id = '$eid'";
	$res = mysqli_query($conn, $sql);
	$person = "UPDATE personnel SET off_id='$pid' WHERE person_id='$pid'";
	$result = mysqli_query($conn, $person);

	echo'<script>
			alert("Successfully Edited Dodcument");
			window.location.href="../main/home.php";
		</script>';
}
?>