<?php
require 'config.php';
$conn = connection();
$sql = "SELECT * FROM product p inner join category c on c.cat_id=p.pro_grpid inner join type t on t.ty_id=p.pro_typeid inner join customer_info i on i.customer_id=p.pro_firmid
ORDER BY cat_name ASC";
$data = $conn->query($sql);
$cat_dat = "SELECT * FROM category order by cat_name ASC";
$cat_dat = $conn->query($cat_dat);
$cat_dat1 = "SELECT * FROM category order by cat_name ASC";
$cat_dat1 = $conn->query($cat_dat1);
$firm_data = "SELECT * FROM customer_info order by customer_name ASC";
$firm_data = $conn->query($firm_data);
$firm_data1 = "SELECT * FROM customer_info order by customer_name ASC";
$firm_data1 = $conn->query($firm_data1);
$conn=null;

?>
<!--product modal open -->
<div id="form-product" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-dark">
  <div class="modal-dialog custom-width" style="height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><strong>ADD NEW PRODUCT</strong></h3>
      </div>
      <div class="modal-body">
            <!-- <div class="form-group">
              <label>Product Name</label>
              <input type="text" placeholder="enter product name" id="pro_name" required="" class="form-control input-xs parsley-error">
            </div>
            <div class="form-group">
              <label>Product Description</label>
              <input type="text" placeholder="enter product description" id="pro_des" required="" class="form-control input-xs parsley-error">
            </div> -->
           <div class="form-group">
              <label>Select Customer</label>
              <select class="form-control input-xs" id="pro_firmid" required="" onchange="get_mea()">
                <option value="">select customer</option>                
                <?php foreach ($firm_data as $fd) { ?>
                <option value="<?php echo $fd['customer_id']; ?>"><?php echo ucwords($fd['customer_name']); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Choose Category</label>
              <select class="form-control input-xs" id="pro_grp" required="" onchange="get_mea()">
                <option value="">select group</option>                
                <?php foreach ($cat_dat as $row) { ?>
                <option value="<?php echo $row['cat_id']; ?>"><?php echo ucwords($row['cat_name']); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Choose Size / Ink</label>
              <span id="mea_data">
                <select class="form-control input-xs" id="pro_ty" required=""></select>
              </div>
              <div class="form-group">
                <label>Price</label>
                <input type="number" min="0.00" max="" step="0.01" id="pro_price" placeholder="enter product price" required="" class="form-control input-xs">
              </div>
              <div class="form-group">
                <label>Quantity</label>
                <input type="number" min="0.00" max="" step="0.01" id="pro_qty" placeholder="enter quantity of product" required="" class="form-control input-xs">
              </div>          
            </div>
            <div class="modal-footer">
              <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
              <button type="submit" onclick="add_pro();" data-dismiss="modal" class="btn btn-dark md-close">Proceed</button>
            </div>
          </div>
        </div>
      </div>
      <!--product modal close -->
      <!--category modal open-->
      <div id="form-category" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-danger">
      <div class="modal-dialog custom-width">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
            <h3 class="modal-title"><strong>ADD NEW CATEGORY</strong></h3>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Category Name</label>
              <input type="text" id="acat_name" placeholder="enter category name" required="" class="form-control input-xs parsley-error">
            </div>
			<div class="form-group">
              <label>Category Type</label>
              <input type="text" id="acat_des" placeholder="enter category type" required="" class="form-control input-xs parsley-error">
            </div>
            
                        
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
            <button type="submit" onclick="add_cat();" data-dismiss="modal" class="btn btn-danger md-close">Proceed</button>
          </div>
        </div>
      </div>
    </div>
      <!-- category modal close -->
      <!-- measurement modal open -->
      <div id="form-measurement" tabindex="-1" role="dialog" class="modal fade colored-header">
      <div class="modal-dialog custom-width">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #FBBC05;">
            <button type="button"  data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
            <h3 class="modal-title"><strong>ADD NEW SIZE / INK</strong></h3>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Size or ink</label>
              <input type="text" id="ty_name" placeholder="enter size or ink" required="" class="form-control input-xs parsley-error">
            </div>
            <div class="form-group">
              <label>Choose Type</label>
               <select class="form-control input-xs" id="ty_grp" required="">
                <option value="">Select type</option>                
                <?php foreach ($cat_dat1 as $row) { ?>
                  <option value="<?php echo $row['cat_id']; ?>"><?php echo ucwords($row['cat_name']); ?></option>
                <?php } ?>
              </select>
            </div>           
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
            <button type="submit" onclick="add_ty();" data-dismiss="modal" class="btn btn-warning md-close">Proceed</button>
          </div>
        </div>
      </div>
    </div>
    <!-- measurement modal close -->
    <!-- firm modal open -->
    <div id="form-firm" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-dark">
      <div class="modal-dialog custom-width" style="height:200px;">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #00796B;">
            <h3 class="modal-title"><strong>ADD NEW CUSTOMER</strong></h3>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Customer ID</label>
              <input type="text" placeholder="enter id" id="customer_id" class="form-control input-xs parsley-error" required="required">
            </div>
            <div class="form-group">
              <label>Customer Name</label>
              <input type="text" placeholder="enter name" id="customer_name" class="form-control input-xs parsley-error" required="required">
            </div>
            <div class="form-group">
              <label>Phone number</label>
              <input type="number" placeholder="enter phone number" id="phone_no" class="form-control input-xs parsley-error" required="required">
            </div>
            <div class="form-group">
              <label>Address</label>
              <input type="text" placeholder="enter address" id="customer_add" class="form-control input-xs parsley-error" required="required">
            </div>                   
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
            <button type="submit" onclick="add_firm();" data-dismiss="modal" class="btn btn-dark md-close">Proceed</button>
          </div>
        </div>
      </div>
    </div>
    <!-- firm modal close -->
    <div class="col-md-4">
      <div class="panel panel-border-color" style="border-top-color: #1f216d;">
        <div class="panel-heading"><strong>PRODUCTS DETAILS</strong></div>
        <div class="panel-body">
          <div class="xs-mt-10 xs-mb-10">
            <center>
              <button class="btn btn-space btn-big" style="background-color: #1f216d; color: white;" id="pro" onclick="callPro(this.id);"><i class="icon mdi mdi-view-list"></i> VIEW </button>
            </center>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-border-color" style="border-top-color: #331419;">
        <div class="panel-heading"><strong>CATEGORY DETAILS</strong></div>
        <div class="panel-body">
          <div class="xs-mt-10 xs-mb-10">
            <center>
              <!--<button data-toggle="modal" data-target="#form-category" class="btn btn-space btn-big" style="background-color: #331419; color: white;"><i class="icon mdi mdi-shopping-cart-plus"></i> ADD </button> -->
              <button class="btn btn-space btn-big" style="background-color: #331419; color: white;" id="cat" onclick="callPro(this.id);"><i class="icon mdi mdi-view-list"></i> VIEW </button>
            </center>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-border-color" style="border-top-color: #201f23;">
        <div class="panel-heading"><strong>STUFF DETAILS</strong></div>
        <div class="panel-body">
          <div class="xs-mt-10 xs-mb-10">
            <center>
              <button class="btn btn-space btn-big" style="background-color: #201f23; color: white;" id="ty" onclick="callPro(this.id);"><i class="icon mdi mdi-view-list"></i> VIEW </button>
            </center>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-border-color panel-border-color-primary" style="border-top-color: #009688;">
        <div class="panel-heading"><strong>CUSTOMER DETAILS</strong></div>
        <div class="panel-body">
          <div class="xs-mt-10 xs-mb-10">
            <center>
              <button class="btn btn-space btn-big" style="background-color: #009688; color: white;" id="firm" onclick="callPro(this.id);"><i class="icon mdi mdi-view-list"></i> VIEW </button>
            </center>
          </div>
        </div>
      </div>
    </div>
    <!--<div class="col-md-4">
      <div class="panel panel-border-color panel-border-color-primary" style="border-top-color: #9A1750;">
        <div class="panel-heading"><strong>SELLER BILLING DETAILS</strong></div>
        <div class="panel-body">
          <div class="xs-mt-10 xs-mb-10">
            <center>
              <button class="btn btn-space btn-big" style="background-color: #9A1750; color: white;" id="sbill" onclick="callPro(this.id);"><i class="icon mdi mdi-shopping-cart-plus"></i> ADD </button>
              <button class="btn btn-space btn-big" style="background-color: #9A1750; color: white;" id="show_seller_bill" onclick="callPro(this.id);"><i class="icon mdi mdi-view-list"></i> VIEW </button>
            </center>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-border-color panel-border-color-primary" style="border-top-color: #5d001e;">
        <div class="panel-heading"><strong>STOCK BILLING DETAILS</strong></div>
        <div class="panel-body">
          <div class="xs-mt-10 xs-mb-10">
            <center>
              <button class="btn btn-space btn-big" style="background-color: #5d001e; color: white;" id="bill" onclick="callPro(this.id);"><i class="icon mdi mdi-shopping-cart-plus"></i> ADD </button>
              <button class="btn btn-space btn-big" style="background-color: #5d001e; color: white;" id="sb" onclick="callPro(this.id);"><i class="icon mdi mdi-view-list"></i> VIEW </button>
            </center>
          </div>
        </div>
      </div>
    </div>


<!-- add product function -->
<script type="text/javascript">
 function add_pro()
 {
    // var name = $('#pro_name').val();
    // var des = $('#pro_des').val();
    var customer_id = $('#pro_firmid').val();
    var grp = $('#pro_grp').val();
    var ty = $('#pro_ty').val();
    var price = $('#pro_price').val();
    var cgst = $('#cgst').val();
    var igst = $('#igst').val();
    var sgst = $('#sgst').val();
    var qty = $('#pro_qty').val();
    // alert(qty);
    $.ajax({
      type: "POST",
      url: 'pro_add.php',
      data: {customer_id:customer_id,grp:grp,ty:ty,price:price,cgst:cgst,igst:igst,sgst:sgst,qty:qty},
      success:function(msg) {
             // alert(msg);
             $('#srch_pro').html(msg);
           }
         });
    window.location = "index.php";
  }
</script>
<!-- add category function -->
<script>
  function add_cat()
  {
    var name = $('#acat_name').val();
    var des = $('#acat_des').val();
    $.ajax({
      type: "POST",
      url: 'cat_add.php',
      data: {name:name,des:des},
      success:function(msg) {
            //alert(msg);
            $('#srch_cat').html(msg);
         }
    });
    window.location = "cat.php";
  }
</script>
<!-- add measurement function -->
<script>
  function add_ty()
  {
    var name = $('#ty_name').val();
    var grp = $('#ty_grp').val();
    // alert(grp);
    $.ajax({
      type: "POST",
      url: 'ty_add.php',
      data: {name:name,grp:grp},
      success:function(msg) {
            //alert(msg);
            $('#srch_ty').html(msg);
         }
    });
  }
</script>
<!-- add firm function -->
<script>
  function add_firm()
  { 
    var id = $('#customer_id').val();
    var name = $('#customer_name').val();
    var phone = $('#phone_no').val();
    var address = $('#customer_add').val();
    // var grp = $('#firm_grp').val();
    // alert(phone);
    // alert(address);
    $.ajax({
      type: "POST",
      url: 'firm_add.php',
      data: {id:id,name:name,phone:phone,address:address},
      success:function(msg) {
             // alert(msg);
            $('#srch_firm').html(msg);
         }
    });

  }
</script>
<!-- measurement function -->
<script>
  function get_mea()
  {
    var grp = $('#pro_grp').val();
    var firm = $('#pro_firmid').val();
    // alert(grp);
    $.ajax({
      type: "POST",
      url: 'get_pro_grp.php',
      data: {grp:grp,firm:firm},
      success:function(msg) {
            // alert(msg);
            $('#mea_data').html(msg);
         }
    });
  }