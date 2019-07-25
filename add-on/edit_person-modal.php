<div class="w3-modal" <?php echo'id="edit-person'.$sid.'"';?>>
	<div class="w3-modal-content w3-animate-zoom" style="width:40%;height:50%;">
		<header class="w3-container w3-teal">
			<span onclick="document.getElementById('edit-person<?php echo $sid ?>').style.display='none'" class="w3-closebtn">&times;</span>
			<h2>EDIT PERSON</h2>
		</header>
		<form method="POST" action="../php/update.php" class="w3-form">
		<?php
			echo'
				<label>Person name</label>
				<input type="text" name="pname" value="'.$pname.'"><br><br>
				<label>Position</label>
				<input type="text" name="pos" value="'.$pos.'"><br><br>
				<label>Current Status: <u>'.$stat.'</u></label>
				<select name="stat">
					<option value="on-job">On Job</option>
					<option value="retired">Retired</option>						
					<option value="fired">Fired</option>
				</select><br><br>
				<input type="submit" name="update" value="Update" class="w3-btn w3-green">';
		?>
		</form>
	</div>
</div>