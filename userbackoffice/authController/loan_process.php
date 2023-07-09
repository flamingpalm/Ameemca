 <?php 
 require_once '../pdo.php';


require_once('../../libraries/inc/mailer/Mail.php');


// function guarantorNotify($email, $name,  $borrower, $acceptlink, $declinelink, $loanAmount){
	
// 	$mailbody ='
// 	<div style="margin:0;padding:0;background-color:#FFFFFF;">
// 	<table width="100%" height="100%" style="min-width:348px" border="0" cellspacing="0" cellpadding="0" lang="en">
// 	<tbody>
// 	<tr height="32" style="height:32px">
// 	<td></td>
// </tr>
// 	<tr align="center">
// 	<td>
// 	<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:20px;max-width:516px;min-width:220px">
// 	<tbody>
// 	<tr>
// <td width="10" style="width:10px"><td>
// 	<div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" align="center">
// 	<p style="margin:0;padding:0; max-width: 1137px;font-size:18px;font-weight:400;">
// Guarantor Request Notification
// </p>
// 	<div style="font-family:Roboto,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;padding-top:24px;text-align:center;word-break:break-word">
// 	<div style="text-align:center;padding-bottom:16px;line-height:0">
// 	<img height="60" src="https://ameemca.ng/assets/images/logo.svg" style="max-width: 1137px;">
// </div>
// 	<div style="font-size:24px">
// 	Ameemca
// </div>
// 	<table align="center" style="margin-top:8px">
// 	<tbody>
// 	<tr style="line-height:normal">
// 	<td align="right" style="padding-right:8px">
// 	</td>
// 	<td>
// 	<a style="font-family:Roboto,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.87);font-size:14px;line-height:20px">
// 	'.$email.'</a></td></tr></tbody></table></div>
// 	<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:left">
// 	Dear '.$name.':<br>
// 	'.$borrower.':, has requested for you to be a guarantor to this loan.
// <br>
// Here is the loan details:
// 	<div style="margin:0;padding:0;text-align: center;">
// 		<p style="background-color: #e1e1e1; border-radius:8px;padding:10px;margin:15px 0 20px 0;">
// <strong>Name:</strong> '.$borrower.'
// <br>
// <strong>Loan Amount:</strong> N'.$loanAmount.'
// </p>
// By accepting to be a guarantor to this loan request, you agree to act as a referee / guarantor for this user.
// <br>
// Please ensure that you read our guarantors <a href="#">policy</a> to avoid violations of our rules.
// <strong>
// </div>
// <div style="padding-top:32px;text-align:center">
// 	<a href="'.$acceptlink.'" style="font-family:Roboto,Helvetica,Arial,sans-serif;line-height:16px;color:#ffffff;font-weight:400;text-decoration:none;font-size:14px;display:inline-block;padding:10px 24px;background-color:#00ad5f;border-radius:5px;min-width:90px" target="_blank">
// 	Accept</a>
// 	<a href="'.$declinelink.'" style="font-family:Roboto,Helvetica,Arial,sans-serif;line-height:16px;color:#ffffff;font-weight:400;text-decoration:none;font-size:14px;display:inline-block;padding:10px 24px;background-color:#ca2129;border-radius:5px;min-width:90px" target="_blank">
// 	Decline</a>
// </div>
// </div>
// <br>
// For further enquiries, Kindly contact us at info@ameemca.ng
// <br>Best Regards.</div>
// 	<div style="text-align:left">
// 	<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
// 	<div>
// 	You received this email because you where refrenced in a loan request on Ameemca.
// </div>
// 	<div style="direction:ltr">
// 	© '.date("Y").'.
// <a style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
// 	Ameemca.ng
// </a></div></div></div></td>
// 	<td width="10" style="width:10px"></td></tr></tbody></table></td></tr>
// 	<tr height="32" style="height:32px">
// 	<td></td></tr></tbody></table></div>
// 	';
// 	return $mailbody;
// 	}

