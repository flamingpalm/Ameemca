<?php 
require_once("../DB.php");
require_once('../../libraries/inc/mailer/Mail.php');
/*
$_POST["action"] = "signup";
$_POST["first_name"] = "girl";
$_POST["last_name"] = "boy";
$_POST["package"] = "1";
$_POST["user_email"] = "skytweaks@gmail.com";
$_POST["password"] = "12345";
$_POST["confirm_password"] = "12345";
$_POST["staffid"] = "00099990";
*/

if($_POST["action"] == "signup")
	{
$error = 0;
$package = "";
$first_name = "";
$last_name = "";
$user_email = "";
$password = "";
$confirm_password = "";

$error_package = "";
$error_first_name = "";
$error_last_name = "";
//$error_staffid = "";
$error_user_email = "";
$error_password = "";
$error_confirm_password = "";

$employee_number = "";
$error_employee_number = "";
$agency_bureau = "";
$error_agency_bureau = "";
$employee_post = "";
$error_employee_post = "";
$home_address = "";
$error_home_address = "";




//Reg Fee
        if(empty($_POST["package"]) || empty($_POST["rfee"]))
		{
			$error_package = 'Select a package';
			$error++;
		}
		else {
			$package = sanitizeNumber($_POST["package"]);
			$reg_fee = sanitizeNumber($_POST["rfee"]);
		}
		
        if(empty($_POST["first_name"]))
		{
			$error_first_name = 'Provide your first name';
			$error++;
		}
		else {
			$first_name = sanitizeText($_POST["first_name"]);
		}

        if(empty($_POST["last_name"]))
		{
			$error_last_name = 'Provide your last name';
			$error++;
		}
		else {
			$last_name = sanitizeText($_POST["last_name"]);
		}
		

       
        if(empty($_POST["user_email"]))
		{
			$error_user_email = 'Provide your email address';
			$error++;
		} else {
		    $clean = sanitizeEmail($_POST["user_email"]);
		    $allowedMail = array("state.gov","usaid.gov","wrp-n.gov","cdc.gov");
			$split1 = explode("@", $clean);
			if(!in_array($split1[1], $allowedMail)){
		    $error_user_email = 'Sorry, this mail host is not allowed.';
		    $error++;
			}else{
			    $user_email = $clean;
			    
			}
		}
		
		if(empty($_POST["password"]))
		{
			$error_password = 'Password is required';
			$error++;
		}
		else {
		if(strlen($_POST["password"]) > 20)
                {
                    $error_password =  "Your password must be of minimum length 8 and maximum length 20.";
                    $error++;
                } else if(strlen($_POST["password"]) < 8)
                {
                    $error_password =  "Your password must be of minimum length 8.";
                    $error++;
                } else {
                    $password = sanitizePassword($_POST["password"]);
         }   
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
		

if(empty($_POST["employee_number"]))
{
	$error_employee_number = 'Employee number is required';
	$error++;
} else {
	$employee_number = sanitizeNumber($_POST["employee_number"]);
}

if(empty($_POST["agency_bureau"]))
{
	$error_agency_bureau = 'Agency/Bureau is required';
	$error++;
} else {
	$agency_bureau = sanitizeText($_POST["agency_bureau"]);
}



if(empty($_POST["employee_post"]))
{
	$error_employee_post = 'Employee post is required';
	$error++;
} else {
	if(sanitizeNumber($_POST["employee_post"]) ==1){
	    $employee_post = '56002-Nigeria-Lagos';
	}else if(sanitizeNumber($_POST["employee_post"]) ==2){
	    $employee_post = '56002-Nigeria-Abuja';
	} else {
	     $employee_post = 'Error';
	}
}

if(empty($_POST["home_address"]))
{
	$error_home_address = 'Home address is required';
	$error++;
} else {
	$home_address = sanitizeText($_POST["employee_post"]);
}	
		
		
		 if($error > 0){
		   //error
		          $output = array (
		                'error'=> true,
                        'error_package'=> $error_package,
                        'error_firstname'=> $error_first_name,
                        'error_lastname'=> $error_last_name,
                        'error_staffid'=> $error_staffid,
                        'error_email'=> $error_user_email,
                        'error_password'=> $error_password,
                        'error_confirm_password'=> $error_confirm_password,
                        'error_employee_number'=> $error_employee_number,
                        'error_agency_bureau'=> $error_agency_bureau,
                        'error_employee_post'=> $error_employee_post,
                        'error_home_address'=> $error_home_address
                    );   
		    }else{
		            //valid info
		        
		        //email check
            $data = array (':email'=> $user_email);
            $query = "SELECT * FROM usertable
                WHERE email = :email
                LIMIT 1";
                $statement = $connect->prepare($query);
                $statement->execute($data);
                $result = $statement->rowCount();
                if($result > 0){
                     $output = array (
		                'error'=> true,
                        'error_email'=> "The email you entered already exists"
                    ); 
                } else {
                    //staffid check
                $data = array (':employee_number'=> $employee_number);
                $query = "SELECT * FROM usertable
                WHERE employee_number = :employee_number
                LIMIT 1";
                $statement = $connect->prepare($query);
                $statement->execute($data);
                $result = $statement->rowCount();
                if($result > 0){
                     $output = array (
		                'error'=> true,
                        'error_staffid'=> "The Employee number you entered already exists"
                    ); 
                } else {
                   
                   //Send OTP
                        $staffid = generateStaffid();
                        $code = rand(11111, 99999);
                        $username = $first_name;
                        $useremail = $user_email;
                        $title = "Welcome To Ameemca";
        	             $body = signupNotify($useremail, $username, $code, $staffid);
        	             $mailSuccess = Mail::cpanelMailer($title, $useremail, $body);
                        if($mailSuccess){
                            //Register User
                                    $data = array (
                                        ':package'=> $package,
                                        ':fname'=> $first_name,
                                        ':lname'=> $last_name,
                                        ':staffid'=> $staffid,
                                        ':email'=> $user_email,
                                        ':password'=> password_hash($password, PASSWORD_BCRYPT),
                                        ':status'=> "notverified",
                                        ':code'=> $code,
                                        ':avatar'=> 'assets/user_image/default_user.svg',
                                        ':agency_bureau'=> $agency_bureau,
                                        ':employee_post'=> $employee_post,
                                        ':address'=> $home_address,
                                        ':employee_number'=> $employee_number,
                                        ':reg_fee'=> $reg_fee
                                        );
                                        
                                        
                    
             $query = "INSERT INTO usertable (fname, lname, email, password, code, status, package, staffid, photo, agency_bureau, employee_post, address, employee_number, reg_fee)
                VALUES (:fname, :lname, :email, :password, :code, :status, :package, :staffid, :avatar, :agency_bureau, :employee_post, :address, :employee_number, :reg_fee)";
            $statement = $connect->prepare($query);
                                    if($statement->execute($data)){
                                        
                                        //setup account balances
                                        initAccountBalance($staffid);
                                        initContributionBalance($staffid);
                                        initLoanBalance($staffid);
                                        
                                        
                                        //registration successful
                                       $info = "We've sent a verification code to your email - $user_email";
                                        $_SESSION['info'] = $info;
                                        $output = array(
                    						'approved' => true,
                    						'notice' =>	$info,
                    						'amount'=> getPackagePriceByID($package),
                    						'protocol' => 'user-otp'
                						    );
                                    }else{
                                        //registration failed
                                        $output = array(
                    						'failed' => true,
                    						'notice'	=>	"Registeration Failed - Database error."
                						);
                                    }
                        } else {
                             //Mail not sent
                                $output = array(
            						'failed' => true,
            						'notice'	=>	"Registeration Failed - Mail not sent.",
            						'protocol' => '/'
        						);
                        }//send otp

                    
                    }//staffid check
                }//email check
   
		    }//no errors
		

echo json_encode($output);
exit();
}

                        

if($_POST["action"] == "getpackageprice")
	{
	    $error = 0;
$package = "";
$first_name = "";
$last_name = "";
//$staffid = "";
$user_email = "";
$password = "";
$confirm_password = "";

$error_package = "";
$error_first_name = "";
$error_last_name = "";
//$error_staffid = "";
$error_user_email = "";
$error_password = "";
$error_confirm_password = "";

$employee_number = "";
$error_employee_number = "";
$agency_bureau = "";
$error_agency_bureau = "";
$employee_post = "";
$error_employee_post = "";
$home_address = "";
$error_home_address = "";

            if(empty($_POST["package"]))
		{
			$error_package = 'Select a package';
			$error++;
		}
		else {
			$package = sanitizeNumber($_POST["package"]);
		}
		
        if(empty($_POST["first_name"]))
		{
			$error_first_name = 'Provide your first name';
			$error++;
		}
		else {
			$first_name = sanitizeText($_POST["first_name"]);
		}

        if(empty($_POST["last_name"]))
		{
			$error_last_name = 'Provide your last name';
			$error++;
		}
		else {
			$last_name = sanitizeText($_POST["last_name"]);
		}


        if(empty($_POST["user_email"]))
		{
			$error_user_email = 'Provide your email address';
			$error++;
		} else {
		    $clean = sanitizeEmail($_POST["user_email"]);
		    $allowedMail = array("state.gov","usaid.gov","wrp-n.gov","cdc.gov");
			$split1 = explode("@", $clean);
			if(!in_array($split1[1], $allowedMail)){
			    $error_user_email = 'Sorry, this mail host is not allowed.';
			    $error++;
			  
			}else{
			    $user_email = $clean;
			}
		}
		
		if(empty($_POST["password"]))
		{
			$error_password = 'Password is required';
			$error++;
		}
		else {
		if(strlen($_POST["password"]) > 20)
                {
                    $error_password =  "Your password must be of minimum length 8 and maximum length 20.";
                    $error++;
                } else if(strlen($_POST["password"]) < 8)
                {
                    $error_password =  "Your password must be of minimum length 8.";
                    $error++;
                } else {
                    $password = sanitizePassword($_POST["password"]);
         }   
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
		

if(empty($_POST["employee_number"]))
{
	$error_employee_number = 'Employee number is required';
	$error++;
} else {
	$employee_number = sanitizeNumber($_POST["employee_number"]);
}

if(empty($_POST["agency_bureau"]))
{
	$error_agency_bureau = 'Agency/Bureau is required';
	$error++;
} else {
	$agency_bureau = sanitizeText($_POST["agency_bureau"]);
}



if(empty($_POST["employee_post"]))
{
	$error_employee_post = 'Employee post is required';
	$error++;
} else {
	$employee_post = sanitizeText($_POST["employee_post"]);
}

if(empty($_POST["home_address"]))
{
	$error_home_address = 'Home address is required';
	$error++;
} else {
	$home_address = sanitizeText($_POST["employee_post"]);
}	
		
		
		
		 if($error > 0){
		   //error
		          $output = array (
		                'error'=> true,
                        'error_package'=> $error_package,
                        'error_firstname'=> $error_first_name,
                        'error_lastname'=> $error_last_name,
                        //'error_staffid'=> $error_staffid,
                        'error_email'=> $error_user_email,
                        'error_password'=> $error_password,
                        'error_confirm_password'=> $error_confirm_password,
                        'error_employee_number'=> $error_employee_number,
                        'error_agency_bureau'=> $error_agency_bureau,
                        'error_employee_post'=> $error_employee_post,
                        'error_home_address'=> $error_home_address
                    );   
		    }else{
		        
		        //email check
            $data = array (':email'=> $user_email);
            $query = "SELECT * FROM usertable
                WHERE email = :email
                LIMIT 1";
                $statement = $connect->prepare($query);
                $statement->execute($data);
                $result = $statement->rowCount();
                if($result > 0){
                     $output = array (
		                'error'=> true,
                        'error_email'=> "The email you entered already exists"
                    ); 
                } else {
                    //staffid check
                $data = array (':employee_number'=> $employee_number);
                $query = "SELECT * FROM usertable
                WHERE employee_number = :employee_number
                LIMIT 1";
                $statement = $connect->prepare($query);
                $statement->execute($data);
                $result = $statement->rowCount();
                if($result > 0){
                     $output = array (
		                'error'=> true,
                        'error_employee_number'=> "The Employee number you entered already exists"
                    ); 
                } else {

                        $output = array( 'approved'=> true,'amount'=> getPackagePriceByID($package));

                    }//staffid check
                }//email check
    
		    }//no errors

            echo json_encode($output);
            exit();
    }

