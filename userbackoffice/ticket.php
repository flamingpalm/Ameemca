<?php
$statusMsg = '';
$msgClass = '';
if(isset($_POST['submit'])){
    // Get the submitted form data
    $email = $_POST['email'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Check whether submitted data is not empty
    if(!empty($email) && !empty($name) && !empty($subject) && !empty($message)){
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $statusMsg = 'Please enter your valid email.';
            $msgClass = 'errordiv';
        }else{
            // Recipient email
            $toEmail = 'info@ameemca.ng';
            $emailSubject = 'support Request Submitted by '.$name;
            $htmlContent = '<h2>support Request Submitted</h2>
                <h4>Name</h4><p>'.$name.'</p>
                <h4>Email</h4><p>'.$email.'</p>
                <h4>Subject</h4><p>'.$subject.'</p>
                <h4>Message</h4><p>'.$message.'</p>';
            
            // Set content-type header for sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // Additional headers
            $headers .= 'From: '.$name.'<'.$email.'>'. "\r\n";
            
            // Send email
            if(mail($toEmail,$emailSubject,$htmlContent,$headers)){
                $statusMsg = 'Your ticket has been submitted successfully !';
                $msgClass = 'succdiv';
            }else{
                $statusMsg = 'Your ticket submission failed, please try again.';
                $msgClass = 'errordiv';
            }
        }
    }else{
        $statusMsg = 'Please fill all the fields.';
        $msgClass = 'errordiv';
    }
}
?>
<?php include 'inc/navb.php'; ?>
          
            <div class="app-content">
<div class="app-content--inner">
                <div class="page-title">
    <div>
        <h5 class="display-4 mt-1 mb-2 font-weight-bold">Support</h5>
        <hr>
    </div>
    <div class="mt-10">
        <div class="contactFrm">
    <?php if(!empty($statusMsg)){ ?>
        <p class="statusMsg <?php echo !empty($msgClass)?$msgClass:''; ?>"><?php echo $statusMsg; ?></p>
    <?php } ?>
    <form action="" method="post">
        <h4>Name</h4>
        <input  class="form-control" type="text" name="name" value="<?php echo ucfirst(getUserInfo("fname")).' '.ucfirst(getUserInfo("lname")); ?>">
        <h4>Email </h4>
       
        <input class="form-control" type="email" name="email" value="<?php echo getUserInfo("email"); ?>">
        
        <h4>Subject</h4>
        <input  class="form-control" type="text" name="subject" placeholder="Write subject" required="">
        <h4>Message</h4>
        <textarea  class="form-control" name="message" placeholder="Write your message here" required=""> </textarea>
        <input class="main-btn" type="submit" name="submit" value="Submit">
        <div class="clear"> </div>
    </form>
</div>
           
    </div>
</div>

                </div>
            </div>
       
          <?php include 'inc/footerb.php'; ?>
</div>