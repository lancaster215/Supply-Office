<!DOCTYPE html>
<?php 
	include_once '../php/db_include.php';
?>
<html>
<head>
	<title>Inventory | Bicol University Supply Office</title>

	<!-- Custom CSS -->
	<link href="../css/kss/table.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/w3.css">

</head>
<body>
	<div id="center-me">
	<!-- To be replaced by the form type -->
	<h3>
		<?php 

			$disp_form = mysqli_query($conn,"SELECT * FROM forms");  
			while ($row = mysqli_fetch_row($disp_form)) {
		?>
		<?=$row[1]; } ?>
	</h3><!-- FORM TYPE -->
	<h3>Office Inventory</h3> <!-- Untouched -->
	<h3>As of <?php date_default_timezone_set("Asia/Taipei"); echo date("F d, Y l");?></h3> <!-- Date -->
	<!-- To be replaced by the form type -->
	</div>
	<table cellpadding="10" id="no-border">
		
		<thead>
		<?php
				 $disp_per = mysqli_query($conn, "SELECT * FROM personnel, forms, office WHERE personnel.form_id=forms.form_id ");	
				 while ($row = mysqli_fetch_assoc($disp_per)) {	 	
			 ?> 
		<tr>
			<td>For which</td>
			<th><?=$row['person_name']; ?></th>
			<th><?=$row['person_position']; ?></th>
			<th><?=$row['off_name']; ?></th>
			<th>is accountable having assumed such accountability on <?=$row['date_assump'];  ?></th>
		</tr>
		<?php } ?>
		</thead>
		<tbody align="center">
		<tr>
			<td>
			<td>(Name of Accountable Officer)</td>
			<td>(Official Designation)</td>
			<td>(Agency/Office)</td>
			<td>(Date of Assumption)</td>
		</tr>
		</tbody>
	</table>
			<br><br>
			<?php 
				$disp_office = mysqli_query($conn,"SELECT * FROM office");
				while ($row = mysqli_fetch_row($disp_office)) {
			?>
			<h1> <?=$row[1]; } ?> </h1> <!--OFFICE --> 
				<!-- <?php 	/*
				$disp_cat = mysqli_query($conn,"SELECT * FROM categories");
				while ($row = mysqli_fetch_row($disp_cat)) {
			  */?> -->
			<br><br>
		
		<button onclick="document.getElementById('add_item').style.display='block'" class="w3-btn w3-bu-blue">+ ADD ITEM</button>&nbsp;	
		<?php include '../add-on/add_item-modal.php'; ?> 
		<!-- ADD ITEM MODAL -->


		<button onclick="document.getElementById('add-person').style.display='block'" class="w3-btn w3-bu-blue">+ ADD PERSON</button>
		<?php include '../add-on/add_person-modal.php'; ?>
		<!-- ADD Person MODAL -->
		<br> <br>

		
	
	<table class="w3-table" width="100%">
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
		</tr>
		</thead>
		<tbody>
			<?php 
				$disp_item = mysqli_query($conn,"SELECT * FROM items, personnel WHERE items.remarks = personnel.person_id  ORDER BY items.cat_id");
				while ($row = mysqli_fetch_array($disp_item)){
					$per_ch = $row['person_name'];
			?>
			<tr>
				<td><?=$row['item_no']; ?></td>
				<td><?=$row[2]; ?></td>
				<td><?=$row[3]; ?></td>
				<td><?=$row[4]; ?></td>
				<td><?=$row[5]; ?></td>
				<td><?=$row[6]; ?></td>
				<td><?=$row[7]; ?></td>
				<td><?=$row[8]; ?></td>
				<td><?=$row[9]; ?></td>
				<td><?=$row[10]; ?></td>
				<td><?=$per_ch ?></td>
			<?php } ?>
			</tr>
		</tbody>
	</table>
	<div>
		<fieldset>
				<?php 
					$count_cat = mysqli_query($conn,"SELECT COUNT(*) AS num_cat FROM categories");
					while ($row = mysqli_fetch_assoc($count_cat)){
					$num_cat = $row['num_cat'];
					$i = '1';
					}
					while ($i <= $num_cat){
						$total_price = mysqli_query($conn,"SELECT SUM(total_amt) AS totalp FROM items WHERE cat_id = $i");
						$sel_cat = mysqli_query($conn,"SELECT cat_name FROM categories WHERE category_id= $i");
						$show_item = mysqli_query($conn,"SELECT * FROM items WHERE cat_id = $i");
							while ($row = mysqli_fetch_assoc($sel_cat)) {
							$categ_name = $row['cat_name'];
							}
							while 
								($row = mysqli_fetch_array($show_item)) {
								$article = $row["article"];
								$des = $row["des"];
								$date_a = $row["date_acquire"];
								$prop_n = $row["prop_num"];
								$unit_m = $row["unit_measure"];
								$unit_v = $row["unit_value"];
								$total_a = $row["total_amt"];
								$qty_pc = $row["qty_prop_card"];
								$qty_phc = $row["qty_phys_count"];
								$remarks = $row["remarks"];
								$off_id = $row["office_id"]; 
								}
							
							while ($row = mysqli_fetch_assoc($total_price)) {
								$totalp = $row['totalp'];
								$i++;
							}
				
							
				 ?> 
				
				<?php
					echo $categ_name."<br>"; 
					echo "Total: " .$totalp."<br><br>"; } 

				?>

		
		</fieldset>
	</div>
	<br><br>
	<table class="w3-table" width="50%" cellpadding="10" align="right">
			<?php
 					$disp_cat = mysqli_query($conn,"SELECT cat_name, total FROM categories");
					while ($row = mysqli_fetch_assoc($disp_cat)){
				?>
			<tr>
				<td><?=$row['cat_name']; ?></td> 
				<td><?=$row['total']; ?></td>
				<?php  } ?>
			</tr>
			
			<tr>
				<?php 
					$disp_tot = mysqli_query($conn,"SELECT * FROM super_total WHERE total_id = 1");
					if ($row = mysqli_fetch_row($disp_tot)){
			 	?>	
				<td>TOTAL: </td>	
				<td><?=$row[2]; } ?></td>
				
			</tr>
		</tbody>
	</table>
</body>
</html>