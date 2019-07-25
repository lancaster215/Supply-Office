<?php
session_start();
include_once 'db_include.php';

if(isset($_POST['update'])){
	$pname = mysqli_real_escape_string($conn, $_POST['pname']);
	$pos = mysqli_real_escape_string($conn, $_POST['pos']);
	$stat = mysqli_real_escape_string($conn, $_POST['stat']);

	$statement = mysqli_query($conn, "UPDATE personnel SET person_name='".$pname."', person_position='".$pos."', person_status='".$stat."' WHERE person_name='".$pname."'") or die("Error: ".mysqli_error($conn));

	if($statement){
		echo'<script>
		alert("Record Updated!");
		window.location.href=" ../table/personnel.php";
		</script>';
	}	 
	else{
		header("location: ../table/personnel.php");
	}
}
?>