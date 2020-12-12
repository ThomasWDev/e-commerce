/* Show update order status modal */
function updateOrderStatus(orderID,orderStatus){
	$('#order_id').val(orderID);
	$("#order_status option[value='"+orderStatus+"']").prop('selected','selected');
	$('#saveOrderBtn').hide();
	$('#orderModal').attr('onchange', 'showBtn('+orderStatus+')');
	$('#orderModal').modal('show');
}

/* Show button if status is not equal to current status */
function showBtn(orderStatus){
	if(orderStatus==$('#order_status').val()){
		$('#saveOrderBtn').hide();
	}else{
		$('#saveOrderBtn').show();
	}
}

/* Update order status using ajax */
function updateOrder(){
	$("#saveOrderBtn").html('<i class="fa fa-spinner fa-spin"></i> Saving..');
	$.ajax({
        url: base_url+'admin/updateOrderStatus',
		type:'POST',
        data: $('#orderModalForm').serialize(),
        success: (res)=>{
        	if (res==1) {
        		$('#orderModal').modal('hide');
        		swal({ title: "Success!", text: "Order status updated successfully", type: "success" }
        			,function(){
        				location.reload(); 
        			}
        		);
        	}else if(res == 0){
				$("#saveOrderBtn").html('Update Status');
        		swal({ title: "Oops!", text: "Failed to update order status", type: "warning" });
        	}else{
				$("#saveOrderBtn").html('Update Status');
        		swal({ title: "Oops!", text: res, type: "warning" });
			}
        }
    });
}

/* View customer using ajax */
function viewCustomer(email,e){
	loadBtn(e, 'check', 'start');
	$.ajax({
		url: base_url+'admin/check_customer_email',
		type: 'POST',
		data: {email:email},
		success:(res)=>{
			loadBtn(e, '', 'stop', '<i class="fa fa-search"></i> View');
			if(res!=0){
				window.location.href = base_url+'admin/view_customer/'+res;
			}else{
				$.Notification.notify('error','top right','Failed', 'A problem occured. Please try again');
			}
		}
	});
}