<?php 
    if($this->session->userdata('user_id')){
        $user = $this->auth_model->get_my_info();
        $img_link = ($user['user_img']) ? 'c'.$user['user_id'].'/'.$user['user_img'] : 'user_icon.png';
    }else{
        $img_link = 'user_icon.png';
    }
?>
<?php
if($this->session->userdata('user_id')){
    ($user['user_id'])?'Hi '.$user['firstname']:'';
}?>&nbsp;
<div class="top-acc-img js-show-header-dropdown">
    <img src="<?=base_url();?>assets/back-office/images/customer/<?=$img_link;?>" class="header-icon1  user-top-img rounded-circle" alt="customer avatar">
</div>
<!-- Header cart noti -->
<div class="header-cart header-dropdown" style="width: 170px">
    <ul class="header-cart-wrapitem">
        <?php if (isset($user['user_id'])) {?>
            <li class="header-cart-item">
                <a href="<?=base_url().'profile'?>" class="header-cart-item-name"> Profile</a>
            </li>
            <li class="header-cart-item">
                <a href="<?=base_url().'transactions'?>" class="header-cart-item-name"> My Transactions</a>
            </li>
            <li class="header-cart-item">
                <a href="<?=base_url().'logout'?>" class="header-cart-item-name"> Logout</a>
            </li>
        <?php }else{?>
            <li class="header-cart-item">
                <a href="javascript:;" class="header-cart-item-name" onclick="launchLogin(1)"> Login</a>
            </li>
            <li class="header-cart-item">
                <a href="javascript:;" class="header-cart-item-name" onclick="launchRegister(1)"> Register</a>
            </li>
        <?php } ?>
    </ul>                                                                                                
</div>