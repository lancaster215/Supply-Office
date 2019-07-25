<?php
	include '../php/db_include.php';
	include '../php/check_user.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Personnel | Bicol University Supply Office</title>
	<?php 
		include '../head/imports.php';
	$query = mysqli_query($conn,"SELECT * FROM personnel ORDER BY person_name LIMIT 20");
	?>
</head>
<body>
	<?php
		include '../clip/clip-table/navbar-personnel.php ';
	echo '
		<div class="w3-overlay" onclick="w3_close()" style="cursor:pointer"></div>
		<div style="height:75px;background-color:#003471;color:white;margin-top:-1%;padding:1%;">
			<span class="w3-opennav" onclick="w3_open()"><h3>☰</h3></span> <br><br>
		</div>
		';
		include '../clip/clip-table/search-person.php';
		include '../clip/clip-table/table-personnel.php ';
	?>
</body>
</html>