if($_POST["action"] == "loan_request")
	{
        $error = 0;
        $error_type = '';
        $type = '';
        $error_amount = '';
        $amount = '';
        $error_guarantor_two = '';
        $guarantor_two = '';
        $error_guarantor_one = '';
        $guarantor_one = '';
        $error_reason = '';
		$reason = '';
		$error_duplicate = ''; 
        $duration = '';
		$error_duration = ''; 
        
        if(empty($_POST["loan_tenure"]))
		{
			$error_duration = 'Select loan tenure';
			$error++;
		}
		else {
			$duration = sanitizeNumber($_POST["loan_tenure"]);
		}
		if(empty($_POST["loan_type"]))
		{
			$error_type = 'Select loan type';
			$error++;
		}
		else {
			$type = sanitizeNumber($_POST["loan_type"]);
		}
        if(empty($_POST["amount"]))
		{
			$error_amount = 'Provide your loan amount';
			$error++;
		}
		else {
			$amount = sanitizeNumber($_POST["amount"]);
		}
        if(empty($_POST["guarantor_one"]))
		{
			$error_guarantor_one = 'Select your first guarantor.';
			$error++;
		}
		else {
			$guarantor_one = sanitizeNumber($_POST["guarantor_one"]);
		}
        if(empty($_POST["guarantor_two"]))
		{
			$error_guarantor_two = 'Select your second guarantor.';
			$error++;
		}
		else {
			$guarantor_two = sanitizeNumber($_POST["guarantor_two"]);
		}
        if(empty($_POST["reason"]))
		{
			$error_reason = 'Kindly state your reason for taking this loan to increase your chances of approval.';
			$error++;
		}
		else {
			$reason = sanitizeText($_POST["reason"]);
		}
        
        if(!empty($guarantor_one) && !empty($guarantor_two))
		{
        if($guarantor_one == $guarantor_two)
		{
			$error_duplicate = 'Guarantor 1 & 2 can not be the same staff.';
			$error++;
		}
		}
        
        if($error > 0){
                   $output = array(
                             'error'=> true,
                             'error_type'=> $error_type,
                             'error_tenure'=> $error_duration, 
                             'error_amount' => $error_amount,
                             'error_guarantor_one'=> $error_guarantor_one, 
                             'error_guarantor_two' => $error_guarantor_two,
                             'error_reason'=> $error_reason,
                             'error_duplicate'=> $error_duplicate
                      );
        } else {
            //max loan grantable check
          if($amount > calcUserloanLimit($staffid)){
                 if(calcUserloanLimit($staffid) ==0){
                              $output = array(
                                      'failed' => true,
                                      'html' => '<div style="background: white;">
                                                  <div class="swal2-header">
                                                     <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"></div>
                                                         <h2 class="swal2-title" id="swal2-title" style="display: flex;">Request Declined!</h2>
                                                         </div>
                                                        <div class="swal2-content">
                                                          <div id="swal2-content" style="display: block;">Sorry, your request was declined because your contribution balance is low. </div>
                                                          </div>
                                                         <div class="swal2-actions" style="display: flex;">
                                                         <a type="button" class="swal2-confirm btn btn-warning" aria-label="" style="display: inline-block;color: white;" href="account-history.php">Transaction History</a>
                                                         </div>   
                                                     </div>'
                                    );
                 } else {
                      $output = array(
                                      'failed' => true,
                                      'html' => '<div style="background: white;">
                                                  <div class="swal2-header">
                                                     <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"></div>
                                                         <h2 class="swal2-title" id="swal2-title" style="display: flex;">Request Declined!</h2>
                                                         </div>
                                                        <div class="swal2-content">
                                                          <div id="swal2-content" style="display: block;">Sorry, your request was declined because the amount you requested exceeds your loan limit. </div>
                                                          </div>
                                                         <div class="swal2-actions" style="display: flex;">
                                                         <a type="button" class="swal2-confirm btn btn-warning" aria-label="" style="display: inline-block;color: white;" href="account-history.php">Transaction History</a>
                                                         </div>   
                                                     </div>'
                                    );
                 }
            } else {
                
            
if (checkEmergencyLoanLimit($type, $amount)== true){
    $output = array(
                                      'failed' => true,
                                      'html' => '<div style="background: white;">
                                                  <div class="swal2-header">
                                                     <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"></div>
                                                         <h2 class="swal2-title" id="swal2-title" style="display: flex;">Request Declined!</h2>
                                                         </div>
                                                        <div class="swal2-content">
                                                          <div id="swal2-content" style="display: block;">Sorry, your request was declined because your exceeded the maximum erergency loan amount.</div>
                                                          </div>
                                                         <div class="swal2-actions" style="display: flex;">
                                                         <a type="button" class="swal2-confirm btn btn-warning" aria-label="" style="display: inline-block;color: white;" href="account-history.php">Transaction History</a>
                                                         </div>   
                                                     </div>'
                                    );
} else {
   
            //Loan Interest Object
            $loanObj = json_decode(calcLoanInterest($amount, $duration));
            $monthlydue = $loanObj->monthlydue;
            $biweekly = $loanObj->biweekly;
            $interest = $loanObj->interest;
            $refcode = bin2hex(random_bytes(8));
            
                      $data = array(
                             ':staffid'=> $staffid, 
                             ':package_id' => getUserInfo("package"),
                             ':type'=> $type,
                             ':duration' => $duration,
                             ':amount' => $amount,
                             ':monthlydue'=> $monthlydue,
                             ':biweeklydue'=> $biweekly, 
                             ':interest' => $interest,
                             ':refcode'=> $refcode,
                             ':guarantor_one'=> $guarantor_one, 
                             ':guarantor_two' => $guarantor_two,
                             ':reason'=> $reason, 
                             ':status' => 'pending',
                             ':time'=> time(),
                             ':date'=> date('Y-m-d', time())
                      );
                      
                    $query = "INSERT INTO loan_request 
                            (staffid, package_id, type, amount, monthlydue, biweeklydue, interest, loan_duration, refcode, guarantor_one, guarantor_two, reason, status, time, date)
                            VALUES 
                            (:staffid, :package_id, :type, :amount, :monthlydue, :biweeklydue, :interest, :duration, :refcode, :guarantor_one, :guarantor_two, :reason, :status, :time, :date)";
                    $statement = $connect->prepare($query);
                    $statement->execute($data);
                    $loan_id = $connect->lastInsertId();
                    if($loan_id){
                        //mail loop
                         $insertCount = 0;
                         $mailSuccessCount = 0;
                         $arr = array(
                                 'guarantor_one' => trim($_POST["guarantor_one"]),
                                 'guarantor_two' => trim($_POST["guarantor_two"])
                              );
                                    foreach ($arr as $field => $value){
                                                 $useremail = getUserInfoByStaffID("email", $value);
                                                 $username = getUserInfoByStaffID("fname", $value).' '.getUserInfoByStaffID("lname", $value);
                                                 $borrower = getUserInfoByStaffID("fname", $staffid).' '.getUserInfoByStaffID("lname", $staffid);
                                                 $acceptlink = $userFolder."guarantor-approval.php?lid={$loan_id}&uid={$value}&res=accept";
                                                 $declinelink = $userFolder."guarantor-approval.php?lid={$loan_id}&uid={$value}&res=decline";
                                                 $loanAmount = number_format($_POST["amount"]);
                                	             $title = "Loan Guarantor Request";
                                	             $notify = guarantorNotify($useremail, $username, $borrower, $acceptlink, $declinelink, $loanAmount);
                                	             $mailSuccess = Mail::cpanelMailer($title, $useremail, $notify);
                                	             if($mailSuccess){
                                	                 $mailSuccessCount = $mailSuccessCount+1;
                                	             }
                                    }//foreach
                                    if($mailSuccessCount == 2){
                                	                 //Mail success
                                	                 foreach ($arr as $field => $value){//second loop
                                	                        $data = array(
                                                                 ':loan_id'=> $loan_id, 
                                                                 ':guarantor_staffid' => $value,
                                                                 ':guarantor_response'=> 'pending',
                                                                 ':time'=> time()
                                                                );
                                                            $query = "INSERT INTO loan_guarantors 
                                                                (loan_id, guarantor_staffid, guarantor_response, time)
                                                                VALUES 
                                                                (:loan_id, :guarantor_staffid, :guarantor_response, :time)";
                                                            $statement = $connect->prepare($query)->execute($data);
                                                            if($statement){
                                	                            $insertCount = $insertCount+1;
                                	                         }
                                	                 }// second loop
                                        	                 if($insertCount == 2){
                                                                        $output = array(
                                                                        'success' => true,
                                                                        'html' => '<div style="background: white;">
                                                                             <div class="swal2-header">
                                                                             <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                                                                                <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                                                                <span class="swal2-success-line-tip"></span> 
                                                                                <span class="swal2-success-line-long"></span>
                                                                                <div class="swal2-success-ring"></div> 
                                                                                <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                                                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                                                                </div>
                                                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Request Submitted</h2>
                                                                                <button type="button" class="swal2-close" aria-label="Close this dialog" style="display: none;">×</button>
                                                                                </div>
                                                                                    <div class="swal2-content">
                                                                                    <div id="swal2-content" style="display: block;">Your loan request for N'.number_format($_POST["amount"]).' is being reviewed. You\'ll recieve a request status mail soon.</div>
                                                                                    </div>
                                                                                <div class="swal2-actions" style="display: flex;">
                                                                                <a type="button" class="swal2-confirm btn btn-success" aria-label="" style="display: inline-block;color: white;" href="loan-history.php">Loan History</a>
                                                                              </div>
                                                                              </div>'
                                                                              );
                                                                        }
                                	             } else {
                                	                 //abort mailed failed
                                	                    $output = array(
                                                                      'failed' => true,
                                                                      'html' => '<div style="background: white;">
                                                                                  <div class="swal2-header">
                                                                                     <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"></div>
                                                                                         <h2 class="swal2-title" id="swal2-title" style="display: flex;">Request Failed!</h2>
                                                                                         </div>
                                                                                        <div class="swal2-content">
                                                                                          <div id="swal2-content" style="display: block;">An error occured while processing your request.</div>
                                                                                          </div>
                                                                                         <div class="swal2-actions" style="display: flex;">
                                                                                         <a type="button" class="swal2-confirm btn btn-warning" aria-label="" style="display: inline-block;color: white;" href="account-history.php">Transaction History</a>
                                                                                         </div>   
                                                                                     </div>'
                                                                    );
                                	             }
                    }else {
	                 //first insert failed
	                    $output = 'inserting...';
	                }//$loan_id
	                 
}//emergency loan limit check
	        } //max loan grantable check       
        }//error check
        
        echo json_encode($output);
		exit();
	}

	
