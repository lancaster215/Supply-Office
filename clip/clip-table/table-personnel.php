<center>
<table class="w3-table-all w3-bordered w3-striped" id="result">
	<thead>
		<tr style="background-color:#009688;color:white;">
			<th>Personnel</th>
			<th>Position</th>
			<th>Status</th>
			<th>Operation</th>
		<tr>
	</thead>
	<tbody>
	<?php 
		while ($roww = mysqli_fetch_array($query)) {
			$sid = $roww['person_id'];
			$pname = $roww['person_name'];
			$pos = $roww['person_position'];
			$stat = $roww['person_status'];
	echo
	'<tr>
		<td>'.$pname.'</td>
		<td>'.$pos.'</td>
		<td>'.$stat.'</td>
		<td>
		<button onclick="document.getElementById('.'\'edit-person'.$sid.'\''.').style.display='.'\'block\''.'" class="w3-btn w3-green" style="border-radius: 15%;"><i class="fa fa-edit fa-lg"></i></button>';
			include '../add-on/edit_person-modal.php';
	echo'
		</td>
	</tr>';
	}
	?>
	</tbody>
</table>
</center>