<?php include 'inc/navb.php'; ?>
         
            <div class="app-content">
<div class="app-content--inner">
                <div class="page-title">
    <div>
        <h5 class="display-4 mt-1 mb-2 font-weight-bold">Loan Requests</h5>
    </div>
</div>


        <div class="container">
      <div class="card card-box mb-5">
          <div class="card-header">
         <div style="display: flex;justify-content: space-between;">
                                              <div class=" mb-2">
                                                  <b>Request List</b>
                                              </div>
                                         <div class=" mb-2">
                                        <!--<span class="badge badge-pill badge-primary" style="padding: 12px;height: 0;line-height: 0;"></span>-->
                                            </div>
                                            </div>
        
    </div>
    <div class="divider"></div>
    <div class="card-body">
       
      <div class="table-responsive">
        <span id="message_operation"></span>
  			<table class="table table-striped table-bordered" id="user_table">
  				<thead>
						<th>S/N</th>
  						<th>Name</th>
  						<th>Member ID</th>
  						<th>View</th>
  						<th>(My Review)</th>
  						<th>Admin Two</th>
  						<th>Admin Three</th>
  						<th>Admin Four</th>
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
			url:"authController/loan_process.php",
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
});
</script>    
       
       

    </div>
</div>


            


                    


                </div>
            </div>
       
          <?php include 'inc/footerb.php'; ?>
           
</div>





<div id="userModal" class="modal fade" style="display: none;" aria-hidden="true">
 <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header d-block">
        <div class="row mb-2">
            <div class="col">
                <div class="form-floating">
                 <h4 class="modal-title">Request Review</h4> 
                </div>
            </div>
            <div class="col">
                <div class="form-floating">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
            </div>
            </div>
    </div>
    <div class="modal-body" id="loanForm-card-body"> </div>
    
   </div>
 </div>
 
 <script>
 
 $(document).ready(function () {
     var lid = "";
     var sid = "";
    $(document).on('click',"#view-loan",function () {        
        lid = $(this).data('loanid');
         sid = $(this).data('sid');
       $.ajax({
              url:"authController/loan_process.php",
              type:"POST",
              data: {lid:lid, sid:sid, action:'getloaninfo'},
              beforeSend:function(){},
              success:function(data){
                   $("#loanForm-card-body").html(data);
                   $('#userModal').modal('show');
            
	        } 
	    });
    });
    
     $(document).on('click',"#approve-loan",function () {
       $.ajax({
              url:"authController/loan_process.php",
              type:"POST",
              data: {lid:lid, sid:sid, action:'approveloan'},
              beforeSend:function(){},
              dataType: "json",
              success:function(data){
                   $('#userModal').modal('hide');
                  $('#user_table').DataTable().ajax.reload();
                  if(data.approved){
                      $('#message_operation').html('<div class="alert alert-success text-center">'+data.notice+'</div>');
                  }
                  if(data.failed){
                      $('#message_operation').html('<div class="alert alert-danger text-center">'+data.notice+'</div>');
                  }
	        } 
	    });
    });
    
      $(document).on('click',"#decline-loan",function () {
       $.ajax({
              url:"authController/loan_process.php",
              type:"POST",
              data: {lid:lid, action:'declineloan'},
              beforeSend:function(){},
              dataType: "json",
              success:function(data){
                  $('#userModal').modal('hide');
                  $('#user_table').DataTable().ajax.reload();
                  if(data.approved){
                      $('#message_operation').html('<div class="alert alert-success text-center">'+data.notice+'</div>');
                  }
                  if(data.failed){
                      $('#message_operation').html('<div class="alert alert-danger text-center">'+data.notice+'</div>');
                  }
	        } 
	    });
    });
    
    
     // $('#uploadAllotment').attr('disabled', false); $('#uploadAllotment').text('Import');
});
 </script>
 
</div>