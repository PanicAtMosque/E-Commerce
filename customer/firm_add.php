<?php
require 'config.php';

$id = $_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$conn = connection();

$sql = "INSERT INTO `customer_info` (`customer_id`, `customer_name`, `phone_no`, `customer_add`) VALUES ('$id','$name','$phone','$address');";
$conn = connection();
$conn->query($sql);

$sql = "SELECT * FROM `customer_info` ORDER BY `customer_name` ASC";
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
			<th></th>
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
			<td><a href="delete-firm.php?customer_id=<?php echo $row["customer_id"];?>" class="btn btn-space md-trigger btn-danger" style="float: right;"><i class="icon icon-left mdi mdi-close-circle"></i></a></td> 
		</tr>
		<?php   } ?>
	</tbody>
</table>