if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM loan_request
		WHERE loan_request.staffid = :staffid
	    AND ( 
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			loan_request.amount LIKE "%'.$_POST["search"]["value"].'%" 
			OR loan_request.status LIKE "%'.$_POST["search"]["value"].'%"
			OR loan_request.refcode LIKE "%'.$_POST["search"]["value"].'%"
			OR loan_request.date LIKE "%'.$_POST["search"]["value"].'%")
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
$dataArr = array(':staffid'=> $staffid);
$statement = $connect->prepare($query);
$statement->execute($dataArr);
$recordsFiltered = $statement->rowCount();

$statement = $connect->prepare($query . $query1);
$statement->execute($dataArr);
$result = $statement->fetchAll();
$data = array();
$sn = 1;
$status = '<span class="badge badge-pill badge-warning">Pending</span>';
foreach($result as $row)
		{
		   if($row["status"] == "granted"){
		    $status = '<span class="badge badge-pill badge-success">Granted</span>';
		} 
		  if($row["status"] == "declined"){
		    $status = '<span class="badge badge-pill badge-danger">Declined</span>';
		}    
			$sub_array = array();
			$sub_array[] = $sn++;
			$sub_array[] = number_format($row["amount"]);
			$sub_array[] = $status;
			$sub_array[] = '<button type="button" data-lid="'.$row["id"].'" class="btn btn-pill btn-dark btn-sm view-member">View</button>';
			$sub_array[] = $row["refcode"];
			$sub_array[] = $row["date"];
			$data[] = $sub_array;
		}

