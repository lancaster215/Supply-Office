<?php
session_start();
include_once("db_include.php");

	if(isset($_POST['add_cat']))
	{
		
		$cat_name  = $_POST["cat_name"];
	}

	$check_cat_query = "SELECT * FROM categories WHERE cat_name = '".$cat_name."' ";
	$check_cat = mysqli_query($conn, $check_cat_query);
	
	if (mysqli_num_rows($check_cat) > 0) {
		echo'<script>
		alert("There is already a category of this name!");
		window.location.href="javascript:history.back()";
		</script>';
	}

	else{
		$q_insertcus = mysqli_query($conn,"INSERT INTO categories
		(cat_name)
		VALUES ('".$cat_name."')");

		if($q_insertcus){
			echo'<script>
			alert("Successfully Added!");
			window.location.href="../table/stocks.php";
			</script>';
		}	 
		else{
		header("location: ../table/stocks.php");
		}
	}

?>