<?php
include 'db_include.php';

$output = '';
$form = '';
$form = mysqli_real_escape_string($conn, $_POST['find']);

$sql = "SELECT * FROM office WHERE form_id = '$form'";
$query = mysqli_query($conn, $sql);
if ($check = mysqli_num_rows($query) > 0) {
	while($row = mysqli_fetch_array($query)){
		$name = $row['off_name'];
		$oid = $row['off_id'];
		$output .= '<option value="'.$oid.'">'.$name.'</option>';
	}
}
echo $output;
?>