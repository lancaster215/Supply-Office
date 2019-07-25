<?php
session_start();
include_once("db_include.php");

	if(isset($_POST['add_person']))
	{	
		$person_name  = $_POST["person_name"];
		$pos = $_POST["pos_name"];
	}
	$check_person_query = "SELECT * FROM personnel WHERE person_name = '".$person_name."' ";
	$check_person = mysqli_query($conn, $check_person_query);
	
	if (mysqli_num_rows($check_person) > 0) {
		echo'<script>
		alert("Name already Exist!");
		window.location.href="javascript:history.back()";
		</script>';
	}
	else{
		$q_insertcus = mysqli_query($conn,"INSERT INTO personnel
		(person_name, person_position)
		VALUES ('".$person_name."','".$pos."')") or die("Error: " .mysqli_error($conn));

		if($q_insertcus){
			echo'<script>
			alert("Successfully Added!");
			window.location.href="../table/personnel.php";
			</script>';
		}	 

		else{
		header("location: ../table/personnel.php");
		}
	}
?>