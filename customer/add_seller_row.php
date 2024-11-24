<?php
require 'config.php';
// echo $_REQUEST['customer_info']; die;
$count = $_POST['count'];
$conn = connection();
$firm = "SELECT customer_id,customer_name FROM customer_info ORDER BY customer_name ASC";
$fdata = $conn->query($firm);

$sql = "SELECT cat_id,cat_name FROM product p inner join category c on c.cat_id=p.pro_grpid inner join type t on t.ty_id=p.pro_typeid inner join customer_info i on i.customer_id = p.pro_firmid
    ORDER BY cat_name ASC";
$data = $conn->query($sql);

?>

	<td><center><?php echo $count+1; ?></center></td>
	<td>
		<select class="form-control input-xs chosen-select" id="bill_f_<?php echo $count; ?>" name="bill_f_<?php echo $count; ?>" onchange="get_seller_cat(this.value,this.id);" required="">
			<option value="">Select Customer</option>                
			<?php foreach ($fdata as $row) { ?>
			<option value="<?php echo $row['customer_id']; ?>"><?php echo ucwords($row['customer_name']); ?></option>
			<?php } ?>
		</select>
	</td>
	<td>
		<select class="form-control input-xs chosen-select" id="bill_p_<?php echo $count; ?>" name="bill_p_<?php echo $count; ?>" onchange="get_seller_size(this.value,this.id);" required="">
			<option value="">Select Product</option>                
			<?php foreach ($data as $row) { ?>
			<option value="<?php echo $row['cat_id']; ?>"><?php echo ucwords($row['cat_name']); ?></option>
			<?php } ?>
		</select>
	</td>
	
	<td>
		<select class="form-control input-xs chosen-select" id="bill_s_<?php echo $count; ?>" name="bill_s_<?php echo $count; ?>" onchange="get_seller_pde(this.id);" required="">                  
			<option value="">Size</option>
		</select>
	</td>
	<td style="width: 100px;">
		<input type="number" style="width: 100px;" min="1" max="???" step="1" id="bill_q_<?php echo $count; ?>" required="" name="bill_q_<?php echo $count; ?>" onkeyup="calc(this.id,this.value);" class="form-control input-xs" required="">
	</td>
	<td id="bill_a_<?php echo $count; ?>">
		<!-- Available&nbsp;: -->
	</td>	
	<td><center>
		<input type="number" name="to_amt_<?php echo $count; ?>" id="to_amt_<?php echo $count; ?>" value="" style="width: 100px;">
		</center>
	</td>
