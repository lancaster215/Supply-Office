<form method="POST" <?php echo'id="edit_item'.$itid.'"'; ?> class="w3-modal w3-form" action="../php/edit_item.php">
	<div class="w3-modal-content w3-card-8 w3-animate-top" style="max-width:600px;">
		<header class="w3-container w3-green">
			<center><h3>Edit Item</h3></center>
		</header>
		<div class="w3-container">
			<div class="w3-section">
				<?php
					$query = "SELECT * FROM items WHERE item_no='$itid'";
					$res = mysqli_query($conn, $query);
					if ($chk = mysqli_num_rows($res)) {
						while ($row = mysqli_fetch_array($res)) {
							$item_no = $row['item_no'];
							$name = $row['article'];
							$date = $row['date_acquire'];
							$p_num = $row['prop_num'];
							$measure = $row['unit_measure'];
							$value = $row['unit_value'];
							$card = $row['qty_prop_card'];
							$physical = $row['qty_phys_count'];
				?>
				<input type="hidden" name="item_no" <?php echo'value='.$item_no.''; ?>>
				<label>Item Name: </label>
				<input type="text" name="item_name" <?php echo'value='.$name.''; ?>><br><br>
				<label>Description: </label>
				<textarea type="text" rows="3" name="description" <?php echo'placeholder='.$row['des'].'' ;?>></textarea><br><br><br><br>
				<label>Date Acquired: </label>
				<input type="date" name="date_acq" <?php echo'value='.$date.''; ?>><br><br>
				<label>Property Number: </label>
				<input type="text" name="prop_num" <?php echo'value='.$p_num.''; ?>><br><br>
				<label>Unit of Measure</label>
					<select type="text" name="unit_measure" <?php echo'value='.$measure.''; ?>>
						<option>Unit/s</option>
						<option>Piece/s</option>
						<option>Set</option>
					</select><br><br>
				<label>Unit Value</label>
				<input type="text" name="unit_value" <?php echo'value='.$value.''; ?>><br><br>
				<label>QTY per Property Card</label>
				<input type="number" name="prop_card" <?php echo'value='.$card.''; ?>><br><br>
				<label>QTY per Physical Count</label>
				<input type="number" name="qty_phys_count" <?php echo'value='.$physical.''; ?>><br><br>
				<label>Remarks</label>
					<select type="text" name="remarks" required>
						<option>Select Personnel</option>
						<?php 
							$select_per = mysqli_query($conn,"SELECT * FROM personnel");
							while ($row = mysqli_fetch_row($select_per)) {
						?>
						<option value="<?=$row[0]; ?>"><?=$row[2]; ?></option>	
						<?php } ?>
					</select><br><br>
				<?php
						}
					}
				?>
				<?php
					/*$query1="SELECT*FROM items WHERE office_id='$fid'";
					$result=mysqli_query($conn, $query1);
					if ($check = mysqli_num_rows($result)) {
						while($roww = mysqli_fetch_array($result)){
							$oid = $roww['office_id'];*/
							echo '<input type="hidden" name="offid" value='.$fid.'>';
					/*	}
					}
					$query2="SELECT*FROM forms WHERE form_id='$zid'";
					$result2=mysqli_query($conn, $query2);
					if($check1=mysqli_num_rows($result2)){
						while($rowws=mysqli_fetch_array($result2)){
							$xid = $rowws['form_id'];*/
							echo'<input type="hidden" name="xid" value='.$zid.'>';
					/*	}
					}*/
				?>
				<button class="w3-btn w3-green" type="submit" name="edit">Change</button>
				<?php echo'<button onclick="document.getElementById('.'\'edit_item'.$itid.'\''.').style.display='.'\'none\''.'" type="button" class="w3-btn w3-red" style="text-align: center;">Cancel</button>'; ?>
			</div>
		</div>
	</div>
</form>