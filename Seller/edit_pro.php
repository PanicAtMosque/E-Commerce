
<?php
$id = $_REQUEST['id'];
// echo $id;

require 'config.php';
$conn = connection();
$pro_info = "SELECT * FROM `product` WHERE `pro_id` = $id";
$inf = $conn->query($pro_info);



?>
<?php foreach ($inf as $row) ?>


<div class="form-group">
	<label>Price</label>
	<input type="number" min="0.00" max="" step="0.01" id="edit_price" placeholder="enter product price" required="" class="form-control input-xs" value="<?php echo $row['pro_price']; ?>">
</div>

</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
	<button type="submit" onclick="add_editpro(<?php echo $row['pro_id']; ?>);" data-dismiss="modal" class="btn btn-primary md-close">Proceed</button>
</div>



<script>
	function add_editpro(id)
	{
		var price = $('#edit_price').val();
		

		// alert(id);
		$.ajax({
			type: "POST",
			url: 'add_editpro.php',
			data: {id:id,price:price},
			success:function(msg) {
				// alert(msg);
				$('#srch_pro').html(msg);
			}
		});

	}
</script> 