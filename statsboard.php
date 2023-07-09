<?php include 'inc/navb.php'; ?>
          
            <div class="app-content">
                <div class="app-content--inner">
                    
         
                      <div class="page-title">  
                        <div>
        <h5 class="display-4 mt-1 mb-2 font-weight-bold">Stats Board</h5>
         <li><span>Members Live Statistics</span></li>
    </div>
                      <div class="row" style="display:block">       
<div class="alert alert-danger" role="alert">
  <b>Dear Admin,</b>
 <br> Please be informed that this page is currently under development as we are actively carrying out system maintainence 
 to bring you the best user experience. Kindly exercise patience and exit this page, we'll be done in due time.
<br>
Thank you.
</div>
                    </div>
                    </div>
                    
                    
                    <div class="row">
                        
                        
                        
                        
                     <div class="col-lg-4">
                            <div class="card card-box bg-premium-dark border-0 text-light mb-5">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="font-weight-bold">
                                            <small class="text-white-50 d-block mb-1 text-uppercase">Total Members</small>
                                            <span class="font-size-xxl mt-1">0</span>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="bg-white text-center text-success font-size-xl d-50 rounded-circle">
                                                <i class="far fa-lightbulb"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>    
                        
                        
                        
                        
                        
                        
                       <div class="col-lg-4">
                            <div class="card card-box bg-premium-dark border-0 text-light mb-5">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="font-weight-bold">
                                            <small class="text-white-50 d-block mb-1 text-uppercase">Male</small>
                                            <span class="font-size-xxl mt-1">0</span>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="bg-white text-center text-success font-size-xl d-50 rounded-circle">
                                                <i class="far fa-lightbulb"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>  
                        
                        <div class="col-lg-4">
                            <div class="card card-box bg-premium-dark border-0 text-light mb-5">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="font-weight-bold">
                                            <small class="text-white-50 d-block mb-1 text-uppercase">Female</small>
                                            <span class="font-size-xxl mt-1">0</span>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="bg-white text-center text-success font-size-xl d-50 rounded-circle">
                                                <i class="far fa-lightbulb"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="card card-box mb-5">
                        <div class="card-header">
                            <div class="card-header--title">
                                <b>Accounts Summary</b>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
        <span id="message_operation"></span>
  			<table class="table table-striped table-bordered" id="user_table">
  				<thead>
  					<tr>
						  <th>S/N</th>
  						<th>Name</th>
  						<th>Member ID</th>
  						<th>Wallet Balance</th>
              			<th>Contribution Balance</th>
  						<th>Loan Balance</th>
  						<th>Last Seen</th>
  					</tr>
  				</thead>
  				<tbody>

  				</tbody>
  			</table>
  		</div>
                         </div>
                                <script>
      $(document).ready(function(){
	        var dataTable = $('#user_tabl e').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[], 
		"ajax":{
			url:"authController/statsboard_process.php",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
				"targets":[0, 1, 2, 3, 4, 5],
				"orderable":false,
			},
		],
	});
});
</script>    
                    </div>
       
       </div>
          <?php include 'inc/footerb.php'; ?>
