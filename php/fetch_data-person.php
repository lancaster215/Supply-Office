<?php
include_once 'db_include.php';
$nm = mysqli_real_escape_string($conn, $_POST['nm']);
$output = '';
$output .='<table class="w3-table-all w3-bordered w3-striped">
	<thead>
		<tr style="background-color:#009688;color:white;">
			<th>Personnel</th>
			<th>Position</th>
			<th>Status</th>
			<th>Operation</th>
		<tr>
	</thead>
	<tbody>
		<tr>';
$sql = "SELECT * FROM personnel WHERE person_name LIKE ('%$nm%') OR person_position LIKE ('%$nm%') OR person_status LIKE ('%$nm%') ORDER BY person_name LIMIT 20";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {	
	while ($row = mysqli_fetch_array($result)) {
		$sid = $row['person_id'];
		$pname = $row['person_name']; 
		$pos = $row['person_position'];
		$stat = $row['person_status'];
		$output .='
				<td>'.$pname.'</td>
				<td>'.$pos.'</td>
				<td>'.$stat.'</td>
				<td>
					<button onclick="document.getElementById('.'\'edit-person'.$sid.'\''.').style.display='.'\'block\''.'" class="w3-btn w3-green" style="border-radius: 15%;"><i class="fa fa-edit fa-lg"></i></button>';
					include '../add-on/edit_person-modal.php';
		$output .='</td>
			</tr>';
		}
		$output .="</tbody>
		 </table>";
	}
echo $output;
?>