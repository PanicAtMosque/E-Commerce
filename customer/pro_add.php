<?php
require 'config.php';

// $name = $_POST['name'];
// $des = $_POST['des'];
$firm_id = $_POST['firm_id'];
$grp = $_POST['grp'];
$ty = $_POST['ty'];
$price = $_POST['price'];
$qty = $_POST['qty'];

$conn = connection();

$check = "SELECT * FROM `product` WHERE `pro_firmid` = $firm_id AND `pro_grpid` = $grp AND `pro_typeid` = $ty" ;
$check = $conn->query($check);
// echo $check->rowCount();
if ($check->rowCount() > 0) {
	echo "<span style='font-size:20px;color:red;' class=\"splash-description\">Product already exist.</span></br>";
	// $conn=null;
}else{
	$sql = "INSERT INTO `product` (`pro_typeid`, `pro_grpid`, `pro_firmid`, `pro_price`, `pro_qty`) VALUES ('$ty', '$grp', '$firm_id',$price, '$qty');";
	$conn = connection();
	$conn->query($sql);
	// $conn=null;
	echo "<span style='font-size:20px;color:green;' class=\"splash-description\">Product added.</span></br>";
}

$sql = "SELECT * FROM product p inner join category c on c.cat_id=p.pro_grpid inner join type t on t.ty_id=p.pro_typeid inner join customer_info i on i.customer_id=p.pro_firmid
ORDER BY cat_name ASC";
$data = $conn->query($sql);
$conn=null;

?>

<table class="table table-condensed table-hover table-bordered table-striped">
	<thead>
		<tr>
			<th><center>No.</center></th>
			<!-- <th><center>Name</center></th> -->
			<th><center>Customer Name</center></th>
			<!-- <th><center>Description</center></th> -->
			<th><center>Category</center></th>
			<th><center>Size / Ink</center></th>
			<th><center>Stock Price</center></th>
			<th><center>Seller Price</center></th>
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
			<td><?php echo ucwords($row['ty_name']); ?></td>
			<td><?php echo ucwords($row['pro_price']); ?></td>
			<td><input type="text" id="sell_price" value="<?php echo $row['pro_sell_price']; ?>" style="width: 80px; padding: 3px;" onkeyup="add_sell_price(this.value, this.id);">
			</td>
			<td><?php echo ucwords($row['pro_qty']); ?></td>
			<td><?php
			if ($row['pro_qty'] > 0) {
				echo "Available";
			}else{
				echo "<span style='color:red;'>Out of stock</span>";
			}
			?>
		<?php   } ?>
	</tbody>
</table>