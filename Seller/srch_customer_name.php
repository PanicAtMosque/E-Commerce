<?php 

require 'config.php';

$condition = "";

$conn = connection();
// echo $_POST['name']; die;
if(isset($_POST['name']) && $_POST['name']!=""){
	$condition.=" and i.customer_name like '".$_POST['name']."%'";
}
$sql = "SELECT * FROM firm f WHERE $condition ORDER BY firm_name ASC";
$data = $conn->query($sql);
$conn=null;
?>

<table class="table table-condensed table-hover table-bordered table-striped">
	<thead>
		<tr>
			<th><center>No.</center></th>
			<th><center>Name</center></th>
			<th><center>Description</center></th>
		</tr>
	</thead>
	<tbody style="color:black;">
		<?php $s=0;
		foreach ($data as $row){ $s++; ?>
		<tr>
			<td><center><?php echo $s; ?></center></td>
			<td><?php echo ucwords($row['customer_name']); ?></td>
			<td><?php echo ucwords($row['firm_des']); ?></td>
		
		</tr>
		<?php   } ?>
	</tbody>
</table>