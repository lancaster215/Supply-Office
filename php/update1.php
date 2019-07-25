<?php
session_start();
include_once 'db_include.php';

if(isset($_POST['update'])){
	$oid = mysqli_real_escape_string($conn, $_POST['off_id']);
	$fid = mysqli_real_escape_string($conn, $_POST['form_id']);
	$sid = mysqli_real_escape_string($conn, $_POST['remarks']);
	$pname = mysqli_real_escape_string($conn, $_POST['pname']);
	$pos = mysqli_real_escape_string($conn, $_POST['pos']);
	$stat = mysqli_real_escape_string($conn, $_POST['stat']);

	$statement = mysqli_query($conn, "UPDATE personnel SET person_name='".$pname."', person_position='".$pos."', person_status='".$stat."' WHERE person_name='".$pname."'") or die("Error: ".mysqli_error($conn));

	if($statement){
		echo'<script>
		alert("Record Updated!");
		window.location.href=" ../table/table_2.php?form_id='.$fid.'&off_id='.$oid.'&pid='.$sid.'";
		</script>';
	}	 
	else{
		header("location: ../table/table_2.php?form_id='$fid'&off_id='$oid'&pid='$sid'");
	}
}
?>