<?php include 'inc/navb.php'; ?>
          
            <div class="app-content">
<div class="app-content--inner">
                <div class="page-title">
    <div>
        <h5 class="display-4 mt-1 mb-2 font-weight-bold">Savings Wallet</h5>
        <li><span>Keep away some money for rainy days. Fund your ameemca wallet today.</span></li>
        <li><span>NOTE: This money goes to your ameemca savings wallet not your contribution wallet.</span></li>
    </div>
</div>


                <div class="container">

<!--<div class="alert alert-danger" role="alert">
  <b>Dear User,</b>
 <br> Please be informed that funds deposit is currently disabled as we are actively carrying out system maintainence 
 to bring you the best user experience. Kindly exercise patience, we'll be done in due time.
<br>
Thank you.
</div>-->
                    <div class="card card-box mb-5">
      <div class="card-header">
         <div style="display: flex;justify-content: space-between;">
                                              <div class=" mb-2">
                                                  <b>Save Now</b>
                                              </div>
                                         <div class=" mb-2">
                                        <span class="badge badge-pill badge-primary" style="padding: 12px;height: 0;line-height: 0;">Savings Balance: N<?php if(getAccountBalance($staffid) == "0"){ echo "0.00"; }else{ echo number_format(getAccountBalance($staffid));} ?></span>
                                            </div>
                                            </div>
        
    </div>
    <div class="divider"></div>
    <div class="card-body" id="depositForm">
        <form _lpchecked="1" id="paymentForm">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="d-block" for="form-3-select">Amount</label>
                    <div class="input-group">
                        <input class="form-control" placeholder="Amount" id="amount" type="text" type="number" required>
                        <div class="input-group-append">
                            <span class="input-group-text">.00</i></span>
                        </div>
                    </div>
                </div> 
            </div>
         
    <div class="form-row">
        <div class="form-group col-md-6">
             <input type="hidden" id="email-address" value="<?php echo getUserInfo("email"); ?>">
             <input type="hidden" id="transaction-type" value="deposit"/>
            <button class="btn btn-primary" type="submit" onclick="payWithPaystack()">Deposit</button>
        </div>
        
    </div>
</form>

    </div>
</div>


<script src="https://js.paystack.co/v1/inline.js"></script> 

<script>
function calculatePaymentFee(amount){
    return ((amount * 100)  + ((amount * 0.015)* 100));
}

const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();
   var amount = calculatePaymentFee(document.getElementById("amount").value);
   var real_amount = (document.getElementById("amount").value  * 100);
  let handler = PaystackPop.setup({
    key: '<?php echo $public_key_live; ?>',
    email: document.getElementById("email-address").value,
    amount: amount,
    ref: 'DEPOSIT_'+Math.floor((Math.random() * 1000000000) + 1), 
    metadata: {
        custom_fields: [
          {
            type: document.getElementById("transaction-type").value,
            real_amt: real_amount
          }
        ]
      },
    onClose: function(){
      console.log('Transaction Cancelled.');
    },
    callback: function(response){
      verifyDeposit(response.reference);
    }
  });
  handler.openIframe();
}
  
 function verifyDeposit(token){
     $.ajax({
        url: "authController/deposit_process.php",
        type: "POST",
        beforeSend:function(){},
        data: {action: "verify", token: token},
        dataType: "json",
        success: function (data) {
                if(data.approved){
                    $('#depositForm').html(data.notice);
                }
                if(data.failed){
                	$('#depositForm').html(data.notice);
                }
                if(data.error) {}
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
	}    
    
    
    
    
    
</script>
                    


                    


                </div>
            </div>
       
          <?php include 'inc/footerb.php'; ?>
</div>