<?php 
    $payment_settings = $this->admin_model->get_payment_settings();
    if($this->session->userdata('user_id')){
        $my_items = $this->product_model->get_my_product();
    }else{
        $my_items = (isset($_SESSION['cart']))?$_SESSION['cart']:[];
    }
    $sales_tax = number_format($payment_settings['tax_rate']/100, 2, '.', '');
?>
<!-- Payment Settings -->
<input type="hidden" id="paypal_sandbox" value="<?=$payment_settings['paypal_sandbox'];?>">
<input type="hidden" id="paypal_client_id" value="<?=$payment_settings['paypal_client_id'];?>">

<ul class="list-group">
    <div id="product_purchased">
    <li class="list-group-item active"><i class="fa fa-shopping-cart"></i> Your Order
        <a href="<?=base_url();?>cart" class="update-cart-btn">
            Update Cart
        </a>
    </li>
    <!-- Item Headings -->
    <li class="list-group-item p-grp-title" style="border-bottom: 3px solid #444;">
        <div class="row">
            <div class="col-md-1 col-sm-1 col-xs-1 text-center"><b>ID</b></div>
            <div class="col-md-3 col-sm-3 col-xs-3"><b>PRODUCT</b></div>
            <div class="col-md-3 col-sm-3 col-xs-3"><b>PRICE</b></div>
            <div class="col-md-2 col-sm-2 col-xs-2"><b>QTY</b></div>
            <div class="col-md-3 col-sm-3 col-xs-3"><b>SUBTOTAL</b></div>

            

        </div>
    </li>
    <!-- Display cart items -->
    <?php $total=0; 
    $subtotal = 0;
    $sub_total = 0;
    foreach($my_items as $i){
        $subtotal = $i['item_price'] * $i['qty'];
        $total+= $subtotal;     
        $sub_total += $subtotal;
        $item_list[] = array(
            'name'        => $i['item_title'],
            'description' => $i['item_title'],
            'quantity'    => $i['qty'],
            'currency'    => 'USD',
            'price'       => $i['item_price']
        ); 
    ?>
        <li class="list-group-item cart-items">
            <div class="row">
                <div class="col-md-1 col-sm-1 col-xs-1 text-center"><?=$i['item_id'];?></div>
                <div class="col-md-3 col-sm-3 col-xs-3"><a href="<?=base_url();?>product_detail/<?=$i['item_id'];?>" class="text-info"><?=$i['item_title'];?></a> x 1</div>
                <div class="col-md-3 col-sm-3 col-xs-3">$<?=$i['item_price'];?></div>
                <div class="col-md-2 col-sm-2 col-xs-2"><?=$i['qty'];?></div>
                <div class="col-md-2 col-sm-3 col-xs-3">$<?=$subtotal;?></div>

            </div>
        </li>
    <?php 
   }$my_item_list = json_encode($item_list);?>
    <li class="list-group-item" style="border-top: 2px solid #444;">
        <div class="row">
            <div class="col-md-1 col-sm-1 col-xs-1"></div>
            <div class="col-md-3 col-sm-3 col-xs-3"><b>Subtotal</b></div>
            <div class="col-md-7 col-sm-7 col-xs-7 text-right">$<?=number_format($sub_total, 2, '.', '');?></div>
        </div>
    </li>
    </div>
    <script>var services_desc = <?= json_encode($this->config->item('ups')['services']); ?>;</script>
    <?php if(isset($tax['has_tax'])){ ?>
        <div id="hasTax">
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-3 col-sm-3 col-xs-3"><b>Sales Tax(<?=(number_format($tax['tax_rate'], 3, '.', '')*100);?>%)</b></div>
                <div class="col-md-7 col-sm-7 col-xs-7 text-right">$<?=number_format($tax['amount_to_collect'], 2, '.', '');?></div>
            </div>
        </li>
        <?php if(isset($shipping)){ ?>
         <!-- Shipping Rates -->
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-1 col-sm-1 col-xs-2"></div>
                <div class="col-md-3 col-sm-3 col-xs-3"><b>Shipping rate(<?= $this->config->item('ups')['services'][$shipping['code']] ?>)</b></div>
                <div class="col-md-7 col-sm-7 col-xs-7 text-right">$<?=number_format($shipping['amount'], 2, '.', '');?></div>
            </div>
        </li>
        <?php } ?>
        
        <?php 
            $total = number_format($tax['amount_to_collect']+$sub_total, 2, '.', '');
            $total_val = $tax['amount_to_collect']+$sub_total;
            if(isset($shipping)){
                $total = number_format($tax['amount_to_collect']+$sub_total+$shipping['amount'], 2, '.', '');
                $total_val = $tax['amount_to_collect']+$sub_total+$shipping['amount'];   
            }
        ?>
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-3 col-sm-3 col-xs-3"><b>Total</b></div>
                <div class="col-md-7 col-sm-7 col-xs-7 text-right" id="display_total">$<?=$total;?></div>
            </div>
        </li>
        </div>
        <input type="hidden" id="total_val" value="<?=$total_val?>">
        <input type="hidden" id="sub_total" name="sub_total" value="<?=number_format($sub_total, 2, '.', '');?>">
        <input type="hidden" id="tax_amount" name="tax_amount" value="<?=number_format($tax['amount_to_collect'], 2, '.', '');?>">
        <input type="hidden" id="ship_rate" name="ship_rate" value="<?= isset($shipping) ? $shipping['amount'] : 0 ?>">
        <input type="hidden" id="service_code" name="service_code" value="<?= isset($shipping) ? $shipping['code'] : '' ?>">
        <input type="hidden" id="tax_rate" name="tax_rate" value="<?=(number_format($tax['tax_rate'], 3, '.', ''));?>">
        <input type="hidden" id="total_amount" name="total_amount" value="<?=$total;?>">
        <textarea name="item_list" id="item_list" cols="30" rows="10" class="d-none"><?=$my_item_list;?></textarea>
    <?php } ?>
</ul>
<input class="d-none" id="error_text" />