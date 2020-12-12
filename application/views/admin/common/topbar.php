<?php
    if ($this->session->userdata('role')==1) {
        $new_orders = $this->product_model->all_new_orders(); 
        $cnt_orders = count($new_orders);
    }

    $user = $this->customer_model->get_single_customer($this->session->userdata('user_id'));
    $img_link = ($user['user_img']) ? 'c'.$user['user_id'].'/'.$user['user_img'] : 'default.png';
?>
<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="<?=base_url();?>admin/dashboard" class="logo">
            <img class="icon-c-logo comp-logo" src="<?=base_url();?>assets/back-office/images/comp-logo.png" alt="Site Logo">
            <span><img class="comp-logo" src="<?=base_url();?>assets/back-office/images/comp-logo.png" alt="Site Logo"> ADMIN</span></a>
        </div>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left">
                        <i class="ion-navicon"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>
                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                            <div class="user-img">
                                <img src="<?=base_url();?>assets/back-office/images/customer/<?=$img_link;?>" alt="user-img" class="img-circle" style="border:0;">
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:;" onclick="get_this_user(<?=$this->session->userdata('user_id')?>)" class="waves-effect"><i class="ti-settings m-r-5"></i> Profile Settings</a></li>
                            <li><a href="javascript:;" onclick="logout()"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <?php if($this->session->userdata('role')==1){ ?>
                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="dropdown">
                            <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-bell"></i> <?=($new_orders)?'<span class="badge badge-xs badge-danger">'.$cnt_orders.'</span>':''; ?>
                            </a>
                            <ul class="dropdown-menu notification-ul dropdown-menu-lg <?=($cnt_orders>=5)?'responsive-dropdown':'';?>">
                                <li class="notifi-title">Notifications</li>
                                <?php if($new_orders){ foreach($new_orders as $u){ ?>
                                    <li class="list-group nicescroll notification-list">
                                        <!-- list item-->
                                        <a href="<?=base_url();?>admin/orders" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left p-r-10">
                                                    <em class="fa fa-user fa-2x text-danger"></em>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading"><?=$u['firstname'].' '.$u['lastname']?></h5>
                                                    <p>Order#: <?=$u['order_id']?></p>
                                                    <p>Date Ordered: <?=date('Y-m-d',strtotime($u['date_ordered']))?></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php } }else{ ?>
                                    <li class="list-group nicescroll notification-list">
                                        <!-- list item-->
                                        <a href="javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left p-r-10">
                                                    <em class="fa fa-bell fa-2x text-danger"></em>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">No New Notifications </h5>
                                                    <p class="m-0">
                                                        <small><?=date('Y-m-d'); ?></small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                <?php } ?>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>