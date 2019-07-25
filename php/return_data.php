<?php
include_once 'db_include.php';
$output = '';
$sql = "SELECT * FROM items, personnel WHERE remarks = '$sid' AND person_id = '$sid' AND item_no";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
		$output .='<tr>
					<td>'.$row['item_no'].'</td>
					<td>'.$row['article'].'</td>
					<td>'.$row['des'].'</td>
					<td>'.$row['date_acquire'].'</td>
					<td>'.$row['prop_num'].'</td>
					<td>'.$row['unit_measure'].'</td>
					<td>'.$row['unit_value'].'</td>
					<td>'.$row['total_amt'].'</td>
					<td>'.$row['qty_prop_card'].'</td>
					<td>'.$row['qty_phys_count'].'</td>
					<td>'.$row['person_name'].'</td>
				</tr>';
	}
}echo $output;
?>