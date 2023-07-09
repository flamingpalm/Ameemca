 <?php include 'inc/navb.php'; ?>
         
            <div class="app-content">
<div class="app-content--inner">
                <div class="page-title">
    <div>
        <h5 class="display-4 mt-1 mb-2 font-weight-bold">Allotment Records</h5>
    </div>
</div>

        <div class="container">
      <div class="card card-box mb-5">
          <div class="card-header">
         <div style="display: flex;justify-content: space-between;">
                                              <div class=" mb-2">
                                              <b>Allotment</b>
                                              </div>
                                        
                            <div class=" mb-2">
                                <a href="/a/allotmentslip?action=download_slip" id="download_slip_btn" class="btn btn-pill btn-primary btn-sm">Download Slip</a>
                            <button type="button" id="pay_all_btn"  class="btn btn-pill btn-success btn-sm">Pay All</button>
                             </div>
                             </div>
                             </div>
    <div class="divider"></div>
    <div class="card-body">
       
      <div class="table-responsive">
        <span id="message_operation"></span>
  			<table class="table table-striped table-bordered" id="user_table">
  				<thead>
  					<tr>
						<th>S/N</th>
  						<th>Name</th>
  						<th>Member ID</th>
  						<th>Amount</th>
  					</tr>
  				</thead>
  				<tbody>

  				</tbody>
  			</table>
  		</div>
  		
  
  		
  		
  		
  		
       <script>
      $(document).ready(function(){
	        var dataTable = $('#user_table').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[], 
		"ajax":{
			url:"authController/payment_process.php",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
				"targets":[0, 1, 2, 3],
				"orderable":false,
			},
		],
	});
});
</script>    
    </div>
</div>


            

<div id="userModal" class="modal fade" style="display: none;" aria-hidden="true">
 <div class="modal-dialog">
  <form method="post" id="user_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header d-block">
        <div class="row mb-2">
            <div class="col">
                <div class="form-floating">
                 <h4 class="modal-title">Processing Payment</h4> 
                </div>
            </div>
            <div class="col">
                <div class="form-floating">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
            </div>
            </div>
    </div>
    <div class="modal-body" id="payoutPrompt"></div>
    <div class="modal-footer">
     <button type="submit" id="uploadAllotment" class="btn btn-pill btn-primary btn-sm">Pay</button>
     <button type="button" class="btn btn-default btn btn-pill btn-sm" data-dismiss="modal">Cancel</button>
    </div>
   </div>
  </form>
 </div>
 
 <script>
 $(document).ready(function(){
  $('#user_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"authController/payment_process.php",
      method:"POST",
      data:{action:'contribution_payout'},
      dataType: "json",
      beforeSend:function(){
        $('#uploadAllotment').attr('disabled', 'disabled');
        $('#uploadAllotment').text('Processing...');
      },
      success:function(data)
      {
                  $('#message_operation').html('<div class="alert alert-success text-center">'+data.notice+'</div>');
                  $('#user_form')[0].reset();
                  $('#userModal').modal('hide');
                  $('#user_table').DataTable().ajax.reload();
                  $('#uploadAllotment').attr('disabled', false);
                  $('#uploadAllotment').text('Pay');
      }
    })
  });
  
  
  
  function showpanel(){     
    $('#userModal').modal('show');
 }
$(document).on('click', '#pay_all_btn', function(){
	    $('#userModal').modal('hide');
        $('#payoutPrompt').html('');
    $.ajax({
      url:"authController/payment_process.php",
      method:"POST",
      data:{action:'single_fetch'},
      success:function(data)
      { 
           $('#payoutPrompt').html(data);
           setTimeout(showpanel, 500);
      }
    });
  });
  







  
  
});

 </script>
 
</div>

                    


                </div>
            </div>
                 <?php include 'inc/footerb.php'; ?>
           
</div>