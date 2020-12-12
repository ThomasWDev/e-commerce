<?php $this->load->view('admin/profile_settings');?>
<script>
   var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="<?=base_url();?>assets/back-office/js/jquery.min.js"></script>
<script src="<?=base_url();?>assets/back-office/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/back-office/js/detect.js"></script>
<script src="<?=base_url();?>assets/back-office/js/fastclick.js"></script>
<script src="<?=base_url();?>assets/back-office/js/jquery.slimscroll.js"></script>
<script src="<?=base_url();?>assets/back-office/js/jquery.blockUI.js"></script>
<script src="<?=base_url();?>assets/back-office/js/waves.js"></script>
<script src="<?=base_url();?>assets/back-office/js/wow.min.js"></script>
<script src="<?=base_url();?>assets/back-office/js/jquery.nicescroll.js"></script>
<script src="<?=base_url();?>assets/back-office/js/jquery.scrollTo.min.js"></script>

<script src="<?=base_url();?>assets/back-office/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/back-office/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?=base_url();?>assets/back-office/plugins/switchery/dist/switchery.min.js"></script>

<script type="text/javascript" src="<?=base_url();?>assets/back-office/plugins/parsleyjs/dist/parsley.min.js"></script>

<script src="<?=base_url();?>assets/back-office/js/jquery.core.js"></script>
<script src="<?=base_url();?>assets/back-office/js/jquery.app.js"></script>

<!-- Sweet-Alert  -->
<script src="<?=base_url();?>assets/back-office/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?=base_url();?>assets/back-office/plugins/notifyjs/dist/notify.min.js"></script>
<script src="<?=base_url();?>assets/back-office/plugins/notifications/notify-metro.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/back-office/plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>

<!-- Inits -->
<script src="<?=base_url();?>assets/back-office/js/init/init_general.js"></script>
<script src="<?=base_url();?>assets/back-office/js/init/init_edit.js"></script>
<script src="<?=base_url();?>assets/back-office/js/init/init_prod.js"></script>
<script src="<?=base_url();?>assets/back-office/js/init/init_order.js"></script>

<?php if($is_page=="categories" || $is_page=="attributes" || $is_page=="attribute_items"){?>
<script src="<?=base_url();?>assets/back-office/js/init/init_catalogs.js"></script>
<?php } ?>
