<div id="add_item" class="w3-modal">
	<div class="w3-modal-content" style="width: 600px;">
		<header class="w3-container w3-teal">
			<span onclick="document.getElementById('add_item').style.display='none'" class="w3-closebtn">&times;</span>
			<h2>ADD ITEM</h2>
		</header>
		<div class="w3-container">
			<form method="post" action="../php/add_item.php" class="w3-form">	
				<div>	
					<label>Item Name: </label>
					<input type="text" name="item_name"><br><br>
					<label>Description: </label>
					<textarea rows="3" name="description"></textarea><br><br><br><br>
					<label>Date Acquired: </label>
					<input type="date" name="date_acq"><br><br>
					<label>Property Number: </label>
					<input type="text" name="prop_num"><br><br>
					<label>Unit of Measure</label>
					<select type="text" name="unit_measure">
						<option>Unit/s</option>
						<option>Piece/s</option>
						<option>Set</option>
					</select><br><br>
					<label>Unit Value</label>
					<input type="text" name="unit_value"><br><br>
					<label>QTY per Property Card</label>
					<input type="number" name="prop_card"><br><br>
					<label>QTY per Physical Count</label>
					<input type="number" name="qty_phys_count"><br><br>
					<label>Remarks</label>
					<select name="remarks" required>
						<option>Select Personnel</option>
						<?php 
							$select_per = mysqli_query($conn,"SELECT * FROM personnel");
							while ($row = mysqli_fetch_row($select_per)) {
						?>
							<option value="<?=$row[0]; ?>"><?=$row[2]; ?></option>	
							<?php } ?>
					</select><br><br>
					<label>Select Category</label>
						<select type=text name="cat">
							<option>-select-</option>
							<?php 
							$select_cat = mysqli_query($conn,"SELECT * FROM categories");
							while ($row = mysqli_fetch_row($select_cat)){
						?>
						<option value="<?=$row[0]; ?>"><?=$row[1]; ?></option>
						<?php } ?>
					</select><br><br>
					<label>Office</label>
					<select type="text" name="office">
						<?php 
						$select_office = mysqli_query($conn,"SELECT * FROM office WHERE off_id='$fid'");
						while ($row = mysqli_fetch_row($select_office)){
						?>
						<option value="<?=$row[0]; ?> "> <?=$row[2];  ?></option>
						<?php  } ?>
					</select>
					<br><br>
					<?php
					$query="SELECT SUM(total_amt) AS totals FROM items WHERE office_id='$fid'";
					$res=mysqli_query($conn, $query);
					if($chk=mysqli_num_rows($res)){
						$rows = mysqli_fetch_array($res);
						if ($res == NULL) {
							echo'<input type="hidden" name="total" value="0">';
						}else{
							$sup_total= $rows['totals'];
							echo'<input type="hidden" name="total" value='.$sup_total.'>';
						}
					}
					/*$query1="SELECT*FROM items WHERE office_id='$fid'";
					$result=mysqli_query($conn, $query1);
					if ($check = mysqli_num_rows($result)) {
						$roww = mysqli_fetch_array($result);
						$oid = $roww['office_id'];*/
						echo '<input type="hidden" name="offid" value='.$fid.'>';
					/*}
					$query2="SELECT*FROM forms WHERE form_id='$zid'";
					$result2=mysqli_query($conn, $query2);
					if($check1=mysqli_num_rows($result2)){
						$rowws=mysqli_fetch_array($result2);
						$xid = $rowws['form_id'];*/
						echo'<input type="hidden" name="xid" value='.$zid.'>';
					//}
					?>
					<input type="submit" name="add_item" class="w3-btn w3-bu-blue"></input>
				</div>
			</form>
		</div>
	</div>
</div>