<?php 
require_once("../DB.php");


// $_POST["action"] = "login";
// $_POST["staffid"] = 54321;
// $_POST["password"] = "qwerty";

if($_POST["action"] == "login")
	{

$error = 0;
$staffid = "";
$password = "";

$error_staffid = "";
$error_password = "";

        if(empty($_POST["staffid"]))
		{
			$error_staffid = 'Staff ID is required.';
			$error++;
		}
		else {
			$staffid = sanitizeNumber($_POST["staffid"]);
		}
		
        if(empty($_POST["password"]))
		{
			$error_password = 'Password is required.';
			$error++;
		}
		else {
			$password = sanitizePassword($_POST["password"]);
		}
	 
	 
	 if($error > 0){
		   //error
		          $output = array (
		                'error'=> true,
		                 'notice'=> "Kindly provide your information",
                        'error_staffid'=> $error_staffid,
                        'error_password'=> $error_password
                    );   
		    }else{
	       $data = array (':staffid'=> $staffid);
            $query = "SELECT * FROM usertable
                WHERE staffid = :staffid
                LIMIT 1";
                $statement = $connect->prepare($query);
                $statement->execute($data);
                $result = $statement->rowCount();
	            if($result == 0){
                     $output = array (
		                'error'=> true,
                        'notice'=> "Invalid User"
                    ); 
                } else {  
	              //user exists
	              $UserInfo = $statement->fetchAll();
	              foreach($UserInfo as $row){
                    $user_pass = $row['password'];
                    $user_status = $row['status']; 
                     
                    $fname = $row["fname"];
	                $lname = $row["lname"];
	                $user_email = $row["email"];
	                $address = $row["address"];
	                $phone = $row["phone"];
	                $gender = $row["gender"];
    	            $state = $row["state"];
	                $country = $row["country"];
	                $nokfname = $row["nokfname"];
	                $noklname = $row["noklname"];
	                $nokemail = $row["nokemail"];
	                $nokaddress = $row["nokaddress"];
	                $nokphone = $row["nokphone"];
	                $nokgender = $row["nokgender"];
	                $nokstate = $row["nokstate"];
	                $nokcountry = $row["nokcountry"];
	              }
	              if(password_verify($password, $user_pass)){
                            $_SESSION['staffid'] = $staffid;
                       if(!empty($_SESSION['staffid'])){
                           //Check bio
                           if($user_status == 'verified'){
                            if($fname == '' || $lname == '' || $user_email == ''|| $address == '' || $phone == '' || $gender == ''|| $state == '' || $country == '' || 
                                $nokfname == '' || $noklname == '' || $nokemail == ''|| $nokaddress == '' || $nokphone == '' || $nokgender == ''|| $nokstate == '' || $nokcountry == '') {
                                $output = array(
                    				'approved' => true,
                    				'notice' =>	"Update your Bio",
                    				'protocol' => 'bio-setup'
                					);
                                }else{
                                $output = array(
                    				'approved' => true,
                    				'notice' =>	"Sign In Approved",
                    				'protocol' => 'index'
                					);
                                 } 
                        }else{
                            $info = "sorry you haven't verified your account yet! - $user_email";
                            $_SESSION['info'] = $info;
                            //Initiate otp mail function
                            $output = array(
                    				'approved' => true,
                    				'notice' =>	"Verify your Identity",
                    				'protocol' => 'user-otp'
                					);
                        }//check verified
                           
                       } else {
                            $output = array(
                    				'error' => true,
                    				'notice' =>	"Sorry, but we cant log you in right now!"
                					);
                       }//session check
 
	              }else {
	                  //Invalid Login Parameter
	                   $output = array (
		                'error'=> true,
                        'notice'=> "Invalid Login Parameter"
                    );
	              }
	              
	              
                }  
	               
		    }//error check
	    
	echo json_encode($output);
    exit();  
	}
