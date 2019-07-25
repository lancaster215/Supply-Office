	<div id="<?php echo $categ_name ?>" class="w3-accordion-content w3-container">
		<table class="w3-table">
			<thead>
			<tr>
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
				<th>Operation</th>
			</tr>
			</thead>
			<tbody>
				<?php 
					$i_count = '1';
					$x = ($i - 2) +1 ;
					$disp_item = mysqli_query($conn,"SELECT * FROM items, personnel WHERE items.remarks = personnel.person_id AND items.cat_id = '$x' AND items.office_id='$fid'");
					while ($row = mysqli_fetch_array($disp_item)){
						$per_ch = $row['person_name'];
						$remarks = $row['remarks'];
						$itid = $row['item_no'];
						$dates = $row['date_acquire'];
						$date = date_create("$dates");
				?>
				<tr>
					<td><?=$i_count; ?></td>
					<td><?=$row[2]; ?></td>
					<td><?=$row[3]; ?></td>
					<td><?=date_format($date, "m-d-Y"); ?></td>
					<td><?=$row[5]; ?></td>
					<td><?=$row[6]; ?></td>
					<td><?=$row[7]; ?></td>
					<td><?=$row[8]; ?></td>
					<td><?=$row[9]; ?></td>
					<td><?=$row[10]; ?></td>
					<td><?php echo'<a href="table_2.php?pid='.$remarks.'&form_id='.$zid.'&off_id='.$fid.'">' ?><?=$per_ch; ?></a></td>

				<?php 
				echo'<td>
					<div class="functions" style="margin-top:20px;">
						<a href="../php/delete_item.php?delete='.$itid.'&fid='.$fid.'&nid='.$zid.'" style="border-radius: 5px;" class="w3-btn btn-danger w3-red"><i class="fa fa-trash-o fa-lg"></i></a><br>
						<button style="border-radius: 5px;" onclick="document.getElementById('.'\'edit_item'.$itid.'\''.').style.display='.'\'block\''.'" class="w3-btn w3-green"><i class="fa fa-edit fa-lg"></i></button>
					</div>';
					include '../add-on/edit_item-modal.php';
				$i_count++;} ?>
				</tr>
			</tbody>
		</table>
		<br>
		<div class="w3-dropdown-hover" style="float: left;">
  			<h5 class="w3-btn w3-green">
  				<?php 
  					if ($totalp == 0) {
  						echo "No Item/s Total";
  					}else{
  						echo "Total: ".$totalp."";
  					}
  				?></h5>
  		</div>
	</div>