<?php 
session_start();
if($_SESSION['info'] == false){
  header('Location: login-user.php');
}
?>
<?php include 'inc/nav.php'; ?>

    <!-- ========================= signup-style-2 start ========================= -->
    <section class="signup signup-style-2 mb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="signup-content-wrapper">
                        <div class="section-title">
                            <h3 class="mb-20">Email Verification</h3>
                            <p>Verify your email to confirm your identity.</p>
                        </div>
                        <div class="image">
                            <img src="assets/img/signup/signup-2/signup-img.svg" alt="" class="w-100">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                 
                         
                   
             



<div class="signup-form-wrapper">
                          <form id="verify-otp-form" method="POST" autocomplete="off">

                                      <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div id="operation-response"><div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div></div>
                        
                        <?php
                    }
                    ?>                 
    
                            <div class="single-input">
                                <label for="verify-otp">One Time Password</label>
                                <input type="number" id="verify-otp" name="otp" placeholder="Enter verification code">
                            </div>

                            <div class="signup-button mb-25">
                            <input type="hidden" name="action" value="verifyotp">
                           <button class="button button-lg radius-10 btn-block btn" type="button" onclick="verifyOTP()">Verify </button>
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
  }
    
    
function verifyOTP(){
     $.ajax({
        url: "authController/userotp_process.php",
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



