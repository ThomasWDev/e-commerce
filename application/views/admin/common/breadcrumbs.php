<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">
            <?php if($is_page=='products') echo 'Products';?>
            <?php if($is_page=='add_product') echo 'Add Product';?>
            <?php if($is_page=='edit_product') echo 'Edit Product';?>
            <?php if($is_page=='categories') echo 'Categories';?>
            <?php if($is_page=='attributes') echo 'Attributes';?>
            <?php if($is_page=='payment_settings') echo 'Payment Settings';?>
            <?php if($is_page=='sendgrid_settings') echo 'Sendgrid Settings';?>
            <?php if($is_page=='taxjar_settings') echo 'Taxjar Settings';?>
            <?php if($is_page=='ups_settings') echo 'UPS Settings';?>
            <?php if($is_page=='tax_shipping_rates') echo 'Tax and Shipping Rates Settings';?>
            <?php if($is_page=='attribute_items') echo 'Attributes Items';?>
            <?php if($is_page=='customers') echo 'Customers';?>
            <?php if($is_page=='view_customer') echo 'Customer Profile';?>
            <?php if($is_page=='view_order') echo 'Order Details';?>
            <?php if($is_page=='orders') echo 'Orders';?>
        </h4>
        <ol class="breadcrumb">
            <li>
                <a href="<?=base_url();?>admin/dashboard">Home</a>
            </li>
            <?php if($is_page=='attribute_items'){?>
                <li>
                    <a href="<?=base_url();?>catalog/view_attributes">Attributes</a>
                </li>
            <?php } ?>
            <li class="active">
                <?php if($is_page=='products') echo 'Products';?>
                <?php if($is_page=='add_product') echo 'Add Product';?>
                <?php if($is_page=='edit_product') echo 'Edit Product';?>
                <?php if($is_page=='categories') echo 'Categories';?>
                <?php if($is_page=='attributes') echo 'Attributes';?>
                <?php if($is_page=='payment_settings') echo 'Payment Settings';?>
                <?php if($is_page=='sendgrid_settings') echo 'Sendgrid Settings';?>
                <?php if($is_page=='taxjar_settings') echo 'Taxjar Settings';?>
                <?php if($is_page=='ups_settings') echo 'UPS Settings';?>
                <?php if($is_page=='tax_shipping_rates') echo 'Tax and Shipping Rates Settings';?>
                <?php if($is_page=='attribute_items') echo $attr['attr_name'];?>
                <?php if($is_page=='customers') echo 'Customers';?>
                <?php if($is_page=='view_customer') echo 'Customer Profile';?>
                <?php if($is_page=='view_order') echo 'Order Details';?>
                <?php if($is_page=='orders') echo 'Orders';?>
            </li>
        </ol>
    </div>
</div>