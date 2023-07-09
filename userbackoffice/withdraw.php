     <?php include 'inc/navb.php'; ?>
        
            <div class="app-content">
<div class="app-content--inner">
                <div class="page-title">
    <div>
        <h5 class="display-4 mt-1 mb-2 font-weight-bold">Funds Withdrawal</h5>
        <li><span>Withdraw funds from your ameemca savings wallet to your local bank.</span></li>
        <li><span>NOTE: This might take up to 24hrs processing period.</span></li>
    </div>
    
 <div class="alert alert-danger" role="alert">
  <b>Dear Admin,</b>
 <br> Please be informed that this page is currently under maintenance as we are actively carrying out system maintainence 
 to bring you the best user experience. Kindly exercise patience and exit this page, we'll be done in due time.
<br>
Thank you.
</div>
</div>


                <div class="container">
                    <div class="card card-box mb-5">


                        
    <div class="card-header">
         <div style="display: flex;justify-content: space-between;">
                                              <div class=" mb-2">
                                                  <b>Withdrawal History</b>
                                              </div>
                                              <div class=" mb-2">
                                                  <span class="badge badge-pill badge-primary" style="padding: 12px;height: 0;line-height: 0;">Savings Balance: N<?php if(getAccountBalance($staffid) == "0"){ echo "0.00"; }else{ echo number_format(getAccountBalance($staffid));} ?></span>
                                            </div>
                                            </div>
        
    </div>
    <div class="divider"></div>
    <div class="card-body" id="withdrawal-card-body">
        <form _lpchecked="1" id="paymentForm">
            <div class="form-row">
                <div class="form-group col-md-12">
            <label class="d-block" for="form-3-select">Select Bank</label>
            <div class="input-group mb-4">
            <select class="custom-select w-100" id="banklist" required>
              <?php  echo getUserBankList(); ?>
            </select>
             </div>
             
             <div id="display_info"></div>
             
    </div>
            </div>
       
</form>

    </div>
</div>
                  

<script>
    //here
    $('#banklist').on('change', function() {
		var bid = $("#banklist option:selected").val();
		$.ajax({
              url:"authController/withdraw_process.php",
              type:"POST",
              data: {bid: bid, action:'fetch_info'},
              dataType: "json",
              success:function(r){ 
                var len = r.length;
                $("#display_info").empty();
                $("#display_info").append(r);
              }
		
	    });
	
	});
	
	
	 //process
   function processWithdrawal(){
		var a = $("#amount").val();
		var b = $("#reason").val();
		var c = $("#recipient").val();
			$.ajax({
              url:"authController/withdraw_process.php",
              type:"POST",
              data: {amount: a, reason: b, recipient: c, action:'process_withdrawal'},
              dataType: "json",
              success:function(r){  
                  $("#withdrawal-card-body").html(r);
              }
		
	    });
		

		
	    
	
	}
	
	
	
	
	
	
	
</script>
                    

 
                </div>
            </div>
       
          <?php include 'inc/footerb.php'; ?>
</div>