<div id="add_stock" class="w3-modal">
	<div class="w3-modal-content" style="width: 500px;">
		<header class="w3-container w3-teal">
			<span onclick="document.getElementById('add_stock').style.display='none'" class="w3-closebtn">&times;</span>
			<h2> + Add Stock</h2>
		</header>
		<div class="w3-container">
			<form method="post" action="../php/add_stock.php" class="w3-form">	
				<div>	
					<label>Item Name: </label>
					<input type="text" name="item_name" required="required"><br><br>
					<label>Description: </label>
					<textarea rows="3" name="description" required="required"></textarea><br><br><br><br>
					<label>Date Acquired: </label>
					<input type="date" name="date_acq" required="required"><br><br>
					<label>Property Number: </label>
					<input type="text" name="prop_num" required="required"><br><br>
					<label>Unit of Measure</label>
					<select name="unit_measure" required="required">
						<option>Select Unit of Measure</option>
						<option value="unit(s)">Unit(s)</option>
						<option value="set">Set</option>
						<option value="piece">Piece</option>
					</select><br><br>
					<label>Unit Value</label>
					<input type="text" name="unit_value" required="required"><br><br>
					<label>Stock Count</label>
					<input type="number" name="prop_card" required="required"><br><br>
					<label>Select Category</label>
						<select type=text name="cat" required="required">
							<option>-select-</option>
							<?php 
							$select_cat = mysqli_query($conn,"SELECT * FROM categories");
							while ($row = mysqli_fetch_row($select_cat)){
						?>
						<option value="<?=$row[0]; ?>"><?=$row[1]; ?></option>
						<?php } ?>
					</select><br><br>
					<!--<?php
					$query="SELECT SUM(total_amt) AS totals FROM items WHERE item_no='itno'";
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
					?>-->
					<input type="submit" name="add_item" value="ADD" class="w3-btn w3-bu-blue"></input><br><br>
				</div>
			</form>
		</div>
	</div>
</div>