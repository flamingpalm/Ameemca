

          <?php include 'inc/navb.php'; ?>
         
            <div class="app-content">
<div class="app-content--inner">
     <div class="page-title">
     <div>
     <h5 class="display-4 mt-1 mb-2 font-weight-bold">Loan Request History</h5>
    </div>
    
</div>


        <div class="container">
      <div class="card card-box mb-5">
          <div class="card-header">
         <div style="display: flex;justify-content: space-between;">
          <div class=" mb-2">
              <b>History</b>
          </div>
         <div class=" mb-2">
    <span class="badge badge-pill badge-primary" style="padding: 12px;height: 0;line-height: 0;">Loan Balance: N<?php if(getLoanBalance($staffid) == "0"){ echo "0.00"; }else{ echo number_format(getLoanBalance($staffid));} ?></span>
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
  						<th>Amount</th>	
  						<th>Status</th>
  						<th>Progress</th>
  						<th>Reference</th>
  						<th>Date</th>
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
			url:"authController/loan_process",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
				"targets":[0, 1, 2, 3, 4],
				"orderable":false,
			},
		],
	});
	
	
	var staffid ='';
		$(document).on('click', '.view-member', function(){
		    
     var lid = $(this).data('lid');
    $.ajax({
      url:"authController/loan_process.php",
      method:"POST",
      data:{action:'single_fetch', lid:lid},
      success:function(data)
      { 
        $('#viewModal').modal('show');
        $('#view_user_details').html(data);
      }
    });
  });
	
	

	
	
	
});

	function changeGuarantor(id){
	     $.ajax({
              url:"authController/loan_process.php",
              method:"POST",
              dataType:'JSON', 
             data: $('#loanForm'+id).serialize(),
              success:function(data)
              { 
               $('#view_user_details').html(data);
              }
    });
  }
</script>    
       
       

    </div>
</div>

                </div>
            </div>
       
          <?php include 'inc/footerb.php'; ?>
           
</div>


<div class="modal" id="viewModal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
      <h4 class="modal-title">Loan Progress</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="view_user_details" style="padding:0"></div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-primary btn-pill btn-sm" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

