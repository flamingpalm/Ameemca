<?php
require_once("../PH.php");

if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT loan_request.id, loan_request.guarantor_one, loan_request.guarantor_two, loan_request.staffid, usertable.fname, usertable.lname
		FROM loan_request
		INNER JOIN usertable
		ON loan_request.staffid = usertable.staffid
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			 WHERE usertable.fname LIKE "%'.$_POST["search"]["value"].'%" 
			  OR usertable.staffid LIKE "%'.$_POST["search"]["value"].'%"
			';
		}
       $query .= 'GROUP BY loan_request.id';
		
		if(isset($_POST["order"]))
		{
			$query .= '
			ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].'
			';
		}
		else
		{
			$query .= '
			ORDER BY loan_request.id DESC 
			';
		}
		$query1 = '';
if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connect->prepare($query);
$statement->execute();
$recordsFiltered = $statement->rowCount();

$statement = $connect->prepare($query . $query1);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
		$sn = 1; $currentAdmin = $admin_id;
foreach($result as $row)
		{
		    
		    $guarantorResponse1 = getGuarantorResponse($row["id"], $row["guarantor_one"]);
		    $guarantorResponse2 = getGuarantorResponse($row["id"], $row["guarantor_two"]);
		    

            $secondAdmin = getSecondAdmin($currentAdmin);
        	$thirdAdmin =  getthirdAdmin($currentAdmin, $secondAdmin);
        	$fourthAdmin =  getFourthAdmin($currentAdmin, $secondAdmin, $thirdAdmin);
        	
  	
            $myResponse = getAdminResponse($row["id"], $currentAdmin);
		    $adminResponse2 = getAdminResponse($row["id"], $secondAdmin);
		    $adminResponse3 = getAdminResponse($row["id"], $thirdAdmin);
		    $adminResponse4 = getAdminResponse($row["id"], $fourthAdmin);
		    
  
			$sub_array = array();
			$sub_array[] = $sn++;
			$sub_array[] = ucfirst($row["fname"]).' '.ucfirst($row["lname"]);
			$sub_array[] = $row["staffid"];
		    $sub_array[] = '<button type="button" id="view-loan" data-loanid="'.$row["id"].'" data-sid="'.$row["staffid"].'" class="btn btn-pill btn-primary btn-sm">View</button>';
            //$sub_array[] = $guarantorResponse1;
            //$sub_array[] = $guarantorResponse2;
            $sub_array[] = $myResponse;
            $sub_array[] = $adminResponse2;
			$sub_array[] = $adminResponse3;
			$sub_array[] = $adminResponse4;
			$data[] = $sub_array;
		}

function recordsTotal()
	{
	global $connect;
 $query = "
        SELECT loan_request.id, loan_request.guarantor_one, loan_request.guarantor_two, loan_request.staffid, usertable.fname, usertable.lname
        FROM loan_request
		INNER JOIN usertable
		ON loan_request.staffid = usertable.staffid
        ";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
	}

		$output = array(
			'draw'				=>	intval($_POST["draw"]),
			"recordsTotal"   =>  recordsTotal(),
            "recordsFiltered"  =>  $recordsFiltered,
			"data"				=>	$data
		);

		echo json_encode($output);
		exit();
	}
	
	
	
