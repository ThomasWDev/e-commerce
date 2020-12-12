<ol class="breadcrumb">
    <li class="breadcrumb-item <?= $is_page == 'my_cart' ? 'active' : '' ?>" <?= $is_page == 'my_cart' ? 'aria-current="page"' : '' ?>><a href="<?= base_url() ?>cart">Cart</a></li>
    <li class="breadcrumb-item <?= $is_page == 'checkout' ? 'active' : '' ?>" <?= $is_page == 'checkout' ? 'aria-current="page"' : '' ?>><a href="<?= base_url() ?>checkout">Information</a></li>
    <li class="breadcrumb-item <?= $is_page == 'shipping' ? 'active' : '' ?>" <?= $is_page == 'shipping' ? 'aria-current="page"' : '' ?>><a href="<?= $this->session->userdata('shipping_rates') ? base_url().'shipping' : 'javascript:;' ?>">Shipping</a></li>
    <li class="breadcrumb-item <?= $is_page == 'payment' ? 'active' : '' ?>" <?= $is_page == 'payment' ? 'aria-current="page"' : '' ?>><a href="<?= $this->session->userdata('shipping_details') ? base_url().'payment' : 'javascript:;' ?>">Payment</a></li>
</ol>