<!DOCTYPE html>
<html>
    <?php $this->load->view('admin/common/css');?>
    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php $this->load->view('admin/common/topbar');?>
            <!-- Top Bar End -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php $this->load->view('admin/common/leftnav');?>
            <!-- Left Sidebar End -->
            <?php 
                $total=0;
                if($this->session->userdata('user_id')){
                    
                }else{
                    $orders = (isset($_SESSION['orders']))?$_SESSION['orders']:[];
                }
            ?>
            <!-- Start right Content here -->
            <div class="content-page">
                <input type="hidden" value="<?=(isset($_SESSION['prop_msg'])) ? $_SESSION['prop_msg'] : '0';?>" id="getAgentMsg">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <?php $this->load->view('admin/common/breadcrumbs');?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="container">
                                        <h4 class="m-t-0 header-title"><b>Orders list</b></h4>
                                        <p class="text-muted m-b-30 font-13">
                                            List of all orders.
                                        </p>
                                        <div class="tbl-resonsive">
                                            <table id="datatable-order" class="table table-striped table-bordered table-actions-bar m-b-0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">ORDER ID</th>
                                                        <th class="text-center">Customer</th>
                                                        <th class="text-center">Date Purchased</th>
                                                        <th class="text-center">Total</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if ($orders) { foreach($orders as $o){?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <?=$o['order_id']?>
                                                                </td>
                                                                <td class="text-center"><span class="ttl">Customer:</span> 
                                                                    <?=$o['firstname'].' '.$o['lastname'];?>
                                                                </td>
                                                                <td class="text-center"><span class="ttl">Date Purchased:</span> <?=date('M d, Y h:i A', strtotime($o['date_ordered']));?></td>
                                                                <td class="text-center"><span class="ttl">Total:</span> $<?=$o['total_paid'];?></td>
                                                                <td class="text-center"> <span class="ttl">Status:</span>
                                                                    <?=($o['order_status'] == 1) ? '<span class="label label-primary">Awaiting Check Payment</span>' : '';?>
                                                                    <?=($o['order_status'] == 2) ? '<span class="label label-primary">Awaiting COD validation</span>' : '';?>
                                                                    <?=($o['order_status'] == 3) ? '<span class="label label-danger">Cancelled</span>':'';?>
                                                                    <?=($o['order_status'] == 4) ? '<span class="label label-success">Delivered</span>' : '';?>
                                                                    <?=($o['order_status'] == 5) ? '<span class="label label-warning">Payment Accepted</span>' : '';?>
                                                                    <?=($o['order_status'] == 6) ?'<span class="label label-danger">Payment Error</span>':'';?>
                                                                    <?=($o['order_status'] == 7) ? '<span class="label label-primary">Processing in progress</span>' : '';?>
                                                                    <?=($o['order_status'] == 8) ? '<span class="label label-primary">Refunded</span>' : '';?>
                                                                    <?=($o['order_status'] == 9) ? '<span class="label label-success">Shipped</span>' : '';?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light btn-sm" data-toggle="dropdown" aria-expanded="false">Options <span class="caret"></span></button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li><a href="<?=base_url();?>admin/view_order/<?=$o['order_id']?>" target="_blank">View Order</a></li>
                                                                            <li><a href="javascript:;" onclick="updateOrderStatus(<?=$o['order_id']?>,<?=$o['order_status']?>)">Update Status</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                    <?php } ?>
                                                <?php }else{ ?>
                                                    <div class="col">
                                                        <div class="custom-cart-alert">You don't have transactions.</div>
                                                    </div>  
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--  modal start -->
                        <div class="modal fade modal-form" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <form onchange="showBtn()" action="<?=base_url();?>" method="POST" id="orderModalForm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4>Update Order</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Order Status</label>
                                                <select class="form-control" name="order_status" id="order_status">
                                                    <option value="1">Awaiting Check Payment</option>
                                                    <option value="2">Awaiting COD Validation</option>
                                                    <option value="3">Cancelled </option>
                                                    <option value="4">Delivered</option>
                                                    <option value="5">Payment Accepted</option>
                                                    <option value="6">Payment Error</option>
                                                    <option value="7">Processing In Progress</option>
                                                    <option value="8">Refunded</option>
                                                    <option value="9">Shipped</option>
                                                </select>
                                                <input type="hidden" name="order_id" id="order_id">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 m-t-10 text-right">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <a type="button" id="saveOrderBtn" onclick="updateOrder()" class="btn btn-primary text-white has-spinner">Update Status</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--  modal end -->

                    </div> <!-- container -->
                               
                </div> <!-- content -->

                <?php $this->load->view('admin/common/footer');?>

            </div>
            <!-- End Right content here -->
        </div>
        <!-- END wrapper -->

        <?php $this->load->view('admin/common/js');?>
    </body>
</html>
