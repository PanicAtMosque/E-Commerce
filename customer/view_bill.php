<!-- VIEW BUTTON OF STOCK -->
<?php
$id = $_REQUEST['id'];

require 'config.php';
require 'conversion.php';
$conn = connection();
$bill_info = "SELECT * FROM `bill_records` WHERE `bill_id` = $id";
$inf = $conn->query($bill_info);
foreach ($inf as $row) {
	$uid = $row['bill_uid'];
	
}
$pro = "SELECT i.customer_name,c.cat_name,t.ty_name,bp.bp_qty,bp.bp_price,p.pro_price FROM `bill_products` bp INNER JOIN product p ON p.pro_id = bp.bp_pid INNER JOIN category c ON c.cat_id=p.pro_grpid INNER JOIN type t ON t.ty_id=p.pro_typeid INNER JOIN customer_info i ON i.customer_id= p.pro_firmid WHERE bp.bp_uid = '$uid'";
$detail = $conn->query($pro);

?>

<table border="1" class="table table-condensed table-bordered" width="100%">
	<tr>
		<td colspan="7"><br>
			<h1 style="margin-top: -3%;"><center><strong>shopbysyasya</strong></center></h1>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<strong>&nbsp;Bill No.&nbsp;:&nbsp;<?php echo $row['bill_id']; ?></strong>
		</td>
		<td colspan="3">
			<strong>&nbsp;M/S&nbsp;:&nbsp;<?php echo ucwords($row['bill_name']); ?></strong>
		</td>
		<td colspan="2">
			<strong>&nbsp;Date&nbsp;:&nbsp;<?php echo $row['bill_entrydt']; ?></strong>
		</td>
	</tr>
	<tr>
		<th><strong><center>No.</center></strong></th>
		<th><strong><center>CUSTOMER NAME</center></strong></th>
		<th><strong><center>DESCRIPTION</center></strong></th>
		<th><strong><center>SIZE</center></strong></th>
		<th><strong><center>QUANTITY</center></strong></th>
		<th><strong><center>RATE</center></strong></th>
		<th><strong><center>AMOUNT</center></strong></th>
	</tr>
	<?php $s=0; foreach ($detail as $key => $value) { $s++; ?>
			
	<tr>
		<td><center><?php echo $s; ?></center></td>
		<td>&nbsp;<?php echo ucwords($value['customer_name']); ?></td>
		<td>&nbsp;<?php echo ucwords($value['cat_name']); ?></td>
		<td><center><?php echo ucwords(strtoupper($value['ty_name'])); ?></center></td>
		<td><center><?php echo $value['bp_qty']; ?></center></td>
		<td><center><?php echo $value['bp_price']; ?></center></td>
		<td><center><?php echo $value['bp_price'] * $value['bp_qty'];?></center></td>
	</tr>

	<?php	}	?>
	<tr>
		<td colspan="5"><strong>RM In Words&nbsp;:&nbsp;<?php echo convertNumberToWordsForIndia($row['bill_amt']+$row['bill_tchrg']); ?></strong></td>
		<td colspan="2"><strong>Total&nbsp;:&nbsp;<?php echo $row['bill_amt']+$row['bill_tchrg']."&nbsp;/-"; ?></strong></td>
	</tr>
	<tr>
		<td colspan="2"><strong>Transport Charge&nbsp;:&nbsp;<?php echo $row['bill_tchrg']; ?></strong></td>
		<td colspan="2"><strong>Transport no&nbsp;:&nbsp;<?php echo $row['bill_tno']; ?></strong></td>
	</tr>
</table>