if($_POST["action"] == "getloaninfo")
	{	
	    $data = array(':loan_id'=> trim($_POST['lid']));
    	$query = "SELECT usertable.fname, usertable.lname, usertable.staffid, loan_request.amount, loan_request.reason, loan_request.type, loan_request.loan_duration, loan_request.guarantor_one, loan_request.guarantor_two
    	    FROM loan_request
        	INNER JOIN usertable
        	ON loan_request.staffid = usertable.staffid
        	WHERE loan_request.id = :loan_id
        	LIMIT 1";
          $statement = $connect->prepare($query);
          $statement->execute($data);
          $result = $statement->fetchAll();
          $output = "";
          
          
         
          
          
          
          foreach($result as $row){
            $guarantorResponse1 = getGuarantorResponse($_POST['lid'], $row["guarantor_one"]);
		    $guarantorResponse2 = getGuarantorResponse($_POST['lid'], $row["guarantor_two"]);
		    $guarantor1Name = getUserInfoByStaffID("fname", $row["guarantor_one"]).' '.getUserInfoByStaffID("lname", $row["guarantor_one"]);
		    $guarantor2Name = getUserInfoByStaffID("fname", $row["guarantor_two"]).' '.getUserInfoByStaffID("lname", $row["guarantor_two"]);
		    
               if(getAccountBalance($row['staffid']) == 0){
              $walletbal = "0.00";
          }else{
              $walletbal = number_format(getAccountBalance($row['staffid']));
          }
          if(getContributionBalance($row['staffid']) == 0){
              $contributionbal = "0.00";
          }else{
              $contributionbal = number_format(getContributionBalance($row['staffid']));
          }
          if(getLoanBalance($row['staffid']) == 0){
              $loanbal = "0.00";
          }else{
              $loanbal = number_format(getLoanBalance($row['staffid']));
          }
              $output .= '<h5>Name:</h5>
                          <p>'.ucfirst($row['fname']).' '.ucfirst($row['fname']).'</p>
                          <hr>
                          <h5>Loan Amount:</h5>
                          <p>N'.number_format($row['amount']).'</p>
                          <hr>
                          <h5>Payment plan:</h5>
                          <p>'.getLoanPackageTypeByID($row['type']).'</p>
                          <hr>
                          <h5>Loan Duration:</h5>
                          <p>'.$row['loan_duration'].' months</p>
                          <hr>
                          <h5>Loan Reason:</h5>
                          <p>'.$row['reason'].'</p>
                        <hr>
                        <h5>Wallet Balance:</h5>
                          <p>N'.$walletbal.'</p>
                        <hr>
                        <h5>Contribution Balance:</h5>
                          <p>N'.$contributionbal.'</p>
                        <hr>
                        <h5>Outstanding Loan Balance:</h5>
                          <p>N'.$loanbal.'</p>
                        <hr>
                        <h5>Guarantors :</h5>
                          <p>'.$guarantor1Name.' '.$guarantorResponse1.'</p>
                          <p>'.$guarantor2Name.' '.$guarantorResponse2.'</p>
                        <hr>
                        <div class="modal-footer">
     '.loanRespondBtns(trim($_POST['lid']), $admin_id).'
     <button type="button" class="btn btn-default btn btn-pill btn-sm" data-dismiss="modal">Close</button>
    </div>';
          }
	   echo $output;
	   exit();
	}	
		
	
	if($_POST["action"] == "approveloan")
	{	
	    
	    $data = array(':loan_id'=> trim($_POST['lid']), ':admin_response'=> 'accept', ':admin_id'=> $admin_id);
    	$query = "UPDATE admin_loan_approval SET admin_response = :admin_response  WHERE loan_id =:loan_id AND admin_id =:admin_id";
        $statement = $connect->prepare($query);
                      if($statement->execute($data)){
                     processUserLoan(trim($_POST['lid']), trim($_POST['sid']));
            	        $output = array(
                			'approved' => true,
                			"notice" =>	"Loan Approved."
            		    );
                      } else{
                          $output = array(
                			'failed' => true,
                			"notice" =>	"Loan Approvedal Failed"
            		    );
                      }
		echo json_encode($output);
		exit();
	}	
	
	if($_POST["action"] == "declineloan")
	{	
	    $data = array(':loan_id'=> trim($_POST['lid']), ':admin_response'=> 'decline', ':admin_id'=> $admin_id);
    	$query = "UPDATE admin_loan_approval SET admin_response = :admin_response  WHERE loan_id =:loan_id AND admin_id =:admin_id";
        $statement = $connect->prepare($query);
                      if($statement->execute($data)){
            	        $output = array(
                			'approved' => true,
                			"notice" =>	"Loan Declined."
            		    );
                      } else{
                          $output = array(
                			'failed' => true,
                			"notice" =>	"Loan Decline Failed"
            		    );
                      }
		echo json_encode($output);
		exit();
	}		
	
	
