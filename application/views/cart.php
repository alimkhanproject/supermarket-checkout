<!DOCTYPE html>
<html>
<head>
<title>Supermarket Checkout: Cart</title>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>  
</head>
<body>

<?php $this->load->view('common/header'); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Unit Price</th>
                        <th class="text-center">Sub-Total</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                $cart_items = $this->cart->contents();

                if(!empty($cart_items))
                {
                    foreach ($cart_items as $key => $row) 
                    {
                ?>
                    <tr id="tr_row_id<?php echo $key; ?>">
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#"><?php echo $row['name']; ?></a></h4>
                                <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <input type="number" class="form-control" id="quantity<?php echo $row['product_id']; ?>" name="quantity" value="<?php echo $row['qty']; ?>">
                        <br>
                        <button type="button" class="btn btn-primary" onclick="add_cart_item('<?php echo $row['product_id']; ?>');">
                            Update
                        </button>

                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>$<?php echo $row['price']; ?></strong>
                        
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong id="each_sub_total<?php echo $row['product_id']; ?>">$<?php echo number_format($row['each_sub_total'], 2, '.', ''); ?></strong></td>
                        <td class="col-sm-1 col-md-1">
                        <button type="button" class="btn btn-danger" onclick="remove_cart_item('<?php echo $key; ?>');">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button></td>
                    </tr>                
                <?php
                    }
                }
                ?>
                    
                <?php
                $sub_total = getTotalPrice();
                ?>                    
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong id="sub_total">$<?php echo number_format($sub_total, 2, '.', ''); ?></strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Shipping Charge</h5></td>
                        <td class="text-right"><h5><strong>$0.00</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong id="total">$<?php echo number_format($sub_total, 2, '.', ''); ?></strong></h3></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

<script type="text/javascript">

$(document).ready(function(){
    $("#cart_li").addClass('active');
});

function add_cart_item(product_id)
{   
    var quantity = $("#quantity"+product_id).val();

    var url = '<?php echo base_url(); ?>cart/add_cart';
    var dataString = 'product_id='+product_id+'&quantity='+quantity;

    $.ajax({
    type:"POST",
    url:url,
    data:dataString,
    dataType:"json",
    success:function(response)
    {
        if(response.status == 0)
        {
            alert(response.message);
        }      
        else
        {
            $("#add_cart_button_"+product_id).html('Added');
            $("#each_sub_total"+product_id).html('$'+response.each_sub_total);

            $("#sub_total").html('$'+response.total);
            $("#total").html('$'+response.total);
        }

    }
    });
}    


function remove_cart_item(cart_item_id)
{
    var dataString = 'cart_item_id='+cart_item_id;
    var url = '<?php echo base_url(); ?>cart/remove_cart_item';

    $.ajax({
    type:"POST",
    data: dataString,
    url: url,
    dataType:'json',
    success:function(response)
    {
    $("#tr_row_id"+cart_item_id).remove();

    $("#sub_total").html(response.sub_total);
    $("#total_gst").html(response.total_gst);

    $("#total").html(response.total);

    }

    });
} 
</script>