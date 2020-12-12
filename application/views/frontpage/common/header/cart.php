<?php 
    $total=0;
    $subtoTal = 0;
    if($this->session->userdata('user_id')){
        $my_items = $this->product_model->get_my_product();
    }else{
        $my_items = (isset($_SESSION['cart']))?$_SESSION['cart']:[];
    }
?>
<img src="<?=base_url();?>assets/front-office/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
<span class="header-icons-noti cart-items-count"><?=count($my_items);?></span>
<!-- Header cart noti -->
<div class="header-cart header-dropdown">
    <ul class="header-cart-wrapitem cart-items">
        
        <?php if($my_items){ 
            
            foreach($my_items as $i){ ?>
            <?php 
                $subtoTal =  ($i['item_price'] * $i['qty']);
                $total += $subtoTal;
            ?>
            <li class="header-cart-item cartItem">
                <div onclick="remove_to_cart(<?=$i['item_id'];?>, 1)" class="header-cart-item-img">

                    <img src="<?=base_url();?>assets/back-office/images/products/<?=$i['item_image'] ? $i['item_image'] : 'default.png';?>" alt="Product Image">
                </div>
                <div class="header-cart-item-txt">
                    <a href="<?=base_url();?>product_detail/<?=$i['item_id'];?>" class="header-cart-item-name"><?=$i['item_title'];?>
                    </a>
                    <span class="header-cart-item-info" priceAttr="<?=$i['item_price'];?>">
                        Price: <?=$i['item_price'];?>
                    </span>
                    <div class="header-cart-item-info qtyCart" p-qty="<?=$i['qty_left']?>" pid="<?=$i['item_id'];?>">
                        Qty: <span class="qtyItem qty-<?=$i['item_id']?>"> <?=$i['qty'];?> </span> <a class="btn btn-success btn-xs text-white ml-3 qty-btn-plus-<?=$i['item_id']?> <?=$i['qty'] == $i['qty_left'] ? 'hidden' : '' ?> "  onclick="modifyQty(this,'add',<?=$i['item_id'];?>)"> <i class="fa fa-plus"> </i></a><a class="btn btn-danger btn-xs text-white qty-btn-minus-<?=$i['item_id']?> ml-1 <?=$i['qty'] > 1 ? '' : 'hidden' ?>" onclick="modifyQty(this,'minus',<?=$i['item_id'];?>)"> <i class="fa fa-minus"> </i></a><br/>
                    </div>
                </div>
            </li>
        <?php } }else{ ?>
            <li class="header-cart-item">
                <a href="#" class="header-cart-item-name">
                    <i class="fa fa-check"></i> You have no product added.
                </a>
            </li>
        <?php } ?>
    </ul>
    
    <div class="cart-btn-details">
        <?php if($my_items){ ?>
            <div class="header-cart-total cart-total">
                Total: $<span class="totalCart"><?=number_format($total, 2, '.', '');?> </span><a onclick="clear_cart()" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Clear Cart</a> 
            </div>

            <div class="header-cart-buttons cart-buttons">
                <div class="header-cart-wrapbtn">
                    <!-- Button -->
                    <a href="<?=base_url();?>cart" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                        View Cart
                    </a>
                </div>

                <div class="header-cart-wrapbtn">
                    <!-- Button -->
                    <a href="<?=base_url();?>checkout" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                        Check Out
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>