function processUserLoan($lid, $sid){
    if(checkLoanApprovalCountForGuarantor($lid) == 2){
	    if(checkLoanApprovalCountForAdmin($lid) > 2){
	        creditUserLoan($lid, $sid);
	    }
	}
} 
	
	
	
	function creditUserLoan($loan_id, $staffid){
	     global $connect;
	    $data = array(':loan_id'=> $loan_id, ':status'=> 'pending', ':staffid'=> $staffid);
    	$query = "SELECT * FROM loan_request
    	WHERE id = :loan_id
    	AND status =:status
    	AND staffid =:staffid
    	GROUP BY id
    	LIMIT 1";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        if($statement->rowCount() > 0){
            $result = $statement->fetchAll();
              foreach($result as $row){
                  $requestedAmount = $row['amount'];
                  $getLoanBalance = getLoanBalance($row['staffid']);
                  $loanSum = $requestedAmount + $getLoanBalance; 
                  $data = array(':staffid'=> $staffid, ':amount'=> $loanSum, ':loan_id'=> $loan_id);
                    	$query = "UPDATE loan_balance SET balance =:amount, last_loan_id =:loan_id WHERE staffid = :staffid";
                        $statement = $connect->prepare($query);
                        if($statement->execute($data)){
                                $data = array(':staffid'=> $staffid, ':loan_id'=> $loan_id, ':status'=> 'granted');
        	                    $query = "UPDATE loan_request SET status = :status WHERE id = :loan_id AND staffid = :staffid";
                                $statement = $connect->prepare($query);
                                if($statement->execute($data)){
                                    return true;
                                }    
                        } else {
                            //false
                            return false;
                        }
              }
        }else {
              //false
                 return false;
             }
	}
	
	
	
	
	
	
	
	
	
	
	
	function checkLoanApprovalCountForAdmin($loan_id){
	      global $connect;
                        $data = array(
                    	     ':loan_id' => $loan_id,
                    	     ':response' => 'accept'
                    	     );
                          $query = "SELECT * FROM admin_loan_approval 
                          WHERE loan_id = :loan_id 
                          AND admin_response = :response";
                          $statement = $connect->prepare($query);
                          $statement->execute($data);
                          $result = $statement->rowCount();
                          return $result;
	}
	
	function checkLoanApprovalCountForGuarantor($loan_id){
	      global $connect;
                        $data = array(
                    	     ':loan_id' => $loan_id,
                    	     ':response' => 'accept'
                    	     );
                          $query = "SELECT * FROM loan_guarantors 
                          WHERE loan_id = :loan_id 
                          AND guarantor_response = :response";
                          $statement = $connect->prepare($query);
                          $statement->execute($data);
                          $result = $statement->rowCount();
                          return $result;
	}
	
	
	
	
	
	
	function getAdminResponse($loan_id, $admin_id){
	    global $connect;
                        $response = '<span class="badge badge-pill badge-warning">Awating guarantors</span>';
                         $data = array(
                    	     ':loan_id' => $loan_id,
                    	     ':admin_id' => $admin_id
                    	     );
                          $query = "SELECT admin_response FROM admin_loan_approval WHERE loan_id = :loan_id AND admin_id = :admin_id GROUP BY loan_id LIMIT 1";
                          $statement = $connect->prepare($query);
                          $statement->execute($data);
                          $result = $statement->fetchAll();
                          foreach($result as $row){
                             if($row["admin_response"] == "accept"){
                                 $response = '<span class="badge badge-pill badge-success">Approved</span>';  
                               } 
                               
                              if($row["admin_response"] == "decline"){
                                   $response = '<span class="badge badge-pill badge-danger">Declined</span>';
                               }
                               
                            if($row["admin_response"] == "pending"){
                                     $response = '<span class="badge badge-pill badge-warning">Pending</span>';
                               }
                           }
                          return $response;
	} 
	
	
	  function getGuarantorResponse($loan_id, $guarantor_id){
                        global $connect;
                        $response = '<span class="badge badge-pill badge-warning">Error</span>';
                        $data = array(
                    	     ':loan_id' => $loan_id,
                    	     ':guarantor_staffid' => $guarantor_id
                    	     );
                          $query = "SELECT guarantor_response FROM loan_guarantors WHERE loan_id = :loan_id AND guarantor_staffid = :guarantor_staffid GROUP BY loan_id LIMIT 1";
                          $statement = $connect->prepare($query);
                          $statement->execute($data);
                          $result = $statement->fetchAll();
                          foreach($result as $row){
                             if($row["guarantor_response"] == "accept"){
                                 $response = '<span class="badge badge-pill badge-success">Approved</span>';  
                               } 
                               
                              if($row["guarantor_response"] == "decline"){
                                   $response = '<span class="badge badge-pill badge-danger">Declined</span>';
                               }
                               
                            if($row["guarantor_response"] == "pending"){
                                     $response = '<span class="badge badge-pill badge-warning">Pending</span>';
                               }
                           }
                          return $response;
          }
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          function loanRespondBtns($loan_id, $admin_id){
                        global $connect;
                        $data = array(
                    	     ':loan_id' => $loan_id,
                    	     ':admin_id' => $admin_id
                    	     );
                          $query = "SELECT * FROM admin_loan_approval 
                          WHERE (loan_id = :loan_id AND admin_id = :admin_id) 
                          AND (admin_response = 'accept' OR admin_response = 'decline')
                          GROUP BY loan_id";
                          $statement = $connect->prepare($query);
                          $statement->execute($data);
                          $result = $statement->rowCount();
                          if($result > 0){
                              $output ='<span class="badge badge-pill badge-primary">Already Reviewed!</span>';
                          }else{
                              if(checkLoanApprovalCountForGuarantor($loan_id) == 2){
                                 $output ='<button type="submit" id="approve-loan" class="btn btn-pill btn-primary btn-sm">Approve</button>
                                <button type="submit" id="decline-loan" class="btn btn-pill btn-danger btn-sm">Decline</button>';
                              }else {
                                  $output = '<span class="badge badge-pill badge-warning">Awating guarantors</span>';
                              }
                        }
          return $output;
          }
  
  
   function getLoanPackageTypeByID($id){
             global $connect;
             $data = array(':id' => $id);
             $query = "SELECT name FROM package_type WHERE id=:id LIMIT 1";
             $statement = $connect->prepare($query);
             $statement->execute($data);
             $result = $statement->fetchAll();
              foreach($result as $row){
                  return $row['name'];
              }
    }
  
  
          
          
    function getSecondAdmin($id){
             global $connect;
             $data = array(':id' => $id);
             $query = "SELECT id FROM admin WHERE NOT id=:id LIMIT 1";
             $statement = $connect->prepare($query);
             $statement->execute($data);
             $result = $statement->fetchAll();
              foreach($result as $row){
                  return $row['id'];
              }
    }
            
	
	function getThirdAdmin($first, $second){
                     global $connect;
                     $data = array(':first' => $first,':second' => $second);
                     $query = "SELECT id FROM admin 
                     WHERE NOT id=:first
                     AND NOT id=:second 
                     LIMIT 1";
                     $statement = $connect->prepare($query);
                     $statement->execute($data);
                     $result = $statement->fetchAll();
                      foreach($result as $row){
                          return $row['id'];
                      }
            }
            
            
      	function getFourthAdmin($first, $second, $third){
                     global $connect;
                     $data = array(':first' => $first,':second' => $second,':third' => $third);
                     $query = "SELECT id FROM admin 
                     WHERE NOT id=:first
                     AND NOT id=:second
                     AND NOT id=:third
                     LIMIT 1";
                     $statement = $connect->prepare($query);
                     $statement->execute($data);
                     $result = $statement->fetchAll();
                      foreach($result as $row){
                          return $row['id'];
                      }
            }      
        
      
          