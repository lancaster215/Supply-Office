<?php
include_once 'db_include.php';
$nm = mysqli_real_escape_string($conn,$_POST['nm']);
$output = "";
$i_count = '1';
$output .= '
	<table class="w3-table-all w3-bordered w3-striped">
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
				<th>Total Stock Recieved</th>
				<th>Remaining Stock</th>
				<th>Operation</th>
			</tr>
		</thead>
		<tbody>
			<tr>';

$sql = "SELECT * FROM stocks, categories WHERE article LIKE ('%$nm%') OR des LIKE ('%$nm%') OR cat_name LIKE ('%$nm%') OR date_acquire LIKE ('%$nm%') OR prop_num LIKE ('%$nm%') AND stocks.cat_id = categories.cat_id GROUP BY item_no LIMIT 20";
$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_array($result)) {
		$itno = $row['item_no'];
		$max = $row['qty_phys_count'];
		$cat_name = $row['cat_name'];
		$dates = $row['date_acquire'];
		$date = date_create("$dates");
		$output .='
				<td>'.$i_count.'</td>
				<td>'.$row['article'].'</td>
				<td>'.$row['des'].'</td><td>';
				$output .= date_format($date, "m-d-Y");
				$output .='</td>
				<td>'.$row['prop_num'].'</td>
				<td>'.$row['unit_measure'].'</td>
				<td>'.$row['unit_value'].'</td>
				<td>'.$row['total_amt'].'</td>
				<td>'.$row['qty_prop_card'].'</td>
				<td>'.$row['qty_phys_count'].'</td>
				<td>
					<div>
						<button style="border-radius: 5px;" onclick="document.getElementById('.'\'trans_item'.$itno.'\''.').style.display='.'\'block\''.'" class="w3-btn w3-green"><i class="fa fa-edit fa-lg"></i></button>
					</div>';
				include '../add-on/trans_modal.php';
	$output .= '</td>
			</tr>';
	$i_count++;
	}
	$output .='</tbody>
	</table>';
	echo $output;
?>