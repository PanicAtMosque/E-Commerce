<?php 

require 'config.php';

$condition = "";

$conn = connection();
// echo $_POST['name']; die;
if(isset($_POST['name']) && $_POST['name']!=""){
	$condition.=" and customer_name like '".$_POST['name']."%'";
}
$sql = "SELECT * FROM customer_info WHERE 0=0 $condition ORDER BY customer_name ASC";
$data = $conn->query($sql);
$conn=null;
?>

<table class="table table-condensed table-hover table-bordered table-striped">
	<thead>
		<tr>
	                <th><center>No.</center></th>
			<th><center>No.ID</center></th>
			<th><center>Name</center></th>
			<th><center>Phone</center></th>
			<th><center>Address</center></th>
		</tr>
	</thead>
	<tbody style="color:black;">
		<?php $s=0;
		foreach ($data as $row){ $s++; ?>
		<tr>
			<td><center><?php echo $s; ?></center></td>
			<td><?php echo ucwords($row['customer_id']); ?></td>
			<td><?php echo ucwords($row['customer_name']); ?></td>
			<td><?php echo ucwords($row['phone_no']); ?></td>
			<td><?php echo ucwords($row['customer_add']); ?></td>
		</tr>
		<?php   } ?>
	</tbody>
</table>