function recordsTotal()
	{
	global $connect, $staffid;
	$dataArr = array(':staffid'=> $staffid);
 $query = "	SELECT * FROM loan_request 
			WHERE loan_request.staffid = :staffid
    	GROUP BY loan_request.id
";
 $statement = $connect->prepare($query);
 $statement->execute($dataArr);
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
	
	
if($_POST["action"] == "calculateInterest")	{   
      $data = array(':id'=> getUserInfo("package"));
	    $query = "
          SELECT * FROM package
          WHERE id = :id
          LIMIT 1";
          $statement = $connect->prepare($query);
          $statement->execute($data);
          $result = $statement->rowCount();
          if($result > 0){
             $result = $statement->fetchAll();
                foreach($result as $row)
                 {
                     $loanAmount = trim($_POST['amount']);
                     $loanPackageInterestRate = $row['package_interest_rate'];
                     $loanDuration = trim($_POST['duration']);
                    //  $percent = ceil(($loanAmount + ($loanAmount * ( $loanPackageInterestRate / 100))) / $loanDuration);
                     
                    //  $percent = ceil(($loanAmount / $loanDuration) + ((0.05 * $loanAmount)/ $loanDuration) + (3000 * $loanDuration));
                     $percent  = 0;
                               $output = array(
                        			'success' => true,
                        			'monthlydue' => number_format($percent),
                        			'duration' => $loanDuration,
                        			'biweekly'=> number_format($percent + 0),
                        			'interest' => $percent
                        		);
                 }
           } else {
                                $output = array(
                        			'failed' => true,
                        			'interest' => '0.00'
                        		);
           }
         
		echo json_encode($output);
		exit();  
}

	
//the new code
  if($_POST["action"] == "single_fetch")
	{
		$query = "
    		SELECT * FROM loan_request	
    		WHERE id = '".$_POST["lid"]."'
        ";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
        	$result = $statement->fetchAll();
        	$form2 = $form1 = '';
			$output = '
			<div class="col-md-12">
			';
			foreach($result as $row)
			{
				$button1 = getGResponse($row["id"], $row["guarantor_one"]);
			    $button2 = getGResponse($row["id"], $row["guarantor_two"]); 
			    
			    $form1 .= getFormChange($row["id"], $row["guarantor_one"]);
			    $form2 .= getFormChange($row["id"], $row["guarantor_two"]); 
			    
			    $name1 = getUserInfoByStaffID("fname", $row["guarantor_one"]).' '.getUserInfoByStaffID("lname", $row["guarantor_one"]);
			    $name2 = getUserInfoByStaffID("fname", $row["guarantor_two"]).' '.getUserInfoByStaffID("lname", $row["guarantor_two"]);
			    
			    	$output .= '
				        <div style="padding: 16px 0 10px;border-bottom: 1px solid #ddd;">
						<div style="padding: 0 0 10px 0;">
						    <span style="background: #e1e1e1; border-radius: 25px;padding: 1px 7px;">Guarantor One:</span> 
							<div>Name: <span class="col-md-3">'.$name1.'</span></div> 
			          	    <div>Status: <span class="col-md-3 pr-0">'.$button1.'</span></div>
			          	    </div>
			          	    '.$form1.'
						</div>
						<div style="padding: 16px 0 10px;border-bottom: 1px solid #ddd;">
						<div style="padding: 0 0 10px 0;">
							<span style="background: #e1e1e1; border-radius: 25px;padding: 1px 7px;">Guarantor Two:</span> 
							<div>Name: <span class="col-md-3">'.$name2.'</span></div> 
			          	    <div>Status: <span class="col-md-3 pr-0">'.$button2.'</span></div>
			          	    </div>
			          	    '.$form2.'
			            </div>
				';
			}
			
			$output .= '</div>';
			echo $output;
			exit();
	
	}
}	
	
	
	
