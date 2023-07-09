<?php include 'inc/nav.php'; ?>

    <!-- ========================= signup-style-2 start ========================= -->
    <section class="signup signup-style-2 mb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="signup-content-wrapper">
                        <div class="section-title">
                            <h3 class="mb-20">Create New Password</h3>
                            <p>Fill in your new password to regain access to your account.</p>
                        </div>
                        <div class="image">
                            <img src="assets/img/signup/signup-2/signup-img.svg" alt="" class="w-100">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                 
                         
                   
             



                    <div class="signup-form-wrapper">
                          <form id="verify-otp-form" method="POST" autocomplete="off">

                        <div id="operation-response"></div>
                        
                            <div class="single-input">
                                <label for="confirm-pass">New Password</label>
                                <input type="password" id="confirm-pass" name="password" placeholder="New Password" required>
                                <div id="error_password" style="color: red"> </div>
                            </div>
                            
                             <div class="single-input">
                                <label for="confirm-new-pass">Confirm New Password</label>
                                <input type="password" id="confirm-new-pass" name="confirm_password" placeholder="Confirm Password" required>
                                <div id="error_confirm_password" style="color: red"> </div>
                            </div>

                            <div class="signup-button mb-25">
                            <input type="hidden" name="action" value="change-password">
                           <button class="button button-lg radius-10 btn-block btn" type="button" onclick="saveNewPassword()">Save </button>
                            </div>

                        </form>
                    </div>







    
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    
    <script>
function reset_error()
  {
    $('#error_code').text('');
     $('#error_password').text('');
    $('#error_confirm_password').text('');
  }
    
    
function saveNewPassword(){
     $.ajax({
        url: "authController/recover_process",
        type: "POST",
        beforeSend:function(){
        	reset_error();
       },
        data: $("#verify-otp-form").serialize(),
        dataType: "json",
        success: function (data) {
                if(data.approved){
                     $('#operation-response').html('<div class="alert alert-success text-center">'+data.notice+'</div>');
                    location.href = data.protocol;   
                }
                if(data.error) {
                    $('#operation-response').html('<div class="alert alert-danger text-center">'+data.notice+'</div>');
                      if(data.error_password != '')
                      {
                        $('#error_password').text(data.error_password);
                      } 
            			else {
                        $('#error_password').text('');
                      }
                      
                      if(data.error_confirm_password != '')
                      {
                        $('#error_confirm_password').text(data.error_confirm_password);
                      } 
            			else {
                        $('#error_confirm_password').text('');
                      }
                 } 
            	
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
	} 
	</script>
    
    
    
    
    
    
    
    
    
    
    <!-- ========================= signup-style-2 end ========================= -->

          <?php include 'inc/footer.php'; ?>