<?php $this->load->view('frontpage/common/header/login');?>
<?php $categories = $this->frontpage_model->categories(); ?>
<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
    <div class="p-b-90 row">
        <div class="col-md-6 col-sm-12 text-center respon3">
            <h4 class="s-text12 p-b-30">
                GET IN TOUCH
            </h4>

            <div>
                <p class="s-text7 w-size27">
                    Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
                </p>

                <div class="p-t-30 text-center">
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 text-center respon4">
            <h4 class="s-text12 p-b-30">
                Links
            </h4>

            <ul>
                <li class="p-b-9">
                    <a href="<?=base_url();?>" class="s-text7">
                        Home
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="<?=base_url();?>shop" class="s-text7">
                        Shop
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="<?=base_url();?>sale" class="s-text7">
                        Sale
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="<?=base_url();?>features" class="s-text7">
                        Features
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="<?=base_url();?>about" class="s-text7">
                        About
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="<?=base_url();?>contact" class="s-text7">
                        Contact
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="t-center p-l-15 p-r-15">
        <a href="#">
            <img class="h-size2" src="<?=base_url();?>assets/front-office/images/icons/paypal.png" alt="IMG-PAYPAL">
        </a>

        <a href="#">
            <img class="h-size2" src="<?=base_url();?>assets/front-office/images/icons/visa.png" alt="IMG-VISA">
        </a>

        <a href="#">
            <img class="h-size2" src="<?=base_url();?>assets/front-office/images/icons/mastercard.png" alt="IMG-MASTERCARD">
        </a>

        <a href="#">
            <img class="h-size2" src="<?=base_url();?>assets/front-office/images/icons/express.png" alt="IMG-EXPRESS">
        </a>

        <a href="#">
            <img class="h-size2" src="<?=base_url();?>assets/front-office/images/icons/discover.png" alt="IMG-DISCOVER">
        </a>

        <div class="t-center s-text8 p-t-20">
            Copyright © <?=date('Y');?> All rights reserved. | Developed by <a href="https://tbltechnerds.com" target="_blank">Denver Web Development</a>
        </div>
    </div>
</footer>