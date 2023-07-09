<?php include 'inc/navb.php'; ?>
          
          <div class="app-content">
              <div class="app-content--inner">
                  <div class="page-title">
                      <div>
                          <h5 class="display-4 mt-1 mb-2 font-weight-bold"> Loan Request</h5>

                      </div>
 
  <div class="card-body" id="loanForm-card-body">
        <form _lpchecked="1" id="loanForm">
  <div class="form-group">
    <label for="seeAnotherField">Select loan Type</label>
    <select class="form-control" id="seeAnotherField" name="loan_type">
          <option value="">Select Loan Type</option>
          <option value="1">Project loan</option>
          <option value="2">Emergency Loan</option>
    </select>
     <div id="error_type" style="color: red"> </div>
  </div>
  
  
  <div class="form-group">
    <label for="loanTenureField">Loan Tenure</label>
    <select class="form-control" id="loanTenureField" name="loan_tenure">
        <option value="">Loan Duration</option>
        
          <option value="3">3 months</option>
          <option value="6">6 months</option>
          <option value="9">9 months</option>
          <option value="12">12 months</option>
          <option value="18">18 months</option>
          <option value="21">21 months</option>
          <option value="24">24 months</option>
          <?php if (getUserInfo("package")!=1) {?>
            <option value="30">30 months</option>
          <option value="36">36 months</option>
          <option value="42">42 months</option>
          <option value="60">60 months</option>
          <?php } ?>
    </select>
     <div id="error_tenure" style="color: red"> </div>
  </div>
  
  
  <div class="form-group" id="otherFieldDiv">
    <label for="otherField1">Choose a Guarantor (1) </label>
    <select class="form-control" id="otherField1" name="guarantor_one">
       <?php echo getUserList(); ?>
    </select>
    	 <div id="error_guarantor_one" style="color: red"> </div>
  </div>
  
   <div class="form-group" id="otherFieldDiv">
    <label for="otherField2">Another Guarantor (2)</label>
    <select class="form-control" id="otherField2" name="guarantor_two">
     <?php echo getUserList(); ?>
    </select>
	 <div id="error_guarantor_two" style="color: red"> </div>
  </div>

  <div class="form-group">
    <label for="seeAnotherFieldGroup">Loan Amount</label>
    <input placeholder="0.00" class="form-control" id="amount" name="amount" type="number">
	 <div id="error_amount" style="color: red"> </div>
  </div>
  
    <div id="loanForm-interest-box"></div>
  
  <div class="form-group">
    <label for="comments">Why do you want this loan?</label>
    <textarea class="form-control" id="comments" rows="3" placeholder="I want this loan because..." name="reason"></textarea>
	 <div id="error_reason" style="color: red"> </div>
  </div>
  
   <div class="form-group">
       <input type="hidden" name="action" value="loan_request">
    <button type="button" class="btn btn-pill btn-primary btn-sm" onclick="loanRequest()" id="loanApplyBtn">Apply Now</button>
  </div>
  
 
</form>

    </div>
    
    <script>
	 //process
	  $('#loanTenureField').on('change', function() {
	      $('#amount').val('');
	  });
	 
	   
	 $('#amount').on('keyup', function() {
        var amount = $(this).val();
        var duration = $('#loanTenureField').val();
        	$.ajax({
              url:"authController/loan_process.php",
              type:"POST",
              data:{amount: amount, duration:duration, action: 'calculateInterest'},
              dataType: "json",
              beforeSend:function(){
                  $("#loanForm-interest-box").html(''); 
                  $('#loanApplyBtn').attr('disabled', true);
              },
              success:function(data){ 
                  $('#loanApplyBtn').attr('disabled', false);
                  if(data.success){
                    $("#loanForm-interest-box").html('<div class="alert alert-success"><p><b>Loan Duration:</b> '+data.duration+' months</p><p><b>Monthly Due:</b> N'+data.monthlydue+'</p><p>The following amount <b>N'+data.biweekly+'</b> will be deducted from your bi-weekly pay.</p></div>');
                  }
                  if(data.failed) {
                      $("#loanForm-interest-box").html('<div class="alert alert-danger">'+data.interest+'</div>');
                  }
              }
		
	    });
        
        
        
        
        
    });
	
    function reset_error()
  {
    $('#error_type').text('');
    $('#error_amount').text('');
    $('#error_tenure').text('');
    $('#error_guarantor_one').text('');
    $('#error_guarantor_two').text('');
    $('#error_reason').text('');
  }
	 
	 
   function loanRequest(){
			$.ajax({
              url:"authController/loan_process.php",
              type:"POST",
              data: $('#loanForm').serialize(),
              dataType: "json",
              beforeSend:function(){
        	        reset_error();
                 },
              success:function(data){
                  if(data.success){
                    $("#loanForm-card-body").html(data.html);
                  }
                  if(data.failed){
                    $("#loanForm-card-body").html(data.html);
                  }
                  if(data.error) {
                      $(window).scrollTop(0);
	      if(data.error_type != '')
          {
            $('#error_type').text(data.error_type);
          } 
			else {
            $('#error_type').text('');
          }
	    
			if(data.error_amount != '')
          {
            $('#error_amount').text(data.error_amount);
          } 
			else {
            $('#error_amount').text('');
          }
          
          if(data.error_guarantor_one != '')
          {
            $('#error_guarantor_one').text(data.error_guarantor_one);
          } 
			else {
            $('#error_guarantor_one').text('');
          }
         
         if(data.error_guarantor_two != '')
          {
            $('#error_guarantor_two').text(data.error_guarantor_two);
          } 
			else {
            $('#error_guarantor_two').text('');
          }
          
          if(data.error_reason != '')
          {
            $('#error_reason').text(data.error_reason);
          } 
			else {
            $('#error_reason').text('');
          }
          if(data.error_tenure != '')
          {
            $('#error_tenure').text(data.error_tenure);
          } 
			else {
            $('#error_tenure').text('');
          }
          if(data.error_duplicate != '')
          {
            $('#error_guarantor_one').text(data.error_duplicate);
            $('#error_guarantor_two').text(data.error_duplicate);
          }
	} 
              }
		
	    });

	}
	</script>
    
    
    
    
                  </div>
                      </div>
                  </div>
                
     
        <?php include 'inc/footerb.php'; ?>