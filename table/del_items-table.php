<?php
session_start();
include '../php/db_include.php';

if (isset($_GET['fid'])) {
	$fid = mysqli_real_escape_string($conn, $_GET['fid']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Deleted Items</title>
</head>
<?php include '../head/imports.php'; ?>
<body>
<div>
	<div style="width: 100%;">
		<header class="w3-container" style="background-color:#003471;color:white;">
			<?php
				$query1 = "SELECT * FROM forms WHERE form_id='$fid'";
				$res1 = mysqli_query($conn, $query1);
				if ($chk = mysqli_num_rows($res1)) {
					while($roww = mysqli_fetch_array($res1)){
						$name = $roww['form_name'];
						echo'<a class="w3-btn" style="background-color:#001e42;
						margin-top:20px;margin-bottom:-60px;" href="../main/office.php?fid='.$fid.'">BACK</a>';
						echo'<center><h2>DELETED ITEMS of '.$name.' Form</h2></center>';
					}
				}
			?>
		</header>
		<div class="w3-container"><br>
			<table class="w3-table-all w3-bordered w3-striped" id="result">
				<thead>
					<tr style="background-color:#009688;color:white;">
						<th>Item Name</th>
						<th>Date Deleted</th>
						<th>Category Name</th>
						<th>Description of Item</th>
						<th>Property Number</th>
						<th>Item Amount</th>
						<th>Office Name</th>
					</tr>
				</thead>
				<tbody>
					
			<?php
				$query = "SELECT *FROM deleted, forms, office, categories WHERE deleted.cat_id=categories.cat_id AND deleted.off_id=office.off_id AND forms.form_id=office.form_id AND forms.form_id='$fid'";
				$res = mysqli_query($conn, $query);
				if ($result = mysqli_num_rows($res)) {
					while ($row = mysqli_fetch_array($res)) {
						$article = $row['article'];
						$date = $row['date_del'];
						$cat = $row['cat_name'];
						$des = $row['des'];
						$p_num = $row['prop_num'];
						$total = $row['total_amt'];
						$off_name = $row['off_name'];
					echo'<tr>
							<td>'.$article.'</td>
							<td>'.$date.'</td>
							<td>'.$cat.'</td>
							<td>'.$des.'</td>
							<td>'.$p_num.'</td>
							<td>'.$total.'</td>
							<td>'.$off_name.'</td>
						</tr>';
					}
					echo'</tbody>';
				}else{
					echo'NO ITEMS YET DELETED';
				}
			?>
			</table>
		</div>
	</div>
</div>
</body>
</html>