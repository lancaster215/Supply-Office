<?php
include_once 'db_include.php';

//$nm = mysqli_real_escape_string($conn, $_GET['nm']);
$sid = mysqli_real_escape_string($conn, $_GET['sid']);
$nm = mysqli_real_escape_string($conn,$_POST['search']);
$output = '';

$count =mysqli_query($conn, "SELECT COUNT(item_no) AS count FROM items, personnel WHERE article LIKE ('%$nm%') AND remarks='$sid' AND  person_id='$sid' AND items.remarks=personnel.person_id");
while($rows =mysqli_fetch_array($count)){
	$output .= '<h3 style="margin-left:16%;margin-top:-3.5%;">| '.$rows['count'].' Searched Items</h3>';
}
$output .='
<table border="1" cellpadding="5" class="w3-table-all w3-bordered w3-striped">
	<thead>
		<tr style="background-color:#009688;color:white;">
			<th>Item No.</th>
			<th>Article</th>
			<th>Description</th>
			<th>Date Acquired</th>
			<th>Propery Number</th>
			<th>Unit of Measure</th>
			<th>Unit Value</th>
			<th>Total Amount</th>
			<th>Quantity per Property Card</th>
			<th>Quantity per Physical Count</th>
			<th>REMARKS (state, whereabouts, conditions, etc.)</th>
		</tr>
	</thead>
	<tbody>';
$sql = "SELECT * FROM items, personnel WHERE article LIKE ('%$nm%') AND remarks='$sid' AND  person_id='$sid' AND items.remarks=personnel.person_id LIMIT 10";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
		$output .='
			<tr>
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
	}$output .= '</tbody>
	</table>';
}echo $output;
?>