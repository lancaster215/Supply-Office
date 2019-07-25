<?php
	include_once '../php/db_include.php';
	if (isset($_GET['pid'])){
		$sid = mysqli_real_escape_string($conn, $_GET['pid']); //remarks
	}
	if (isset($_GET['form_id'])) {
		$for_id = mysqli_real_escape_string($conn, $_GET['form_id']);
	}	
	if (isset($_GET['off_id'])) {
		$offy_id = mysqli_real_escape_string($conn, $_GET['off_id']);		
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
	<title>Employee | Bicol University Supply Office</title>
</head>
<?php include '../head/imports.php'; ?>
<body>
	<div>
		<div id="office-label">
			<br><label><img src="../logo.ico" width="100" style="border-radius:25%;"></label>
			<div>
				<?php
					$query = "SELECT * FROM forms, office WHERE forms.form_id=office.form_id AND forms.form_id='$for_id' AND office.off_id='$offy_id'";
					$res = mysqli_query($conn, $query);
					if ($chk = mysqli_num_rows($res)) {
						while ($row = mysqli_fetch_array($res)) {
							echo'<a class="w3-btn" style="background-color:#001e42;margin-left:20px;" href="table_1.php?oid='.$offy_id.'&nid='.$for_id.'">BACK</a>';
						}
					}	
				?><br><br>
				<label style="float:left;margin-left:20px;margin-right:0px;">Search:</label>
				<input class="search" type="text" name="search_text" id="search_text" placeholder="Search by Article only..">
			</div>
		</div>
		<div id="fieldset-box" class="w3-container">
			<form method="post" action="../php/update1.php">
				<fieldset>
					<fieldset style="width: 25%;">
						<?php
						$query = mysqli_query($conn,"SELECT * FROM personnel WHERE person_id = '$sid'");
						if ($chk = mysqli_num_rows($query)) {
							while ($roww = mysqli_fetch_array($query)) {
								$sid = $roww['person_id'];
								$name = $roww['person_name'];
								$pos = $roww['person_position'];
								$stat = $roww['person_status'];
						?>
						<legend>EMPLOYEE INFORMATION</legend>
						<input type="hidden" name="off_id" value="<?=$offy_id;?>">
						<input type="hidden" name="form_id" value="<?=$for_id;?>">
						<input type="hidden" name="remarks" value="<?=$sid;?>">
						<label>Full Name: </label><br>
						<input type="text" name="pname" value="<?=$name; ?>"> <br>
						<label>Position: </label><br> 
						<input type="text" name="pos" value="<?=$pos; ?>"> <br>
						<label>Status: <u><?=$stat ?></u> </label><br><br>
						<select name="stat" style="float:left;">
							<option type="radio">On-Job</option>
							<option type="radio">Retired</option>
							<option type="radio">Fired</option>
						</select><br>
						<?php } }?><br>
						<input type="submit" name="update" class="w3-btn w3-green" style="margin-left:30%;">
					</fieldset>
				</fieldset>
			</form><br>
		</div>
	</div>
	<div style="width:1300px;margin-left:2.5%;">
		<?php
			$count=mysqli_query($conn, "SELECT COUNT(item_no) AS count FROM items, personnel WHERE items.remarks=personnel.person_id AND items.remarks='$sid' AND personnel.person_id='$sid'");
			while ($rows=mysqli_fetch_array($count)) {
				echo'<h3>'.$rows['count'].' Associated Items</h3>';
			}
		?><div id="result">
			<table border="1" cellpadding="5" class="w3-table-all w3-bordered w3-striped" >
				<thead>
					<tr style="background-color:#009688;color:white;">
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
						$disp_item = mysqli_query($conn,"SELECT * FROM personnel, items WHERE items.remarks = '$sid' AND personnel.person_id = '$sid' LIMIT 10");
						while ($row = mysqli_fetch_assoc($disp_item)){
					?>
					<tr>
						<td><?=$row['item_no']; ?></td>
						<td><?=$row['article']; ?></td>
						<td><?=$row['des']; ?></td>
						<td><?=$row['date_acquire']; ?></td>
						<td><?=$row['prop_num']; ?></td>
						<td><?=$row['unit_measure']; ?></td>
						<td><?=$row['unit_value']; ?></td>
						<td><?=$row['total_amt']; ?></td>
						<td><?=$row['qty_prop_card']; ?></td>
						<td><?=$row['qty_phys_count']; ?></td>
						<td><?=$row['person_name']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
<script>
$(document).ready(function(){
	$('#search_text').keyup(function(){
		var txt = $(this).val();
		if(txt != ''){
			$.ajax({
				url:"../php/fetch_data.php?sid=<?php echo''.$sid.'';?>",
				method:"post",
				data:{search:txt},
				dataType:"text",
				success:function(data){
					$('#result').html(data);
					$('#result').fadeIn('slow');
				}
			});
		}else{
			$.ajax({
				url:"../php/fetch_data.php?sid=<?php echo''.$sid.'';?>",
				method:"post",
				data:{search:txt},
				dataType:"text",
				success:function(data){
					$('#result').html(data);
					$('#result').fadeIn('slow');
				}
			});		
		}
	});
});
</script>
</body>
</html>