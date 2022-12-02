<!DOCTYPE html>
<html>
<head>
<title>Supermarket Checkout: Home</title>

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
                        <th class="text-center">Price</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($product_list))
                {
                    foreach ($product_list as $row) 
                    {
                ?>
                    <tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#"><?php echo $row->name; ?></a></h4>
                                <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <input type="number" id="quantity<?php echo $row->id; ?>" class="form-control" value="1">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>$<?php echo $row->unit_price; ?></strong></td>
                        
                        <td class="col-sm-1 col-md-1">
                        <button type="button" class="btn btn-primary" id="add_cart_button_<?php echo $row->id; ?>" onclick="add_cart_item('<?php echo $row->id; ?>')">Add to Cart</button></td>
                    </tr>                
                <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

<script type="text/javascript">

$(document).ready(function(){
    $("#home_li").addClass('active');
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

            setTimeout(()=>{ $("#add_cart_button_"+product_id).html('Add to Cart') }, 3000)
        }

    }
    });
}     
</script>