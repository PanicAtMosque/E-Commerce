<?php
$id = $_REQUEST['id'];
// echo $id;

// die;
$price = $_REQUEST['price'];
// echo $id;
// echo $price;
// die;

require 'config.php';
$conn = connection();
$pro_info = "UPDATE `product` SET `pro_price` = $price WHERE `pro_id` = $id";
if ($conn->query($pro_info) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$inf = $conn->query($pro_info);
// print_r($inf);
// die;

$sql = "SELECT * FROM product p inner join category c on c.cat_id=p.pro_grpid inner join type t on t.ty_id=p.pro_typeid inner join customer_info i on i.customer_id=p.pro_firmid
     WHERE 0=0 ORDER BY cat_name ASC";
$data = $conn->query($sql);
$conn=null;

?>


<table class="table table-condensed table-hover table-bordered table-striped">
	<thead>
		<tr>
			<th><center>No.</center></th>
			<!-- <th><center>Name</center></th> -->
			<th><center>Customer Name</center></th>
			<th><center>Category</center></th>
			<th><center>Price</center></th>
			<th><center>Quantity</center></th>
			<th><center>Status</center></th>
			
		</tr>
	</thead>
	<tbody style="color:black;">
		<?php $s=0;
		foreach ($data as $row){ $s++; ?>
		<tr>
			<td><center><?php echo $s; ?></center></td>
			<!-- <td><?php echo ucwords($row['pro_name']); ?></td> -->
			<td><?php echo ucwords($row['customer_name']); ?></td>
			<!-- <td><?php echo ucwords($row['pro_des']); ?></td> -->
			<td><?php echo ucwords($row['cat_name']); ?></td>
			<td><?php echo ucwords($row['pro_price'	]); ?></td>
			<td><?php echo ucwords($row['pro_qty']); ?></td>
			<td><?php
			if ($row['pro_qty'] > 0) {
				echo "Available";
			}else{
				echo "<span style='color:red;'>Out of stock</span>";
			}
			?></td
		<?php   } ?>
	</tbody>
</table>