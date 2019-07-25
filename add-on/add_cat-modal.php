<div id="add_cat" class="w3-modal">
	<div class="w3-modal-content" style="width:500px;">
		<header class="w3-container w3-teal">
			<span onclick="document.getElementById('add_cat').style.display='none'" class="w3-closebtn">&times;</span>
			<h2>ADD CATEGORY </h2>
		</header>
		<div class="w3-container">
			<form name="catForm" method="post" action="../php/add_category.php" class="w3-form" onsubmit="return valid_cat1()" >	
			<div>
				<label>CATEGORY Name: </label>
				<input autocomplete="off" onkeyup="valid_cat()" type="text" id="cat_name" name="cat_name" autocomplete="off" pattern="[a-zA-Z ]+" title="Must not contain a special character and numbers. e.g. !@#$%^&*0-9"> 
				<span  id="validcat"></span>
				<br><br>
			</div>
				<button style="margin-left: 40%;" type="submit" name="add_cat" value="ADD" class="w3-btn w3-green"> ADD</button>
			</form>
		</div>
	</div>
</div>