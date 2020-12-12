<!-- Header Fixed when scrolled -->
<div class="wrap_header fixed-header2 trans-0-4">
    <!-- Logo -->
    <a href="<?=base_url();?>" class="logo">
        <img src="<?=base_url();?>assets/front-office/images/icons/logo.png" alt="IMG-LOGO">
    </a>
    <!-- Menu -->
    <?php $this->load->view('frontpage/common/header/menu');?>
    <!-- Header Icon -->
    <div class="header-icons">
        <div class="header-wrapicon2 m-r-13">
            <?php $this->load->view('frontpage/common/header/account_menu');?>
        </div>
        <div class="header-wrapicon2 m-r-13">
            <!-- Cart list -->
            <?php $this->load->view('frontpage/common/header/cart');?>
        </div>
    </div>
</div>

<!-- Header -->
<header class="header2">
    <!-- Header desktop -->
    <div class="container-menu-header-v2 p-t-26">
        <div class="topbar2">
            <!-- Logo2 -->
            <a href="<?=base_url();?>" class="logo2">
                <img src="<?=base_url();?>assets/front-office/images/icons/logo.png" alt="IMG-LOGO">
            </a>

            <div class="topbar-child2">
                <div class="header-wrapicon2 m-r-13">
                    <?php $this->load->view('frontpage/common/header/account_menu');?>
                </div>
                <div class="header-wrapicon2 m-r-13">
                    <!-- Cart list -->
                    <?php $this->load->view('frontpage/common/header/cart');?>
                </div>
            </div>
        </div>

        <div class="wrap_header">
            <!-- Menu -->
            <?php $this->load->view('frontpage/common/header/menu');?>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
        <!-- Logo moblie -->
        <a href="<?=base_url();?>" class="logo-mobile">
            <img src="<?=base_url();?>assets/front-office/images/icons/logo.png" alt="IMG-LOGO">
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">

                <div class="header-wrapicon2">
                    <!-- Cart list -->
                    <?php $this->load->view('frontpage/common/header/account_menu');?>
                </div>

                <span class="linedivide2"></span>

                <div class="header-wrapicon2">
                    <!-- Cart list -->
                    <?php $this->load->view('frontpage/common/header/cart');?>
                </div>
            </div>

            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu" >
        <nav class="side-menu">
            <ul class="main-menu">
                <?php if($is_page!='checkout'){ ?>
                    <li class="item-menu-mobile">
                        <a href="<?=base_url();?>">Home</a>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="<?=base_url();?>shop">Shop</a>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="<?=base_url();?>sale">Sale</a>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="<?=base_url();?>features">Features</a>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="<?=base_url();?>about">About</a>
                    </li>

                    <li class="item-menu-mobile">
                        <a href="<?=base_url();?>contact">Contact</a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</header>