<table class="w3-table-all w3-bordered w3-striped" id="result">
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
		<?php 
			$i_count = '1';
			$disp = "SELECT * FROM stocks, categories WHERE stocks.cat_id = categories.cat_id ORDER BY item_no DESC LIMIT 20";
			$result = mysqli_query($conn, $disp);
			while ($row = mysqli_fetch_array($result)){
				$cat_name = $row['cat_name'];
				$max = $row['qty_phys_count'];
				$total=$row['total_amt'];
				$total_v=$row['unit_value'];
				$itno = $row['item_no'];
				$dates = $row['date_acquire'];
				$date = date_create("$dates");
		 ?>
		<tr>
		<?php echo'
			<td>'.$i_count.'</td>
			<td>'.$row['article'].'</td>
			<td>'.$row['des'].'</td><td>';
			echo date_format($date, "m-d-Y");
			echo'</td><td>'.$row['prop_num'].'</td>
			<td>'.$row['unit_measure'].'</td>';
			echo"<td title='$total_v.00'>$total_v</td>
			<td title='$total.00'>$total</td>";
			echo'<td>'.$row['qty_prop_card'].'</td>
			<td>'.$row['qty_phys_count'].'</td>
			<td title="Transfer">
				<center>
					<div>
						<button style="border-radius: 5px;" onclick="document.getElementById('.'\'trans_item'.$itno.'\''.').style.display='.'\'block\''.'" class="w3-btn w3-green"><i class="fa fa-edit fa-lg"></i></button>
					</div>
				</center>';
				include '../add-on/trans_modal.php';
		echo'</td>';
			$i_count++;
			}
		?>
		</tr>
	</tbody>
</table>