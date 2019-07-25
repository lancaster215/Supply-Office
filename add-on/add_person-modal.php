<div id="add-person" class="w3-modal">
	<div class="w3-modal-content" style="width: 40%;">
		<header class="w3-container w3-bu-blue">
			<span onclick="document.getElementById('add-person').style.display='none'" class="w3-closebtn">&times;</span>
			<h2>ADD PERSON</h2>
		</header>
		<div class="w3-container">
			<form name="myForm" method="post" action="../php/add_person.php" class="w3-form" onsubmit="return valid_person1()">	
					<label>Person Name: </label>
					<input onkeyup="valid_person()" type="text" name="person_name" autocomplete="off" id="person_name" pattern="[a-zA-Z ]+" title="Must not contain a special character and numbers.     e.g. !@#$%^&*0-9">
					<span id="validate"></span>
					<br><br>
					<label>Position Name</label>
					<input autocomplete="off" type="text" name="pos_name"><br><br>
					<input style="margin-right:45%;" type="submit" name="add_person" class="w3-btn w3-green" pattern="[a-zA-Z ]+" title="Must not contain a special character and numbers.     e.g. !@#$%^&*0-9">
			<br><br><br>
			</form>
		</div>
	</div>
</div>