<?php include 'inc/navb.php'; ?>
          
            <div class="app-content">
                <div class="app-content--inner">
                    
         
                      <div class="page-title">             
                      <div class="row" style="display:block">       

                    </div>
                    </div>
                    
                    
                    <div class="row">
                        
                        
                        
                        
                     <div class="col-lg-4">
                            <div class="card card-box bg-premium-dark border-0 text-light mb-5">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="font-weight-bold">
                                            <small class="text-white-50 d-block mb-1 text-uppercase">Expenditure Balance</small>
                                            <span class="font-size-xxl mt-1">N <?php echo number_format(getTotalExpenditureBalance()); ?></span>
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
                                            <small class="text-white-50 d-block mb-1 text-uppercase">Registration Balance</small>
                                            <span class="font-size-xxl mt-1">N <?php echo number_format(getTotalSignUpBalance()); ?> </span>
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
                                            <small class="text-white-50 d-block mb-1 text-uppercase">Total Wallet Balance</small>
                                            <span class="font-size-xxl mt-1">N <?php echo number_format(getTotalWalletBalance()); ?> </span>
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
                            <div class="card card-box bg-midnight-bloom text-light mb-5">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="font-weight-bold">
                                            <small class="text-white-50 d-block mb-1 text-uppercase">Total Contributions Balance</small>
                                            <span class="font-size-xxl mt-1">N <?php echo number_format(getTotalContribution()); ?></span>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="bg-white text-center text-primary font-size-xl d-50 rounded-circle">
                                                <i class="far fa-snowflake"></i>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-box bg-plum-plate text-light mb-5">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="font-weight-bold">
                                            <small class="text-white-50 d-block mb-1 text-uppercase">Total Loan Balance</small>
                                            <span class="font-size-xxl mt-1">N <?php echo number_format(getTotalLoan()); ?></span>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="bg-white text-center text-primary font-size-xl d-50 rounded-circle">
                                                <i class="fas fa-battery-three-quarters"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                        <div class="col-lg-4">
                            <div class="card card-box bg-plum-plate text-light mb-5">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="font-weight-bold">
                                            <small class="text-white-50 d-block mb-1 text-uppercase">Total Balance</small>
                                            <span class="font-size-xxl mt-1">N <?php echo number_format(getTotalBalance()); ?> </span>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="bg-white text-center text-primary font-size-xl d-50 rounded-circle">
                                                <i class="fas fa-battery-three-quarters"></i>
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
                                <b>Transaction Records</b>
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
  						<th>Transaction Type</th>
  						<th>Amount</th>
              			<th>Currency</th>
  						<th>Reference</th>
  						<th>Status</th>
  						<th>Date</th>
  					</tr>
  				</thead>
  				<tbody>

  				</tbody>
  			</table>
  		</div>
                         </div>
                                <script>
      $(document).ready(function(){
	        var dataTable = $('#user_table').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[], 
		"ajax":{
			url:"authController/index_process.php",
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
