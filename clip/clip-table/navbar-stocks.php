<!-- NAVBAR CLIP -->
<nav class="w3-sidenav w3-bu-blue w3-animate-left" style="display:none;z-index:4;">
	<h5 style="padding:10px;"><!--<i class="fa fa-gear"></i>-->Inventory Stock Management </h5>
	<a href="javascript:void(0)" onclick="w3_close()" class="w3-closenav w3-bu-blue" style="text-align: right;float:right;margin-top:-95px;padding:10px;"><h5><i class="fa fa-close"></i></h5></a>

	<a href="../main/home.php" class="w3-btn w3-text-shadow w3-bu-blue w3-border-white" style="background-color: #001e42; width: 100%; text-align: left;"><h5><i class="fa fa-home"></i> Home</h5></a>
	<a href="personnel.php" class="w3-btn w3-text-shadow w3-bu-blue w3-border-white" style="background-color: #001e42; width: 100%; text-align: left;"><h5><i class="fa fa-male"></i> Personnel</h5></a>
	<div class="w3-dropdown-hover">
		<a href="#" class="w3-btn w3-bu-blue" style="margin-left:-100px;"><h5>Option <i class="fa fa-caret-down"></i></h5></a>
		<div class="w3-dropdown-content w3-card-2">
			<button onclick="document.getElementById('add_cat').style.display='block'" class="w3-btn w3-text-shadow w3-bu-blue w3-border-blue" style="background-color: #001e42; text-align: left;  width: 100%;"><h7> + ADD CATEGORY</h7></button> <br>
			<?php include '../add-on/add_cat-modal.php'; ?>
			<button onclick="document.getElementById('add_stock').style.display='block'" style="background-color: #001e42; width: 100%; text-align: left;" class="w3-btn w3-text-shadow w3-bu-blue w3-border-white"><h7> + ADD STOCK</h7></button>
			<?php include '../add-on/add_stock-modal.php'; ?>
		</div>
	</div>
</nav>
