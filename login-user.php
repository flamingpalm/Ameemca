<?php require_once '../userbackoffice/inc/nav.php'; ?>
    

    <!-- ========================= signup-style-2 start ========================= -->
    <section class="signup signup-style-2 mb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="signup-content-wrapper">
                        <div class="section-title">
                            <h3 class="mb-20">Admin Login</h3>
                            <p>Please fill in the required information to access your account</p>
                        </div>
                        <div class="image">
                            <img src="img/login-img.svg" alt="" class="w-100">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="signup-form-wrapper">
                        <form id="login-form">

                        <div id="operation-response"> </div>

                            <div class="single-input">
                                <label for="signup-email">Email</label>
                                <input type="email" id="signup-email" name="email" placeholder="Email Address" required>
                            </div>

                            <div class="single-input">
                                <label for="signup-password">Password</label>
                                <input type="password" id="signup-password" name="password" placeholder="Password">
                            </div>

                            <div class="signup-button mb-25">
                                <input type="hidden" name="action" value="login">
                           <button class="button button-lg radius-10 btn-block btn" type="button" onclick="loginUser()"> Sign In </button>
                            </div>
                            
                            
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    
    
      <script>

function reset_error()
  {
   $('#operation-response').html('<div class="alert alert-primary text-center">Authenticating...</div>');
  }
    
    
function loginUser(){
     $.ajax({
        url: "authController/login_process.php",
        type: "POST",
        beforeSend:function(){
        	reset_error();
       },
        data: $("#login-form").serialize(),
        dataType: "json",
        success: function (data) {
                if(data.approved){
                     $('#operation-response').html('<div class="alert alert-success text-center">'+data.notice+'</div>');
                    location.href = data.protocol;   
                }
                if(data.error) {
                    $('#operation-response').html('<div class="alert alert-danger text-center">'+data.notice+'</div>');
                 } 
            	
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
	} 
	</script>
    
    <!-- ========================= signup-style-2 end ========================= -->
        <?php include '../userbackoffice/inc/footer.php'; ?>
  