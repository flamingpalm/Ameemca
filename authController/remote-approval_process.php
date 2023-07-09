<?php
require_once '../DB.php'; 
if($_POST["action"] == "save")
	{
require_once('../../libraries/inc/mailer/Mail.php');  
		    
	  
	    
$error = 0;
$password = "";
$error_password = ""; 
  

    if(empty($_POST["password"]))
		{
			$error_password = 'Account password is required.';
			$error++;
		}
		else {
			$password = sanitizePassword($_POST["password"]);
		}
		
$res = sanitizeText($_POST['res']);
$sid = sanitizeNumber($_POST['sid']);
$lid = sanitizeNumber($_POST['lid']);

		
		
		

	 if($error > 0){
		   //error
		          $output = array (
		                'error'=> true,
		                'notice'=> "Pay attention to the form below.",
                        'error_password'=> $error_password
                   );  
		}else{

             
                                $data = array (':id'=> $sid);
                                $query = "SELECT * FROM admin
                                    WHERE id = :id
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
                                }
                                if(password_verify($password, $user_pass)){
                                    if(guarantorHasResponded($lid, $sid) == true){
                                        $output = array (
                                            'error'=> true,
                                            'notice'=> "Sorry, you have already responded to this request before."
                                        );
                                    } else{
                                        
                                        $data = array(
                        	     ':loan_id' => $lid,
                        	     ':staff_id' => $sid,
                        	     ':response' => $res
                        	     );
                             $query = "UPDATE loan_guarantors SET guarantor_response = :response WHERE loan_id = :loan_id AND guarantor_staffid = :staff_id";
                             $statement = $connect->prepare($query);
                             if($statement->execute($data)){
                                        $output = array(
                                              'saved' => true,
                                              'notice' => 'Saved.',
                                              'protocol'=> $userFolder
                                            );
                             } else {
                                            $output = array(
                                              'error' => true,
                                              'notice' => 'Error Occured.'
                                            );
                             }
                 $guarantorsApproval = guarantorResponseCheck($lid);
                 if($guarantorsApproval == true){
                     //send to admin
                     sendLoanOverToAdminForApproval($lid);
                     
                 }
                                    }  
                                  }else {
                                    //Invalid Login Parameter
                                    $output = array (
                                    'error'=> true,
                                        'notice'=> "Invalid Login Parameter"
                                    );
                                } 
                                }
             
             
             
             
                           
	              
        }  
        echo json_encode($output);
		exit(); 
		
	}
	
	
	
	
	
        function sendLoanOverToAdminForApproval($loan_id){
           global $connect, $adminFolder;
           $data = array(':loan_id' => $loan_id);
           $query = "SELECT * FROM admin_loan_approval WHERE loan_id = :loan_id";
              $statement = $connect->prepare($query);
              $statement->execute($data);
              $result = $statement->rowCount();
             if($result > 0){
                 return false;
             } else {
                      $query = "SELECT id FROM admin";
                      $statement = $connect->prepare($query);
                      $statement->execute();
                      $result = $statement->fetchAll();
                      $resRows = $statement->rowCount();
                      $mailSuccessCount = 0;
                         foreach($result as $row){
                         
                        
                              $data = array(
                                ':loan_id' => $loan_id,
                                ':admin_id' => $row['id'],
                                ':admin_response' => 'pending',
                                ':time'=> time()
                                );
	                           $query = "INSERT INTO admin_loan_approval 
                                    (loan_id, admin_id, admin_response, time)
                                    VALUES 
                                    (:loan_id, :admin_id, :admin_response, :time)";
	                            $statement = $connect->prepare($query)->execute($data);
                      
                         
                         
                         //Admin Mailer
                        $query = " SELECT * FROM loan_request WHERE id = '".$loan_id."' LIMIT 1";
                		$statement = $connect->prepare($query);
                		if($statement->execute()){
                         foreach($statement->fetchAll() as $r){ 
                        $useremail = getAdminInfoByID("email", $row["id"]);
                        $username = getAdminInfoByID("firstname", $row["id"]).' '.getAdminInfoByID("lastname", $row["id"]);
                        $borrower = getUserInfoByStaffID("fname", $r["staffid"]).' '.getUserInfoByStaffID("lname", $r["staffid"]);
                        $acceptlink = $adminFolder."remote-approval.php?lid={$loan_id}&uid={$r["staffid"]}&res=accept";
                        $declinelink = $adminFolder."remote-approval.php?lid={$loan_id}&uid={$r["staffid"]}&res=decline";
                        $loanAmount = number_format($r["amount"]);
                        $title = "Loan Request Review";
                        if(getAccountBalance($r['staffid']) == 0){
                              $walletBalance = "0.00";
                          }else{
                              $walletBalance = number_format(getAccountBalance($r['staffid']));
                          }
                          if(getContributionBalance($r['staffid']) == 0){
                              $contributionBalance = "0.00";
                          }else{
                              $contributionBalance = number_format(getContributionBalance($r['staffid']));
                          }
                          if(getLoanBalance($r['staffid']) == 0){
                              $loanBalance = "0.00";
                          }else{
                              $loanBalance = number_format(getLoanBalance($r['staffid']));
                          }
                        $notify = adminLoanNotify($useremail, $username, $borrower, $acceptlink, $declinelink, $loanAmount,  $loanBalance, $contributionBalance ,$walletBalance);
                        $mailSuccess = Mail::cpanelMailer($title, $useremail, $notify);
                        if($mailSuccess){
                            $mailSuccessCount = $mailSuccessCount+1;
                        }
                       }}
                		//if($mailSuccessCount == $resRows){//mail seccess    // } 
   
                        }//loop 
            }//record check 
        }



