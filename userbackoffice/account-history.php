

          <?php include 'inc/navb.php'; ?>
         
            <div class="app-content">
<div class="app-content--inner">
                <div class="page-title">
    <div>
        <h5 class="display-4 mt-1 mb-2 font-weight-bold">Transaction History</h5>
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
                                        <span class="badge badge-pill badge-primary" style="padding: 12px;height: 0;line-height: 0;">Balance: N<?php if(getAccountBalance($staffid) == "0"){ echo "0.00"; }else{ echo number_format(getAccountBalance($staffid));} ?></span>
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
  		
  
  		
  		
  		
  		
       <script>
      $(document).ready(function(){
	        var dataTable = $('#user_table').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[], 
		"ajax":{
			url:"authController/transaction_process",
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


            


                    


                </div>
            </div>
       
          <?php include 'inc/footerb.php'; ?>
           
</div>