<?php
$sort ='';
if (isset($_GET['sort_price'])) {
    $sort = $_GET['sort_price'];
}
?>

<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
    <div class="leftbar p-r-20 p-r-0-sm p-t-10">
        <!--  -->
        <h4 class="m-text14 p-b-20">
            Search
        </h4>
        <div class="p-b-20">
            <div class="search-product pos-relative bo4 of-hidden">
                <form method="GET" action="<?=base_url();?>search">
                    <input class="s-text7 size6 p-l-23 p-r-50" type="search" name="keywords" id="keywords" placeholder="Search Products...">
                    <button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                        <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>

        <!--  -->
        <h4 class="m-text14">
            Filters
        </h4>

        <div class="p-t-22">
            <div class="rs2-select2 bo4 of-hidden m-b-5">
                <select class="selection-2" name="sorting" id="sort_price" data-url="<?=$this->uri->segment(1)?>">
                    <option>Default Sorting</option>
                    <option <?=($sort==1)?'selected':''?> value="1">Price: low to high</option>
                    <option <?=($sort==2)?'selected':''?> value="2">Price: high to low</option>
                </select>
            </div>

            <!-- <div class="rs2-select2 bo4 of-hidden m-t-5 m-b-5">
                <select class="selection-2" name="sorting">
                    <option>Price</option>
                    <option>$0.00 - $50.00</option>
                    <option>$50.00 - $100.00</option>
                    <option>$100.00 - $150.00</option>
                    <option>$150.00 - $200.00</option>
                    <option>$200.00+</option>
                </select>
            </div> -->
        </div>
    </div>
</div>