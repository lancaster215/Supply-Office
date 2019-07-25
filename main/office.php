<?php
	session_start();
	include_once '../php/db_include.php';
	if (isset($_GET['fid'])) {
		$fid = mysqli_real_escape_string($conn, $_GET['fid']);
	}
	if (!isset($_SESSION['user_id'])) {
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>BU Supply Office | Offices</title>
</head>
<?php include '../head/imports.php'; ?>
<body>
	<nav>
		<div class="w3-navbar">
			<div id="back">
				<ul>
					<li><a href="home.php">BACK</a></li>
					<li class="w3-dropdown-hover">
						<a href="" id="settings" style="color:white;"><i class="fa fa-cog fa-1x fa-fw"></i></a>
						<div class="w3-dropdown-content">							
							<?php
							$sql = "SELECT * FROM forms WHERE form_id='$fid'";
							$output = mysqli_query($conn, $sql);
							if ($results = mysqli_num_rows($output)) {
								while($row=mysqli_fetch_array($output)){
									echo'<button style="background-color: #001e42;" class="w3-btn"><a style="background-color: #001e42;color:white;" href="../table/del_items-table.php?fid='.$fid.'">DELETED ITEMS</a></button>';
								}
							}
							?>
						</div>
					</li>
				</ul>
			</div>
			<?php
				$res = mysqli_query($conn, $sql);
				if ($chk = mysqli_num_rows($res) > 0) {
					if($row = mysqli_fetch_array($res)){
						$name = $row['form_name'];
						echo"<div id='name'>$name</div>";
					}
				}
			?>
			<div id="out" style="margin-top:-2.2%;">
				<ul>
					<li><a class="w3-btn" href="../php/db_logout.php?logout">Log out</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<?php
		$sql="SELECT * FROM office, forms WHERE office.form_id=forms.form_id AND office.form_id='$fid'";
		$result = mysqli_query($conn, $sql);
		if ($chk = mysqli_num_rows($result) > 0) {
			echo'<div class="w3-padding">
					<div class="w3-row-padding">';
			while ($row = mysqli_fetch_array($result)) {
				$oid = $row['off_id'];
				$office = $row['off_name'];
				//$total = $row['off_total'];
				$form_id = $row['form_id'];
				$sup_total= $row['off_total'];
				echo'
					<div class="w3-third">
						<a href="../table/table_1.php?nid='.$row['form_id'].'&oid='.$row['off_id'].'">
						<div class="w3-card-4">
							<div class="w3-section w3-padding">
								<h1>'.$row['off_name'].'</h1>
								<h4>Total: '.$row['off_total'].'</h4>
								<div class="functions">
									<a title="Delete Office" href="../php/delete_office.php?delete='.$oid.'&form='.$form_id.'"><span class="w3-btn btn-danger w3-red"><i class="fa fa-trash-o fa-lg"></i></span></a>
									<button title="Edit Office" onclick="document.getElementById('.'\'edit'.$oid.'\''.').style.display='.'\'block\''.'" class="w3-btn w3-green"><i class="fa fa-edit fa-lg"></i></button>
								</div>
								<form method="POST" id="edit'.$oid.'" class="w3-modal" action="../php/edit_office.php">
									<div class="w3-modal-content w3-card-8 w3-animate-top" style="max-width:400px;">
										<div class="w3-container">
											<div class="w3-section">
												<label style="float:left;margin-top:8px;"><b>New Document:</b></label>
												<div class="w3-input w3-margin-bottom">
													<input style="border:none;outline:none;" type="text" name="form" autocomplete="off" placeholder="Name of document" value='.$office.' required><br>
												</div>
												
												<input type="hidden" name="eid" value='.$oid.'>
												<input type="hidden" name="fid" value='.$fid.'>
												<button class="w3-btn w3-green" type="submit" name="edit">Change</button>
												<button onclick="document.getElementById('.'\'edit'.$oid.'\''.').style.display='.'\'none\''.'" type="button" class="w3-btn w3-red" style="text-align: center;">Cancel</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						</a>
					</div>';
				}
			echo'	</div>
				</div>';
			}
	?>
	<div id="add">
		<button title="Add Office" onclick="document.getElementById('login').style.display='block'" class="login w3-btn" style="border-radius:50%;height:45px;background-color:#003471;outline:none;">&plus;</button>
		<form id="login" class="w3-modal" action="../php/add_office.php" method="POST">
			<div class="w3-modal-content w3-card-8 w3-animate-top" style="max-width:400px">
				<div class="w3-container">
					<div class="w3-section">
						<label style="float:left;margin-top:8px;"><b>Add Document:</b></label>
						<div class="w3-input w3-margin-bottom">
							<input style="border:none;outline:none;" type="text" name="office" autocomplete="off" placeholder="Name of document" required><br>
						</div>
						<label style="float:left;margin-top:8px;"><b>Enter Total:</b></label>
						<div class="w3-input w3-margin-bottom">
							<input style="border:none;outline:none;" type="text" name="total" value="0" autocomplete="off" placeholder="Total Amount" required><br>
						</div>
					</div>
					<div class="w3-section">
						<?php
						if (isset($_GET['fid'])) {
							$fid = mysqli_real_escape_string($conn, $_GET['fid']);
							
							$sql = "SELECT * FROM forms WHERE form_id='$fid'";
							$res = mysqli_query($conn, $sql);
							if ($chk = mysqli_num_rows($res) > 0) {
								if ($row = mysqli_fetch_array($res)) {
									$fid = $row['form_id'];
									echo'<input type="hidden" name="fid" value='.$fid.'></input>';
								}
								echo'<button class="w3-btn w3-green" type="submit" name="add_o">Add</button>';
							}else{
								echo'<button class="w3-btn w3-green" type="submit" name="add_o">Add</button>';
							}
						}
						?>
						<button onclick="document.getElementById('login').style.display='none'" type="button" class="w3-btn w3-red" style="text-align: center;">Cancel</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</body>
</html>