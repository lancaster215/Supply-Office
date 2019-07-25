<?php
	include_once 'db_include.php';	//Connects to database
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header('Location: ../index.php');
	}
?>