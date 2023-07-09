<?php include 'inc/navb.php'; ?>
         
            <div class="app-content">
<div class="app-content--inner">
                <div class="page-title">
    <div>
        <h5 class="display-4 mt-1 mb-2 font-weight-bold">Wallet Deduction</h5>
         <li><span>Approve members savings wallet to contribution wallet funds transfer</span></li>
         <li><span>Click on th "Approve Now" button to approve. This process can't be undone.</span></li>
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
                                                  <b>Transfer Requests</b>
                                              </div>
                                         <div class=" mb-2">
                                        <!--<span class="badge badge-pill badge-primary" style="padding: 12px;height: 0;line-height: 0;"></span>-->
                                            </div>
                                            </div>
        
    </div>
    <div class="divider"></div>
    <div class="card-body">
       
      <div class="table-responsive">
        <span id="message_operation">
            
     
            
            
        </span>
  			<table class="table table-striped table-bordered" id="user_table">
  				<thead>
  					<tr>
						<th>S/N</th>
  						<th>Name</th>
  						<th>Member ID</th>
  						<th>Conversion Amount (N)</th>
  						<th>Wallet Balance (N)</th>
  						<th>Contribution Balance (N)</th>
  						<th>Loan Balance (N)</th>
  						<th>Status</th>
  						<th>Date</th>
  				</thead>
  				<tbody></tbody>
  			</table>
  		</div>
  		
  
  		
 	
  		
  		
     
       
       

    </div>
</div>


            


                    


                </div>
            </div>
       
          <?php include 'inc/footerb.php'; ?>


 
 
 
 
 
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
	
var cid ='';
var sid ='';
var amount ='';
$(document).on('click', '.conversion-item', function(){
     cid = $(this).data('cid');
     sid = $(this).data('sid');
     amount = $(this).data('amount');
    $.ajax({
      url:"authController/conversion_process.php",
      method:"POST",
      dataType: "json",
      data:{action:'update_conversion', cid:cid, sid:sid, amount:amount},
      success:function(data)
      { 
         $('#message_operation').html(data.notice);
            $('#user_table').DataTable().ajax.reload();
      }
    });
  });	
	

  
 

  
  
  
  
});
</script> 