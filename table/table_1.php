<?php
	include_once '../php/db_include.php';
	if (isset($_GET['oid'])) {
		$fid = mysqli_real_escape_string($conn, $_GET['oid']); //fid is office_id
	}
	if (isset($_GET['nid'])) {
		$zid = mysqli_real_escape_string($conn, $_GET['nid']); //zid is form_id
	}
?>
<?php
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header('Location: ../index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inventory | Bicol University Supply Office</title>
</head>
<?php include '../head/imports.php'; ?>
<body>
	<nav>
		<div class="navbar">
			<div id="center-me" style="color:white;margin-top:-10px;">
				<h5>
					<?php
						$query = "SELECT * FROM forms WHERE form_id='$zid'";
						$res = mysqli_query($conn, $query);
						if ($chk = mysqli_num_rows($res)) {
							while ($row = mysqli_fetch_array($res)) {
								$name = $row['form_name'];
								echo''.$name.'';
							}
						}
					?>
				</h5>
				<h5>Office Inventory</h5>
				<h5>As of <?php date_default_timezone_set("Asia/Taipei"); echo date("F d, Y l");?></h5>
			</div>
			<div style="color:white;">
				<table cellpadding="10" id="no-border">
					<thead>
					<?php
						$disp_per = mysqli_query($conn, "SELECT * FROM personnel, forms WHERE forms.form_id = '$zid' AND personnel.person_id = forms.person_id") or die ("ERROR" .mysqli_error($conn));	
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
			</div><br>
			<div>
				<?php
				$query = "SELECT*FROM forms, office WHERE forms.form_id=office.form_id AND forms.form_id='$zid' AND office.off_id='$fid'";
				$res=mysqli_query($conn,$query);
				if($chk=mysqli_num_rows($res)){
					while($row=mysqli_fetch_array($res)) {
						//$ideas=$row['form_id'];
						echo'<a class="w3-btn" style="background-color:#001e42; margin-left:2%;" href="../main/office.php?fid='.$zid.'">BACK</a>';
					}
				}
				?><br><br>
			</div>
		</div>
	</nav>
	<br><br>
	<?php
	echo'<a href="print.php?pin='.$fid.'" target="_blank" class="w3-btn w3-green" style="float:right;margin-right:20px;"><i class="fa fa-print"></i>Print</a>';
	?>
	<div style="width:1300px;margin-left:2%;">
		<?php
			$query = "SELECT * FROM office WHERE off_id='$fid'";
			$result = mysqli_query($conn, $query);
			if ($check = mysqli_num_rows($result)) {
				while ($row = mysqli_fetch_array($result)) {
					$name = $row['off_name'];
					echo'<h1>'.$name.'</h1>';
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
		<div class="w3-accordion">
			<button onclick="showTable('<?php echo $categ_name ?>')" class="w3-btn-block" style="background-color:#003471;">
				<?php
					echo ''.$categ_name.'<br>'; 
				?>
			</button>
			<?php include '../add-on/show_items-accord.php'; ?>
		</div>	
		<?php } ?>
		<br><br>
		<button onclick="document.getElementById('view_total').style.display='block'" class="w3-btn w3-green">View Total</button>
		<?php include '../add-on/view_total-modal.php'; ?>
		<br><br>
	</div>
<script>
	function showTable(id) {
	document.getElementById(id).classList.toggle("w3-show");
}
</script>
</body>
</html>