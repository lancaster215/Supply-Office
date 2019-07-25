<?php
session_start();

	$loger = '';
if (isset($_POST['login'])) {
	include_once 'db_include.php';			
	//$id = mysqli_real_escape_string($conn, $_POST['id']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);

		$sql = "SELECT * FROM admin WHERE admin_id = 1";
		$result = mysqli_query($conn, $sql) or die (mysqli_error($sql));

			if ($row = mysqli_fetch_array($result)){

			$_SESSION['user_id'] = $row['admin_id'];
			$hashpasscheck = password_verify($pass, $row['admin_pass']);

				if ($hashpasscheck == false) {
			 		header( "Location: ../main/index.php" );
       		 		$loger = 'Please fillup the form properly';
        			header("Location: ../main/index.php?log='$loger'");
        			session_unset($_SESSION['user_id']);
					exit();
		
				}elseif ($hashpasscheck == true){
					echo '<script>
							alert("Admin Logged In!");
							window.location.href="../main/home.php";
					</script>';//successfuly saved
					exit();
			}
		}
}else{
	$loger = 'Please fillup the form properly';
	header("Location: ../main/index.php?log='$loger'");
	exit();
}
?>