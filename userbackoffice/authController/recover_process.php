<?php
require_once '../DB.php';



if($_POST["action"] == "check-email")
	{

$error = 0;
$email = "";
$error_email = "";

        if(empty($_POST["email"]))
		{
			$error_email = 'Email is required';
			$error++;
		}
		else {
			$email    = sanitizeEmail($_POST["email"]);
		}
		
        
	 if($error > 0){
		   //error
		          $output = array (
		                'error'=> true,
		                 'notice'=> "Kindly provide your email"
                    );   
		    }else{
	        $data = array (':email'=> $email);
            $query = "SELECT * FROM usertable
                WHERE email = :email
                LIMIT 1";
                $statement = $connect->prepare($query);
                $statement->execute($data);
                $result = $statement->rowCount();
	            if($result == 0){
                     $output = array (
		                'error'=> true,
                        'notice'=> "Invalid Email"
                    ); 
                } else {  
	              //user exists
	              
	              //generate code
	            $code = rand(999999, 111111);
	            $data = array (':email'=> $email, ':code'=> $code);
                $query = "UPDATE usertable SET code = :code WHERE email = :email";
                $statement = $connect->prepare($query);
                if($statement->execute($data)){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: Ameemca@ameemca.ng";
                if(mail($email, $subject, $message, $sender)){
                    $_SESSION['temp_mail'] = $email;
                    $output = array (
		                'approved'=> true,
                        'notice'=> "We've sent a passwrod reset code to your email - $email",
                        'protocol'=> 'reset-code'
                    );
                }else{
                     $output = array (
		                'error'=> true,
                        'notice'=> "Failed while sending code!"
                    );
                }
                } else {
                    //update failed
                    $output = array (
		                'error'=> true,
                        'notice'=> "An error occured!"
                    );
                }
	              

                }  
		    }//error check
	    
	echo json_encode($output);
    exit();  
	}

if($_POST["action"] == "check-reset-otp")
	{
$error = 0;
$code = "";
$error_code = "";

        if(empty($_POST["code"]))
		{
			$error_code = 'Code is required';
			$error++;
		}
		else {
			$code = sanitizeNumber($_POST["code"]);
		}
		
        
	        if($error > 0){
		        //error
		          $output = array (
		                'error'=> true,
		                'notice'=> "Kindly provide the code we sent."
                    );   
		    }else{
		        //code check
		        $data = array (':code'=> $code);
                $query = "SELECT * FROM usertable
                WHERE code = :code
                LIMIT 1";
                $statement = $connect->prepare($query);
                $statement->execute($data);
                $result = $statement->rowCount();
	            if($result == 0){
                     $output = array (
		                'error'=> true,
                        'notice'=> "Invalid Code"
                    ); 
                } else {
                   // code is valid
                   //set temporal email session 
                   
		           $output = array (
		                'approved'=> true,
                        'notice'=> "Code Verification Successful!",
                        'protocol'=> 'new-password'
                    );
                }
		     
		    }//error check

	echo json_encode($output);
    exit();
	}
	

	
//Change Password
if($_POST["action"] == "change-password")
	{
$error = 0;
$code = "";

$password = "";
$error_password = "";
$confirm_password = "";
$error_confirm_password = "";

        if(empty($_POST["password"]))
		{
			$error_password = 'Password is required';
			$error++;
		}
		else {
			$password = sanitizePassword($_POST["password"]);
		}
		
		if(empty($_POST["confirm_password"]))
		{
			$error_confirm_password = 'Confirm password';
			$error++;
		}
		else {
			$confirm_password = sanitizePassword($_POST["confirm_password"]);
		if($password !== $confirm_password){
            $error_confirm_password = "Password mismatch!";
            $error++;
        }
		}
		
        
	        if($error > 0){
		        //error
		          $output = array (
		                'error'=> true,
		                'notice'=> "Pay attention to the form below!",
                        'error_password'=> $error_password,
                        'error_confirm_password'=> $error_confirm_password
                    );   
		    }else{
		          //no error
		        $code = 0;
		        $data = array (':code'=> $code, ':password'=> password_hash($password, PASSWORD_BCRYPT), ':email'=>  $_SESSION['temp_mail']);
                $query = "UPDATE usertable SET code = :code, password = :password WHERE email = :email";
                $statement = $connect->prepare($query);
                $result = $statement->execute($data);
	            if($result){
	                //success
	                    unset($_SESSION['temp_mail']);//unset temp email
                    $output = array (
		                 'approved'=> true,
                         'notice'=> "Password Reset Successful! - You can now Login.",
                         'protocol'=> 'login-user'
                     );
                 } else {
                     //failed
                      $output = array (
		                'error'=> true,
                        'notice'=> "Failed to change your password!"
                     );
                 }
		    }//error check

	echo json_encode($output);
    exit();
	}	
	

