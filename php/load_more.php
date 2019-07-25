<?php
include 'db_include.php';
$output = '';
if (isset($_GET['offset']) && isset($_GET['limit'])){
	$limit = $_GET['limit'];
	$offset = $_GET['offset'];
	$i_count = '1';

	$query = "SELECT * FROM stocks, categories WHERE stocks.cat_id = categories.cat_id ORDER BY item_no DESC LIMIT '$limit' OFFSET '$offset'";
	$result = mysqli_query($conn, $query);
	echo'<tbody>';
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			$cat_name = $row['cat_name'];
			$max = $row['qty_phys_count'];
			$total=$row['total_amt'];
			$total_v=$row['unit_value'];
			$itno = $row['item_no'];
			$dates = $row['date_acquire'];
			$date = date_create("$dates");

			echo'<td>'.$i_count.'</td>
				<td>'.$row['article'].'</td>
				<td>'.$row['des'].'</td><td>';
				echo date_format($date, "m-d-Y");
				echo'</td><td>'.$row['prop_num'].'</td>
				<td>'.$row['unit_measure'].'</td>';
				echo"<td title='$total_v.00'>$total_v</td>
				<td title='$total.00'>$total</td>";
				echo'<td>'.$row['qty_prop_card'].'</td>
				<td>'.$row['qty_phys_count'].'</td>
				<td>
					<center>
						<div>
							<button style="border-radius: 5px;" onclick="document.getElementById('.'\'trans_item'.$itno.'\''.').style.display='.'\'block\''.'" class="w3-btn w3-green"><i class="fa fa-edit fa-lg"></i></button>
						</div>
					</center>';
					include '../add-on/trans_modal.php';
			echo '</td>';
			$i_count++;
		}
		echo "<tr id='remove_row' class='load-btn'>
				<td>
					<button name='btn_more' id='btn_more' class='btn-more' data-prod='$prod_id;' ><i class='fa fa-refresh fa-lg'></i> Load More</button>
				</td>
			</tr>
		</tbdoy>";
	}
}
?>