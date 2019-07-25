<?php
	include_once '../php/db_include.php';
	include '../php/check_user.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome | Bicol University Supply Office</title>
</head>
<?php include '../head/imports.php'; ?>
<body>
	<nav>
		<div class="w3-navbar">
			<div id="out">
				<ul>
					<li><a class="w3-btn" href="../php/db_logout.php?logout">Log out</a></li>
				</ul>
			</div>
			<div id="adding">
				<ul class="w3-left">
					<li class="w3-dropdown-hover">
						<a href="" id="settings" style="color:white;"><i class="fa fa-cog fa-1x fa-fw"></i></a>
						<div class="w3-dropdown-content">
							<?php include '../add-on/add_person-modal.php'; ?>
							<a class="w3-btn w3-bu-blue" style="color: white; background-color: #001e42;" href="../table/stocks.php"> Check inventory stocks </a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<?php
		$sql="SELECT * FROM forms";
		$result = mysqli_query($conn, $sql);
		if ($chk = mysqli_num_rows($result) > 0) {
			echo'<div class="w3-padding">
					<div class="w3-row-padding">';
			while ($row = mysqli_fetch_array($result)) {
				$fid = $row['form_id'];
				$form = $row['form_name'];
				$date = $row['date_assump'];
				$per_id = $row['person_id'];
				$total = $row['form_total'];
				echo'
					<div class="w3-third">
						<a href="office.php?fid='.$row['form_id'].'">
						<div class="w3-card-8">
							<div class="w3-section w3-padding">
								<div style="width:320px;">
									<h1>'.$row['form_name'].'</h1><br><br>
									<h4>TOTAL: '.$row['form_total'].'</h4>
								</div>
								<div class="functions">
									<a title="Delete Form" href="../php/delete_form.php?delete='.$fid.'"><span class="w3-btn btn-danger w3-red"><i class="fa fa-trash-o fa-lg"></i></span></a>
									<button title="View Information" onclick="document.getElementById('.'\'details'.$fid.'\''.').style.display='.'\'block\''.'" class="w3-btn w3-blue"><i class="fa fa-folder-open-o"></i></button>
									<button title="Edit Form" onclick="document.getElementById('.'\'edit'.$fid.'\''.').style.display='.'\'block\''.'" class="w3-btn w3-green"><i class="fa fa-edit fa-lg"></i></button>
								</div>
								<form method="POST" id="edit'.$fid.'" class="w3-modal" action="../php/edit_form.php">
									<div class="w3-modal-content w3-card-8 w3-animate-top" style="max-width:500px;">
										<div class="w3-container">
											<div class="w3-section">
												<label style="float:left;margin-top:8px;"><b>New Document:</b></label>
												<div class="w3-input w3-margin-bottom">
													<input style="border:none;outline:none;" type="text" name="form" autocomplete="off" placeholder="Name of document" value='.$form.'><br>
												</div>
												<label style="float:left;margin-top:8px;"><b>New Accountable Officer:</b></label>
												<div class="w3-input w3-margin-bottom"><br>
													<select type="text" name="person" style="margin-top:-20px;">
														<option value='.$per_id.'>-SELECT-</option>';
														$query1="SELECT*FROM personnel";
														$results=mysqli_query($conn, $query1);
														if($say=mysqli_num_rows($results)){
															while($roww = mysqli_fetch_array($results)){
																$pid = $roww['person_id'];
																$person = $roww['person_name'];
																echo'<option value='.$pid.'>'.$person.'</option>';
															}
														}
				echo'								</select>
												</div>
												<input type="hidden" name="eid" value='.$fid.'></input>
												<button class="w3-btn w3-green" type="submit" name="edit">Change</button>
												<button onclick="document.getElementById('.'\'edit'.$fid.'\''.').style.display='.'\'none\''.'" type="button" class="w3-btn w3-red" style="text-align: center;">Cancel</button>
											</div>
										</div>
									</div>
								</form>
								<form method="POST" id="details'.$fid.'" class="w3-modal" action="../php/edit_form.php">
									<div class="w3-modal-content w3-card-8 w3-animate-top" style="max-width:1000px;">
										<header class="w3-container w3-teal">
											<span onclick="document.getElementById('.'\'details'.$fid.'\''.').style.display='.'\'none\''.'" class="w3-closebtn">&times;</span>
											<h2>FORM DETAILS</h2>
										</header>
										<div class="w3-container">
											<div class="w3-section w3-half">';
												$query = "SELECT*FROM personnel, forms WHERE forms.person_id=personnel.person_id AND forms.form_id='$fid'";
												$output = mysqli_query($conn, $query);
												if ($check = mysqli_num_rows($output)) {
													if ($rows = mysqli_fetch_array($output)) {
														$name = $rows['person_name'];
														$position = $rows['person_position'];
														echo'<h4>'.$rows['person_name'].'</h4>
															<h7><i>(Name of Accountable Officer)</i></h7>
															<h4>'.$rows['person_position'].'</h4>
															<h7><i>(Official Designation)</i></h7>';
													}
												}
				echo'							<h4>'.$row['date_assump'].'</h4>
												<h7><i>(Date of Assumption)</i></h7><br><br>
											</div>
											<div class="w3-section w3-half">';
												$it_e = mysqli_query($conn, "SELECT SUM(total_amt) AS total_it_e FROM categories, items, forms, office WHERE categories.cat_id=items.cat_id AND office.form_id=forms.form_id AND items.form_id=forms.form_id AND office.off_id=items.office_id AND office.form_id=items.form_id AND forms.form_id='$fid' AND categories.cat_id='1'");
												if($check1=mysqli_num_rows($it_e)>0){
													while($row1=mysqli_fetch_array($it_e)){
													echo'<h5><b>Total IT Equipment: </b>';
													if($row1['total_it_e']==NULL){echo'<h4>None</h4>';}
													else{
				echo'								<br>'.$row1['total_it_e'].'</h5>';
													}
													}
												}
												$m_e = mysqli_query($conn, "SELECT SUM(total_amt) AS total_m_e FROM categories, items, forms, office WHERE categories.cat_id=items.cat_id AND office.form_id=forms.form_id AND items.form_id=forms.form_id AND office.off_id=items.office_id AND office.form_id=items.form_id AND forms.form_id='$fid' AND categories.cat_id='2'");
												if ($check2=mysqli_num_rows($m_e)>0) {
													while($row2=mysqli_fetch_array($m_e)){
													echo'<h5><b>Total Musical Equipment: </b>';
													if($row2['total_m_e']==NULL){echo'<h4>None</h4>';}
													else{
				echo'								<br>'.$row2['total_m_e'].'</h5>';
													}
													}
												}
												$c_e = mysqli_query($conn, "SELECT SUM(total_amt) AS total_c_e FROM categories, items, forms, office WHERE categories.cat_id=items.cat_id AND office.form_id=forms.form_id AND items.form_id=forms.form_id AND office.off_id=items.office_id AND office.form_id=items.form_id AND forms.form_id='$fid' AND categories.cat_id='3'");
												if ($check3=mysqli_num_rows($c_e)>0) {
													while ($row3=mysqli_fetch_array($c_e)) {
													echo'<h5><b>Total Communication Equipment: </b>';
													if($row3['total_c_e']==NULL){echo'<h4>None</h4>';}
													else{
				echo'								<br>'.$row3['total_c_e'].'</h5>';
													}
													}
												}
												$f_e = mysqli_query($conn, "SELECT SUM(total_amt) AS total_f_e FROM categories, items, forms, office WHERE categories.cat_id=items.cat_id AND office.form_id=forms.form_id AND items.form_id=forms.form_id AND office.off_id=items.office_id AND office.form_id=items.form_id AND forms.form_id='$fid' AND categories.cat_id='4'");
												if ($check4=mysqli_num_rows($f_e)>0) {
													while ($row4=mysqli_fetch_array($f_e)) {
													echo'<h5><b>Total Furniture Equipment: </b>';
													if($row4['total_f_e']==NULL){echo'<h4>None</h4>';}
													else{
				echo'								<br>'.$row4['total_f_e'].'</h5>';
													}
													}
												}
												$o_e = mysqli_query($conn, "SELECT SUM(total_amt) AS total_o_e FROM categories, items, forms, office WHERE categories.cat_id=items.cat_id AND office.form_id=forms.form_id AND items.form_id=forms.form_id AND office.off_id=items.office_id AND office.form_id=items.form_id AND forms.form_id='$fid' AND categories.cat_id='5'");
												if ($check5=mysqli_num_rows($o_e)>0) {
													while ($row5=mysqli_fetch_array($o_e)) {
													echo'<h5><b>Total Other Equipment: </b>';
													if($row5['total_o_e']==NULL){echo'<h4>None</h4>';}
													else{
				echo'								<br>'.$row5['total_o_e'].'</h5>';
													}
													}
												}
												$f_f = mysqli_query($conn, "SELECT SUM(total_amt) AS total_f_f FROM categories, items, forms, office WHERE categories.cat_id=items.cat_id AND office.form_id=forms.form_id AND items.form_id=forms.form_id AND office.off_id=items.office_id AND office.form_id=items.form_id AND forms.form_id='$fid' AND categories.cat_id='6'");
												if ($check6=mysqli_num_rows($f_f)>0) {
													while ($row6=mysqli_fetch_array($f_f)) {
														$total6=$row6['total_f_f'];
													echo'<h5><b>Total Furniture and Fixtures: </b>';
													if($row6['total_f_f']==NULL){echo'<h4>None</h4>';}
													else{
				echo'								<br>'.$row6['total_f_f'].'</h5>';
													}
													}
												}
												$of_e = mysqli_query($conn, "SELECT SUM(total_amt) AS total_of_e FROM categories, items, forms, office WHERE categories.cat_id=items.cat_id AND office.form_id=forms.form_id AND items.form_id=forms.form_id AND office.off_id=items.office_id AND office.form_id=items.form_id AND forms.form_id='$fid' AND categories.cat_id='7'");
												if ($check7=mysqli_num_rows($of_e)>0) {
													while ($row7=mysqli_fetch_array($of_e)) {
													echo'<h5><b>Total Office Equipment: </b>';
													if($row7['total_of_e']==NULL){echo'<h4>None</h4>';}
													else{
				echo'								<br>'.$row7['total_of_e'].'</h5>';
													}
													}
												}
												$it_p = mysqli_query($conn, "SELECT SUM(total_amt) AS total_it_p FROM categories, items, forms, office WHERE categories.cat_id=items.cat_id AND office.form_id=forms.form_id AND items.form_id=forms.form_id AND office.off_id=items.office_id AND office.form_id=items.form_id AND forms.form_id='$fid' AND categories.cat_id='8'");
												if ($check8=mysqli_num_rows($it_p)>0) {
													while ($row8=mysqli_fetch_array($it_p)) {
													echo'<h5><b>Total IT Peripherals: </b>';
													if($row8['total_it_p']==NULL){echo'<h4>None</h4>';}
													else{
				echo'								<br>'.$row8['total_it_p'].'</h5>';
													}
													}
												}
				echo'						</div>
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
		<button title="Add Form" onclick="document.getElementById('login').style.display='block'" class="login w3-btn" style="border-radius:50%;height:45px;background-color:#003471;outline:none;">&plus;</button>
		<form id="login" class="w3-modal" action="../php/add_form.php" method="POST">
			<div class="w3-modal-content w3-card-8 w3-animate-top" style="max-width:35%;">
				<div class="w3-container">
					<div class="w3-section">
						<label class="labels"><b>Add Document:</b></label>
						<div class="w3-input w3-margin-bottom">
							<input class="inputs" type="text" name="form" autocomplete="off" placeholder="Name of document" required>
						</div>
						<?php
							echo'<label class="labels"><b>Select Name:</b></label>
										<div class="w3-input w3-margin-bottom">
											<select type="text" name="name" style="margin-top:-20px;">';
							$query = "SELECT * FROM personnel";
							$result = mysqli_query($conn, $query);
							if ($sel = mysqli_num_rows($result)) {
								while ($array = mysqli_fetch_array($result)) {
									$id = $array['person_id'];
									$name = $array['person_name'];
									echo'<option value='.$id.'>'.$name.'</option>';
								}
							}
							echo'</select><br>
							</div>';
						?>
						<label class="labels"><b>Enter Date:</b></label>
						<div class="w3-input w3-margin-bottom">
							<input class="inputs" type="date" name="date" autocomplete="off" placeholder="Date Assumption">
						</div>
						<label class="labels"><b>Enter Designation Office:</b></label>
						<div class="w3-input w3-margin-bottom">
							<input class="inputs" type="text" name="office" autocomplete="off" placeholder="Office Designtation">
						</div>
					</div>
					<div class="w3-section">
						<?php
						$sql = "SELECT * FROM forms";
						$res = mysqli_query($conn, $sql);
						if ($chk = mysqli_num_rows($res) > 0) {
							if ($row = mysqli_fetch_array($res)) {
								$fid = $row['form_id'];
								echo'<input type="hidden" name="fid" value='.$fid.'></input>';
							}
							echo'<button class="w3-btn w3-green" type="submit" name="add">Add</button>';
						}else{
							echo'<button class="w3-btn w3-green" type="submit" name="add">Add</button>';
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