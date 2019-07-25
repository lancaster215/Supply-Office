<?php 
	include_once '../php/db_include.php';
?>
<?php
	if (isset($_GET['pin'])) {
		$fid = mysqli_real_escape_string($conn, $_GET['pin']);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Print Table</title>
</head>
<?php include '../head/imports.php'; ?>
<body onload="window.print();">
<div>
		<?php
			$query = "SELECT * FROM office WHERE off_id='$fid'";
			$result = mysqli_query($conn, $query);
			if ($check = mysqli_num_rows($result)) {
				while ($row = mysqli_fetch_array($result)) {
					$name = $row['off_name'];
					echo'<center>'.$name.'</center><br>';
				}
			}
		?>
		<?php
			$count_cat = mysqli_query($conn,"SELECT COUNT(*) AS num_cat FROM categories");
			while ($row = mysqli_fetch_assoc($count_cat)){
				$num_cat = $row['num_cat'];
				$i = '1';
			}
			while ($i <= $num_cat){
				$total_price = mysqli_query($conn,"SELECT SUM(total_amt) AS totalp FROM items WHERE cat_id='$i' AND office_id='$fid'");
				$sel_cat = mysqli_query($conn,"SELECT cat_name FROM categories WHERE cat_id='$i'");
				while ($row = mysqli_fetch_assoc($sel_cat)) {
					$categ_name = $row['cat_name'];
				}
				while ($row = mysqli_fetch_assoc($total_price)) {
					$totalp = $row['totalp'];
					$i++;
				}
		?> 
		<?php
			echo ''.$categ_name.'<br>'; 
		?>
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
					$x = ($i - 2) +1 ;
					$disp_item = mysqli_query($conn,"SELECT * FROM items, personnel WHERE items.remarks = personnel.person_id AND items.cat_id = $x AND items.office_id= '$fid'");
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
		<?php 		
			echo "Total: " .$totalp."<br><br>"; }
		?>
		<br><br>
		<table>
			<?php
			$count_cat = mysqli_query($conn,"SELECT COUNT(*) AS num_cat FROM categories");
			while ($row = mysqli_fetch_assoc($count_cat)){
				$num_cat = $row['num_cat'];
				$i = '1';
			}
			while ($i <= $num_cat){
				$total_price = mysqli_query($conn,"SELECT SUM(total_amt) AS totalp FROM items WHERE cat_id = $i AND office_id='$fid'");
				$sel_cat = mysqli_query($conn,"SELECT cat_name FROM categories WHERE cat_id= $i");
				$show_item = mysqli_query($conn,"SELECT * FROM items WHERE cat_id = $i AND office_id='$fid'");
			
				while ($row = mysqli_fetch_assoc($total_price)) {
					$totalp = $row['totalp'];
					$i++;
				}
				while ($row = mysqli_fetch_assoc($sel_cat)) {
					$categ_name = $row['cat_name'];
				}
				while ($row = mysqli_fetch_array($show_item)) {
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
			?>
			<tr> 	
				<?php
					echo '<td>'.$categ_name.'<br></td>'; 
					echo '<td>Total: <span>'.$totalp.'</span><br><br></td>'; }
				?>
			</tr>
			<tr><td></td><?php
			$query="SELECT SUM(total_amt) AS totals FROM items WHERE office_id='$fid'";
			$res=mysqli_query($conn, $query);
			if($chk=mysqli_num_rows($res)){
				while($rows = mysqli_fetch_array($res)){
					$sup_total= $rows['totals'];
				}
			}
			echo '<td><b>TOTAL: '.$sup_total.' </b></td>'; 
			?></tr>
		</table>
	</div>
</body>
</html>