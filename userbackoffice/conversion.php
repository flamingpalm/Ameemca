<?php include 'inc/navb.php'; ?>
         
            <div class="app-content">
<div class="app-content--inner">
                <div class="page-title">
    <div>
        <h5 class="display-4 mt-1 mb-2 font-weight-bold">Wallet Deduction</h5>
         <li><span>Transfer fund from your savings wallet to your contribution wallet.</span></li>
          <li><span>You can only submit a transfer request once every 48hrs.</span></li>
         <li><span>This process is subject to an account review process before approval.</span></li>
    </div>
                      <div class="row" style="display:block">       
<!--<div class="alert alert-danger" role="alert">
  <b>Dear Admin,</b>
 <br> Please be informed that this page is currently under development as we are actively carrying out system maintainence 
 to bring you the best user experience. Kindly exercise patience and exit this page, we'll be done in due time.
<br>
Thank you.
</div>-->
                    </div>
</div>


        <div class="container">
      <div class="card card-box mb-5">
          <div class="card-header">
         <div style="display: flex;justify-content: space-between;">
                                              <div class=" mb-2">
                                                  <b>Transfer History</b>
                                              </div>
                                           <div class=" mb-2">
                                                  <button type="button" action="save" id="add_button"  class="btn btn-pill btn-primary btn-sm">Transfer</button>
                                            </div>
                                            </div>
        
    </div>
    <div class="divider"></div>
    <div class="card-body">
       
      <div class="table-responsive">
        <span id="message_operation"> </span>
  			<table class="table table-striped table-bordered" id="user_table">
  				<thead>
  					<tr>
						<th>S/N</th>
						<th>Date</th>
  						<th>Conversion Amount (N)</th>
  						<th>Status</th>
  				</thead>
  				<tbody></tbody>
  			</table>
  		</div>
  		
  
  		
 	
  		
  		
     
       
       

    </div>
</div>


            


                    


                </div>
            </div>
       
          <?php include 'inc/footerb.php'; ?>


 
 <div id="updateModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="update_form" enctype="multipart/form-data">
   <div class="modal-content" id="expenditure-card-body">
    </div>
  </form>
 </div> </div>
 
 
 
      <script>
      $(document).ready(function(){
	        
var dataTable = $('#user_table').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[], 
		"ajax":{
			url:"authController/conversion_process.php",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
				"targets":[0, 1],
				"orderable":false,
			},
		],
	});
	
	
$(document).on('click', '#add_button', function(){	
        var form = '<div class="modal-header d-block"> <div class="row mb-2"> <div class="col"> <div class="form-floating"><h4 class="modal-title">Convert</h4></div></div><div class="col"> <div class="form-floating"><button type="button" class="close" data-dismiss="modal">&times;</button></div></div></div></div><div class="modal-body"> <div class="alert d-flex align-items-center pl-4 align-content-center alert-info fade show" role="alert"> <span> <strong class="d-block">Notice!</strong>The amount entered below would be deducted from your savings wallet and added to your contribution balance after your request is approved. </span> </div><div class="form-group col-md-12"> <label>Savings Wallet Balance:</label> <span style="padding: 3px 12px; background: #e1e1e1; border-radius: 30px; font-weight: bold;">N <?php if(getAccountBalance($staffid)=="0"){echo "0.00";}else{echo number_format(getAccountBalance($staffid));}?> </span> </div><div class="form-group col-md-12"> <label>Contribution Balance:</label> <span style="padding: 3px 12px; background: #e1e1e1; border-radius: 30px; font-weight: bold;"> N <?php if(getContributionBalance($staffid)=="0"){echo "0.00";}else{echo number_format(getContributionBalance($staffid));}?> </span> </div><div class="form-group col-md-12"> <label>Amount (N):</label> <input type="number" name="amount" id="amount" class="form-control" placeholder="0.00:"/> <div id="error_amount" style="color: red;"></div></div></div><div class="modal-footer"> <button type="submit" id="convert_button" class="btn btn-pill btn-primary btn-sm">Submit</button><input type="hidden" name="action" value="convert_wallet" id="convert_wallet"/> </div>';    
        $("#expenditure-card-body").html(form);
         $('#updateModal').modal('show');
  });
	
	
var cid ='';
$(document).on('click', '.conversion-item', function(){
     cid = $(this).data('cid');
    $.ajax({
      url:"authController/conversion_process.php",
      method:"POST",
      dataType: "json",
      data:{action:'update_conversion', cid:cid},
      success:function(data)
      { 
         $('#message_operation').html(data.notice);
            $('#user_table').DataTable().ajax.reload();
      }
    });
  });	
	


 
 function clear_field()
  {
    $('#update_form')[0].reset();
    $('#error_amount').text('');
  }

  $('#update_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"authController/conversion_process.php",
      method:"POST",
      data:$(this).serialize(),
      dataType:"json",
      beforeSend:function()
      {
        $('#convert_button').attr('disabled', 'disabled').text('Submitting...');
         $('#close_btn').attr('disabled', 'disabled');
         clear_field();
      },
      success:function(data)
      {
        $('#convert_button').attr('disabled', false).text('Submit');
        $('#close_btn').attr('disabled', false);
        if(data.success)
     	  {
     	    $("#expenditure-card-body").html(data.html);
            $('#user_table').DataTable().ajax.reload();
              clear_field();
          }
        
        if(data.error)
        {    
         if(data.error_amount != '')
          {
            $('#error_amount').text(data.error_amount);
          }
          else
          {
            $('#error_amount').text('');
          }
        }
      }
    })
  }); 

  
   
 

  
  
  
  
});
</script> 