function getUserInfoByStaffID($field, $staffid){
     global $connect;
     $output = '';
	 $data = array(':staffid'=> $staffid);
    $query = "SELECT $field FROM usertable WHERE staffid = :staffid LIMIT 1";
                $statement = $connect->prepare($query);
            if($statement->execute($data)){
                $result = $statement->fetchAll();
                foreach($result as $row)
		          {
		             $output = $row[$field];
	              }
            } else {
                    $output = 'Error';
            }
	   return $output;
}

function getAdminInfoByID($field, $adminid){
     global $connect;
     $output = '';
	 $data = array(':adminid'=> $adminid);
    $query = "SELECT $field FROM admin WHERE id = :adminid LIMIT 1";
                $statement = $connect->prepare($query);
            if($statement->execute($data)){
                $result = $statement->fetchAll();
                foreach($result as $row)
		          {
		             $output = $row[$field];
	              }
            } else {
                    $output = 'Error';
            }
	   return $output;
}


          function guarantorResponseCheck($loan_id){
                        global $connect;
                         $data = array(
                    	     ':loan_id' => $loan_id,
                    	     ':response' => "accept"
                    	     );
                          $query = "SELECT * FROM loan_guarantors WHERE loan_id = :loan_id AND guarantor_response = :response";
                          $statement = $connect->prepare($query);
                          $statement->execute($data);
                          $result = $statement->rowCount();
                          if($result == 2){
                             return true;
                           } else {
                             return false;
                           }
          }
          
          
          
          function guarantorHasResponded($loan_id, $sid){
                        global $connect;
                         $data = array(
                    	     ':loan_id' => $loan_id,
                    	      ':sid' => $sid,
                    	     ':response' => "pending"
                    	     );
                          $query = "SELECT * FROM loan_guarantors WHERE loan_id = :loan_id AND staffid = :sid AND guarantor_response NOT IN (:response)";
                          $statement = $connect->prepare($query);
                          $statement->execute($data);
                          $result = $statement->rowCount();
                          if($result > 0){
                             return true;
                           } else {
                             return false;
                           }
          }
 
 
 
 
 
 