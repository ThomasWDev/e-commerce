<?php if($is_page!='checkout'){ ?>
<div class="wrap_menu">
    <nav class="menu">
        <ul class="main_menu">
            <li class="<?=($is_page=='homepage') ? 'active' : '';?>">
                <a href="<?=base_url();?>">Home</a>
            </li>

            <li class="<?=($is_page=='shop') ? 'active' : '';?>">
                <a href="<?=base_url();?>shop">Shop</a>
            </li>

            <li class="<?=($is_page=='sale') ? 'active' : '';?>">
                <a href="<?=base_url();?>sale">Sale</a>
            </li>

            <li class="<?=($is_page=='features') ? 'active' : '';?>">
                <a href="<?=base_url();?>features">Features</a>
            </li>

            <li class="<?=($is_page=='about') ? 'active' : '';?>">
                <a href="<?=base_url();?>about">About</a>
            </li>

            <li class="<?=($is_page=='contact') ? 'active' : '';?>">
                <a href="<?=base_url();?>contact">Contact</a>
            </li>
        </ul>
    </nav>
</div>
 <?php } ?>