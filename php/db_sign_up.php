<?php

if(isset($_POST['submit'])){
	include_once 'db_include.php';

	$pass = mysqli_real_escape_string($conn, $_POST['pass']);

	$hash_pass = password_hash($pass, PASSWORD_DEFAULT);
	$sql = "INSERT INTO admin(admin_id, admin_pass) VALUES ('','$hash_pass');";
	mysqli_query($conn, $sql);
	header("Location: ../main/index.php?signup=success");
	echo '<script>
			aler("Successfully Sign-up!");
			window.location.href="../main/index.php"
		</script>';
	exit();
}else{
	header("Location: ../main/index.php?singup=error");
	echo '<script>
		alert("Error Singing-up!");
		window.location.href="../main/index.php
		<script>';
	exit();
}
?>