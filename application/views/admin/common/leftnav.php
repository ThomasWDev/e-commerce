<?php 
    $user_role = ($this->session->userdata('role')==1)?'admin':'user';
?>
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li class="text-muted menu-title">Navigation</li>
                <li class="has_sub">
                    <a href="<?=base_url();?>" class="waves-effect <?=($is_page=='view_categories' || $is_page=='shop_settings') ? 'active' : ''; ?>"><i class="ti-home"></i> <span> My Shop </span> </a>
                    <ul class="list-unstyled">
                        <li><a href="<?=base_url();?>" target="_blank" >View Shop</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?=base_url().$user_role;?>/dashboard" class="waves-effect <?=($is_page=='dashboard')? 'active' : ''; ?>"><i class="ti-dashboard"></i> <span> Dashboard </span> </a>
                </li>
                <li>
                    <a href="<?=base_url().$user_role;?>/orders" class="waves-effect <?=($is_page=='orders'|| $is_page=='view_order')? 'active' : ''; ?>"><i class="ti-shopping-cart"></i> <span> Orders </span> </a>
                </li>
                <li>
                    <a href="<?=base_url().$user_role;?>/customers" class="waves-effect <?=($is_page=='customers' || $is_page=='view_customer')? 'active' : ''; ?>"><i class="ti-user"></i> <span> Customers </span> </a>
                </li>
                <li class="has_sub">
                    <a href="javascript:;" class="waves-effect <?=($is_page=='products' || $is_page=='add_product' || $is_page=='edit_product') ? 'active' : ''; ?>"><i class="ti-archive"></i> <span> Products </span> </a>
                    <ul class="list-unstyled">
                        <?php if($is_page=='edit_product'){ ?>
                            <li class="active"><a href="javascript:;">Edit Product</a></li>
                        <?php } ?>
                        <li class="<?=($is_page=='add_product') ? 'active' : '';?>"><a href="<?=base_url();?>product/add_product">Add New Product</a></li>
                        <li class="<?=($is_page=='products') ? 'active' : '';?>"><a href="<?=base_url();?>admin/products">View Products</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:;" class="waves-effect <?=($is_page=='categories' || $is_page=='attributes' || $is_page=='attribute_items') ? 'active' : ''; ?>"><i class="ti-bag"></i> <span> Catalogs </span> </a>
                    <ul class="list-unstyled">
                        <li class="<?=($is_page=='categories') ? 'active' : ''; ?>"><a href="<?=base_url();?>catalog/view_categories">Categories</a></li>
                        <li class="<?=($is_page=='attributes' || $is_page=='attribute_items') ? 'active' : ''; ?>"><a href="<?=base_url();?>catalog/view_attributes">Attributes</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:;" class="waves-effect <?=($is_page=='payment_settings'||$is_page=='tax_shipping_rates' || $is_page == 'sendgrid_settings' || $is_page == 'taxjar_settings' || $is_page == 'ups_settings') ? 'active' : ''; ?>"><i class="ti-settings"></i> <span> Settings </span> </a>
                    <ul class="list-unstyled">
                        <li class="<?=($is_page=='payment_settings') ? 'active' : '';?>"><a href="<?=base_url().$user_role;?>/payment_settings">Payment Settings</a></li>
                        <!-- <li class="<?=($is_page=='tax_shipping_rates') ? 'active' : '';?>"><a href="<?=base_url().$user_role;?>/tax_shipping_rates">Tax and Shipping Rates</a></li> -->
                        <li class="<?=($is_page=='sendgrid_settings') ? 'active' : '';?>"><a href="<?=base_url().$user_role;?>/sendgrid_settings">Sendgrid Settings</a></li>
                        <li class="<?=($is_page=='taxjar_settings') ? 'active' : '';?>"><a href="<?=base_url().$user_role;?>/taxjar_settings">Taxjar Settings</a></li>
                        <li class="<?=($is_page=='ups_settings') ? 'active' : '';?>"><a href="<?=base_url().$user_role;?>/ups_settings">UPS Settings</a></li>

                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>