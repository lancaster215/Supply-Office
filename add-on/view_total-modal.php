	<div id="view_total" class="w3-modal">
		<div class="w3-modal-content" style="width:700px;">
			<header class="w3-container w3-green">
				<span onclick="document.getElementById('view_total').style.display='none'" class="w3-closebtn">&times;</span>
				<center><h3>Total Summarization</h3></center>
			</header>
			<br>
			<table style="width:90%;margin-left:5%;">
				<?php 
				$count_cat = mysqli_query($conn,"SELECT COUNT(*) AS num_cat FROM categories");
				while ($row = mysqli_fetch_assoc($count_cat)){
					$num_cat = $row['num_cat'];
					$i = '1';
				}
				while ($i <= $num_cat){
					$total_price = mysqli_query($conn,"SELECT SUM(total_amt) AS totalp FROM items WHERE cat_id = '$i' AND office_id='$fid'");
					$sel_cat = mysqli_query($conn,"SELECT cat_name FROM categories WHERE cat_id= '$i'");
					$show_item = mysqli_query($conn,"SELECT * FROM items WHERE cat_id='$i' AND office_id='$fid'");
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
						echo '<td>'.$categ_name.'</td>'; 
						echo '<td>Total: <span>'.$totalp.'</span><br></td>';}
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
				echo '<td><hr><b>TOTAL: '.$sup_total.' </b></td>'; 
				?></tr>
			</table>
		</div>
	</div>
</div>