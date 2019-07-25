<?php

include_once 'db_include.php';
$nm = mysqli_real_escape_string($conn, $_GET['xm']);
$output = '';

$sql = "SELECT * FROM personnel WHERE person_name LIKE ('$nm%') ";
//$sql2 = "SELECT * FROM stocks, categories WHERE des LIKE '%".$_POST["search"]."%'";

$result = mysqli_query($conn, $sql);
//$result2 = mysqli_query($conn, $sql2);

	
	if ($nm ==null || $nm == "") {
		
	}
 	else if (mysqli_num_rows($result) > 0) {
 	  	echo '<i class="fa fa-circle" style="color: red;"> Invalid </i>';

		}
		else{
		echo "<i class='fa fa-check-square' style='color: green;'> Available </i>";
		}


/*	else if (mysqli_num_rows($result2) > 0){
	while ($row = mysqli_fetch_array($result2)) {
		$i_count++;
		$cat_name = $row['cat_name'];
		$output .='
		
				<td>'.$cat_name.'</td>
				<td>'.$i_count.'</td>
				<td>'.$row['article'].'</td>
				<td>'.$row['des'].'</td>
				<td>'.$row['date_acquire'].'</td>
				<td>'.$row['prop_num'].'</td>
				<td>'.$row['unit_measure'].'</td>
				<td>'.$row['unit_value'].'</td>
				<td>'.$row['total_amt'].'</td>
				<td>'.$row['qty_prop_card'].'</td>
				<td>'.$row['qty_phys_count'].'</td>
			';
		}	
		
	}  */
?>