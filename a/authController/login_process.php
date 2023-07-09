<?php 
require_once("../../userbackoffice/DB.php");


if($_POST["action"] == "login")
	{

$error = 0;
$email = "";
$password = "";

$error_email = "";
$error_password = "";

        if(empty($_POST["email"]))
		{
			$error_email = 'Email ID is required.';
			$error++;
		}
		else {
			$email = $_POST["email"];
		}
		
        if(empty($_POST["password"]))
		{
			$error_password = 'Password is required.';
			$error++;
		}
		else {
			$password = $_POST["password"];
		}
	 
	 
	 if($error > 0){
		   //error
		          $output = array (
		                 'error'=> true,
		                 'notice'=> "Kindly provide your information",
                         'error_email'=> $error_email,
                         'error_password'=> $error_password
                    );   
		    }else{
	       $data = array (':email'=> $email);
            $query = "SELECT * FROM admin
                WHERE email = :email
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
    	                $admin_id = $row['id'];
                        $admin_pass = $row['password'];
                    }
	              if(password_verify($password, $admin_pass)){
                            $_SESSION['admin_id'] = $admin_id;
                       if(!empty($_SESSION['admin_id'])){
                                $output = array(
                    				'approved' => true,
                    				'notice' =>	"Sign In Approved",
                    				'protocol' => 'index'
                					); 
                           
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