if($_POST["action"] == "guarantor_change")
	{
          $query = "
    		SELECT * FROM loan_request	
    		WHERE id = '".$_POST["lid"]."'
    		AND (guarantor_one = '".$_POST["oldid"]."' OR guarantor_two = '".$_POST["oldid"]."')
          ";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
		    //outer loop
		    $mailSuccessCount = 0;
			foreach($statement->fetchAll() as $row)
			{
		                //Mailer
                        $useremail = getUserInfoByStaffID("email", $_POST["newid"]);
                        $username = getUserInfoByStaffID("fname", $_POST["newid"]).' '.getUserInfoByStaffID("lname", $_POST["newid"]);
                        $borrower = getUserInfoByStaffID("fname", $staffid).' '.getUserInfoByStaffID("lname", $staffid);
                        $acceptlink = $userFolder."guarantor-approval.php?lid={$_POST["lid"]}&uid={$_POST["newid"]}&res=accept";
                        $declinelink = $userFolder."guarantor-approval.php?lid={$_POST["lid"]}&uid={$_POST["newid"]}&res=decline";
                        $loanAmount = number_format($row["amount"]);
                        $title = "Loan Guarantor Request";
                        $notify = guarantorNotify($useremail, $username, $borrower, $acceptlink, $declinelink, $loanAmount);
                        $mailSuccess = Mail::cpanelMailer($title, $useremail, $notify);
                        if($mailSuccess){
                            $mailSuccessCount = $mailSuccessCount+1;
                        }
                                  
                         if($mailSuccessCount == 1){//mail seccess
                             
                       if($row["guarantor_one"] == $_POST["oldid"]){
		                 $query = "UPDATE loan_request
                            SET guarantor_one = '".$_POST["newid"]."'
                            WHERE id = '".$_POST["lid"]."'
                            AND guarantor_one = '".$_POST["oldid"]."'
                        ";
                $statement = $connect->prepare($query);
        		$statement->execute();
			}
		    if($row["guarantor_two"] == $_POST["oldid"]){
		      $query = "UPDATE loan_request
                            SET guarantor_two = '".$_POST["newid"]."'
                            WHERE id = '".$_POST["lid"]."'
                            AND guarantor_two = '".$_POST["oldid"]."'
                        ";
                 $statement = $connect->prepare($query);
        		$statement->execute();
			}
			
			$query = "UPDATE loan_guarantors
                            SET guarantor_staffid = '".$_POST["newid"]."'
                            WHERE loan_id = '".$_POST["lid"]."'
                            AND guarantor_staffid = '".$_POST["oldid"]."'
                        ";
                $statement = $connect->prepare($query);
        		if($statement->execute())
        		{   
                              $output =  '<div style="background: white;">
                                                                             <div class="swal2-header">
                                                                             <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                                                                                <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                                                                <span class="swal2-success-line-tip"></span> 
                                                                                <span class="swal2-success-line-long"></span>
                                                                                <div class="swal2-success-ring"></div> 
                                                                                <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                                                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                                                                </div>
                                                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Guarantor Changed</h2>
                                                                                <button type="button" class="swal2-close" aria-label="Close this dialog" style="display: none;">×</button>
                                                                                </div>
                                                                                    <div class="swal2-content">
                                                                                    <div id="swal2-content" style="display: block;">Your loan guarantor has been changed to <b style="font-weight: 900;">'.ucwords(getUserInfoByStaffID("fname", $_POST["newid"]).' '.getUserInfoByStaffID("lname", $_POST["newid"])).'</b>. Confirmation Status: <span class="badge badge-pill badge-warning">Pending</span></div>
                                                                                    </div>
                                                                              </div>';
        		} else {
        		  $output = '';
        		}
                         }//mail success
		    
            }//outer loop
            
		} 
	
	header('Content-type: application/json');
	echo json_encode($output);
	exit();  
}	
		
	
	
	
		
	function getGResponse($loan_id, $guarantor_id){
                 global $connect;
                        $data = array(
                    	     ':loan_id' => $loan_id,
                    	     ':guarantor_staffid' => $guarantor_id
                    	     );
                          $query = "SELECT guarantor_response FROM loan_guarantors WHERE loan_id = :loan_id AND guarantor_staffid = :guarantor_staffid GROUP BY loan_id LIMIT 1";
                          $statement = $connect->prepare($query);
                          $statement->execute($data);
                          $result = $statement->fetchAll();
                          $badge ='';$edit ='';$form ='';
                          foreach($result as $row){
                              if($row["guarantor_response"] == "accept"){
                                 $badge = '<span class="badge badge-pill badge-success">Approved</span>';  
                               }
                               if($row["guarantor_response"] == "pending"){
                                 $badge = '<span class="badge badge-pill badge-warning">Pending</span>';  
                               }
                               if($row["guarantor_response"] == "decline"){
                                 $badge = '<span class="badge badge-pill badge-danger">Declined</span>';
                               }
                              if($row["guarantor_response"] != "accept"){
                                 $edit = '<span class="badge badge-pill badge-primary ml-2" data-lid="'.$loan_id.'" id="clickme'.$guarantor_id.'">Edit</span>';            
                               }
                          }  
                           
                           $response = $badge.$edit;
                          return $response;     
          }
          
	function getFormChange($loan_id, $guarantor_id){
	                 global $connect, $staffid;
                        $data = array(
                    	     ':loan_id' => $loan_id,
                    	     ':guarantor_staffid' => $guarantor_id
                    	     );
                          $query = "SELECT guarantor_response FROM loan_guarantors WHERE loan_id = :loan_id AND guarantor_staffid = :guarantor_staffid GROUP BY loan_id LIMIT 1";
                          $statement = $connect->prepare($query);
                          $statement->execute($data);
                          $result = $statement->fetchAll();
                         $form ='';
                          foreach($result as $row){
                              if($row["guarantor_response"] != "accept"){  
                              $query = "
                        		SELECT guarantor_one, guarantor_two FROM loan_request	
                        		WHERE id = '".$loan_id."'
                                 ";
                		$statement = $connect->prepare($query);
                		if($statement->execute())
                		{
                            $result = $statement->fetchAll();
                        	$list = array();
                			foreach($result as $row)
                			{
                              foreach ($row as $value) {
                                $list[] = $value;
                              }//filter out current user
                              $list[] = $staffid;
                		    } 
            $whitelist = implode(", ", array_unique($list));
                $query = "SELECT * FROM usertable WHERE status = 'verified' AND staffid NOT IN (".$whitelist.")";
            $statement = $connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $userlist = '<option value="" selected="" disabled="">-Select Garantor-</option>';
            foreach($result as $row)
			{
                $userlist .= '<option value="'.$row["staffid"].'">'.ucwords($row["fname"].' '.$row["lname"]).'</option>';
			}
			        $form .= '<div class="col-md-12 slide-out-div'.$guarantor_id.'" style="display:none; padding: 10px;background: #e1e1e1; border-radius: 8px;">
                         <form _lpchecked="1" id="loanForm'.$guarantor_id.'">
                          <div class="form-group">
                            <select class="form-control" name="newid">
                            '.$userlist.'
                            </select>
                            <div id="error_guarantor_one" style="color: red"> </div>
                          </div>
                           <div>
                            <input type="hidden" name="action" value="guarantor_change">
                            <input type="hidden" name="lid" value="'.$loan_id.'">
                            <input type="hidden" name="oldid" value="'.$guarantor_id.'">
                            <button type="button" class="btn btn-pill btn-primary btn-sm" onclick="changeGuarantor('.$guarantor_id.')" id="changeGuarantorBtn'.$guarantor_id.'">Save</button>
                          </div>
                        </form></div>
                        <script> $("#clickme'.$guarantor_id.'").click(function () {
                            if ($(".slide-out-div'.$guarantor_id.'").is(":hidden")) {
                                $(".slide-out-div'.$guarantor_id.'").slideDown();
                            } else {
                                $(".slide-out-div'.$guarantor_id.'").slideUp();
                            }
                            });
                        </script>';
        }
                                         
                               }
                          }           
		
         return $form;
	}

    function calcLoanInterest($amount, $duration){
    global $connect;
    $data = array(':id'=> getUserInfo("package"));
	    $query = "
          SELECT * FROM package
          WHERE id = :id
          LIMIT 1";
          $statement = $connect->prepare($query);
          $statement->execute($data);
          $result = $statement->rowCount();
          if($result > 0){
             $result = $statement->fetchAll();
                foreach($result as $row)
                 {
                     $loanAmount = trim($amount);
                     $loanPackageInterestRate = $row['package_interest_rate'];
                     $loanDuration = trim($duration);
                     $percent = ceil(($loanAmount + ($loanAmount * ( $loanPackageInterestRate / 100))) / $loanDuration);
                               $output = array(
                        			'monthlydue' => $percent,
                        			'biweekly'=> ceil($percent/2),
                        			'interest' =>   ($percent *  $loanDuration) -$loanAmount
                        		);
                 }
                 return json_encode($output);
                 exit();  
            }
}


	
function calcUserloanLimit($staffid){
    global $connect;
    $data = array(':id'=> getUserInfo("package"));
	    $query = "
          SELECT * FROM package
          WHERE id = :id
          LIMIT 1";
          $statement = $connect->prepare($query);
          $statement->execute($data);
          $result = $statement->rowCount();
          if($result > 0){
             $result = $statement->fetchAll();
                foreach($result as $row)
                 {
                      $accBalance = getContributionBalance($staffid);
                     return $limit = ceil($accBalance * $row['package_access_rate']);
                 }
        }
}

	
	
	
	function checkEmergencyLoanLimit($type, $amount){
	    if ($type = 2 && $amount > 1000000){
               return true;
        } 
        return false;
	}
	
	
 ?>