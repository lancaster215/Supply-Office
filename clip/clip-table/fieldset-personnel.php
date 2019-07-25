<div>
<?php
	$query = mysqli_query($conn,"SELECT * FROM personnel");
		if ($chk = mysqli_num_rows($query)) {
			while ($roww = mysqli_fetch_array($query)) {
				$sid = $roww['person_id'];
				$name = $roww['person_name'];
				$pos = $roww['person_position'];
				$stat = $roww['person_status'];
				//$for_id = $roww['form_id'];
				
?>
<div id="fieldset-box" class="w3-container">
			<form method="post" action="../php/update.php">
				<fieldset>
					<fieldset style="width: 25%;">
						<legend>EMPLOYEE INFORMATION</legend>
						<input type="hidden" name="pid" value="<?=$sid; ?>" >
						<label>Full Name: </label><br>
						<input type="text" name="pname" value="<?=$name; ?>"> <br>
						<label>Position: </label><br> 
						<input type="text" name="pos" value="<?=$pos; ?>"> <br>
						<label>Status: </label>
						<select name="stat" style="float:right;">
							<option type="radio"> <?=$stat ?></option>
							<option>-----------</option>
							<option type="radio">On-Job</option>
							<option type="radio">Retired</option>
							<option type="radio">Fired</option>
						</select><br><br>
						<!--<input  name="stat" value="on-job"><br>
						<input  name="stat" value="retired"><br>
						<input   value="fired"><br>-->
						<input type="submit" name="update" class="w3-btn w3-green" style="margin-left:30%;">
					</fieldset>
				</fieldset>
			</form><br>
		</div>
<?php } }?><br>
</div>