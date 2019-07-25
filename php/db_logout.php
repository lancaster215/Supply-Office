<?php

if (isset($_GET['logout'])) {
	session_start();
	session_unset($_SESSION['user_id']);
	session_destroy();
	header("Location: ../main/index.php?successfully_logout");
	exit();
}
?>