<?php
$article = $row['article'];
$item = $row['item_no'];
?>
<div <?php echo'id="trans_item'.$itno.'"'; ?> class="w3-modal w3-form w3-padding-64" >
<form method="POST" action="../php/transfer.php">
	<div class="w3-modal-content w3-card-8 w3-animate-top" style="max-width:600px;">
		<div class="w3-container">
			<div class="w3-section">
				<label>ITEM NAME: </label>
					<input type="text" name="i_name" <?php echo'value="'.$row['article'].'"'?>><br><br>
				<label>ITEM QUANTITY:</label>
					<?php
						if ($max == 0) {
							echo '<span style="float:right;">Item is currently <u>Out of Stock!</u></span>';
						}else{
							echo'<input type="number" name="i_qty" min="0" max="'.$row['qty_phys_count'].'">';
						}
					?>
					<br><br>
				<input type="hidden" name="i_cat" style="width:10%;float:left;" <?php echo'value="'.$row['cat_id'].'"'?>>
				<label>DESCRIPTION: </label>
				<input type="text" name="i_des" style="height:50px;" <?php echo 'value="'.$row['des'].'"'?>><br><br><br>
				<input type="hidden" name="i_no" <?php echo'value="'.$itno.'"'?>>
				<input type="hidden" name="i_date" <?php echo'value="'.$row['date_acquire'].'"' ?>>	
				<input type="hidden" name="i_prop" <?php echo'value="'.$row['prop_num'].'"'?>>
				<input type="hidden" name="i_measure" <?php echo'value="'.$row['unit_measure'].'"'?>>
				<input type="hidden" name="i_value" <?php echo'value="'.$row['unit_value'].'"'?>>	
				<input type="hidden" name="i_total" <?php echo'value="'.$row['total_amt'].'"'?>>
				<input type="hidden" name="i_sr" <?php echo'value="'.$row['qty_prop_card'].'"'?>>
				<input type="hidden" name="i_rs" <?php echo'value="'.$row['qty_phys_count'].'"'?>>
				<label>FORM:</label>
					<select id="<?php echo $itno ?>" name="i_form">
						<option value="0">Select Form</option>
						<?php 
							$dis_form = mysqli_query($conn,"SELECT * FROM forms");
							while ($roww = mysqli_fetch_array($dis_form)) {
								$fid = $roww['form_id'];
								$form_name = $roww['form_name'];
							echo '<option value="'.$fid.'">'.$form_name.'</option>';
							}
						?>
					</select><br><br>
				<label>OFFICE:</label>
					<select id="<?php echo 'form'.$item ?>" name="i_office">
						<option value="0">Select Office</option>
						<?php 
							$office = mysqli_query($conn,"SELECT * FROM office, forms WHERE forms.form_id=office.form_id");
							while ($rows = mysqli_fetch_array($office)){
								$oid = $rows['off_id'];
								$office_name = $rows['off_name'];
							echo '<option value="'.$oid.'">'.$office_name.'</option>
							';
							}
						?>
					</select><br><br>
				<label>PERSONNEL:</label>
					<select name="i_person">
						<option>Select Personnel</option>
						<?php 
							$person = mysqli_query($conn,"SELECT * FROM personnel");
							while ($row = mysqli_fetch_array($person)) {
								$pid = $row['person_id'];
								$personnel = $row['person_name'];

							echo '<option value="'.$pid.'">'.$personnel.'</option>';
							}
						?>
					</select><br><br>
				<br><br>
				<?php
					if ($max == 0) {
						echo'<button class="w3-btn w3-green" disabled type="submit" name="transfer">Transfer Item</button>';
					}else{
						echo'<button class="w3-btn w3-green" type="submit" name="transfer">Transfer Item</button>';
					}
				?>
				<?php echo'<button onclick="document.getElementById('.'\'trans_item'.$itno.'\''.').style.display='.'\'none\''.'" type="button" class="w3-btn w3-red" style="text-align: center;">Cancel</button>'; ?>
			</div>
		</div>
	</div>
</form>
</div>
<script>
$(document).ready(function(){
	$('#<?php echo $itno ?>').change(function(){
		var form = $(this).val();
		if (form == '') {

		}else{
				$.ajax({
				url:"../php/form-select.php",
				method: "post",
				data:{find:form},
				datType:"text",
				success:function(data) {
					$('#<?php echo 'form'.$item ?>').html(data);
				}
				});
		}
	});
});
</script>