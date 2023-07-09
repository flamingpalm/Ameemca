<?php
 require_once "../pdo.php";




//Get account info
if($_POST["action"] == "fetch_info")
	{
        $output = "";
        $html = "";
        $username = "";
	    $account_no = "";
	    $bankcode = "";
	    
	    $query = "SELECT * FROM usertable 
		INNER JOIN userbank 
		ON usertable.staffid = userbank.staffid
		INNER JOIN banks 
		ON banks.id = ".$_POST['bid']."
		WHERE usertable.staffid = ".$staffid."
		AND userbank.staffid = ".$staffid."
		AND userbank.bank_id = ".$_POST['bid']."
		GROUP BY userbank.id
		ORDER BY userbank.id DESC
		LIMIT 1";
		$statement = $connect->prepare($query);
        if($statement->execute()){
            $result = $statement->fetchAll();
            foreach($result as $row)
		       {
		            $username = $row["fname"].' '.$row["lname"];
	                $account_no = $row["account_no"];
	                $bankcode = $row["bankcode"];
    	        }
                                     //generate recipient auth code
                                      $url = "https://api.paystack.co/transferrecipient";
                                      $fields = [
                                        'type' => "nuban",
                                        'name' => $username,
                                        'account_number' => $account_no,
                                        'bank_code' => $bankcode,
                                        'currency' => "NGN"
                                      ];
                                      $fields_string = http_build_query($fields);
                                      //open connection
                                      $ch = curl_init();
                                      
                                      //set the url, number of POST vars, POST data
                                      curl_setopt($ch,CURLOPT_URL, $url);
                                      curl_setopt($ch,CURLOPT_POST, true);
                                      curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                                      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                         "Authorization: Bearer ".$secket_key_live,
                                        "Cache-Control: no-cache",
                                      ));
                                      
                                      //So that curl_exec returns the contents of the cURL; rather than echoing it
                                      curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
                                      $response = curl_exec($ch);//execute post
                                      $result = json_decode($response);
                                        
                                        if($result->status == true) {
                                             if($result->data->active == true) {
                                        
                                                        $html .='<div class="alert d-block align-content-center alert-success fade show">
                                                        <div class="d-flex align-content-center">
                                                        <span class="font-size-lg d-block d-40 mr-2 text-center"><i class="far fa-question-circle"></i></span>
                                                        <span class=" d-block mr-2 text-center"><strong class="d-40">Verify Info!</strong></span>
                                                        </div>
                                                        <div><p>
                                                        <span><b>Account Name:</b> '.$result->data->details->account_name.'</span><br>
                                                        <span><b>Account No:</b> '.$result->data->details->account_number.'</span><br>
                                                        <span><b>Bank Name:</b> '.$result->data->details->bank_name.'</span><br>
                                                        </p></div>
                                                        </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="amount">Amount</label>
                                                                <input type="number" class="form-control" id="amount" placeholder="0.00">
                                                            </div>
                                                         <div class="form-group col-md-12">
                                                                 <input type="hidden" id="recipient" name="recipient" value="'.$result->data->recipient_code.'">
                                                                 <input type="hidden" id="reason" value="Funds Withdrawal"name="reason">
                                                                <button class="btn btn-pill btn-primary" type="button" onclick="processWithdrawal()">Proceed</button>
                                                            </div>
                                                    ';
                                                 $output .=  $html;                         
                                                 
                                                 
                                             }  
                                        } else {
                                            //failed to fetch info from paystack
                                            $output .= '<div class="alert d-flex align-items-center pl-2 align-content-center alert-danger fade show" role="alert">
                                                        <span class="font-size-lg d-block d-40 mr-2 text-center">
                                                            <i class="fas fa-headset"></i>
                                                        </span>
                                                        <span>
                                                            <strong class="d-block">Verification Failed!</strong> Sorry, we can not retrieve your info at the moment. Try again later.
                                                        </span></div>';
                                        }
                                        	        
                                        	        
        } else {
                                            //failed to retrieve from database
                                            $output .= '<div class="alert d-flex align-items-center pl-2 align-content-center alert-danger fade show" role="alert">
                                                            <span class="font-size-lg d-block d-40 mr-2 text-center">
                                                                <i class="fas fa-headset"></i>
                                                            </span>
                                                            <span>
                                                                <strong class="d-block">Verification Failed!</strong> Sorry, we do not have such records. Kindly contact admin.
                                                            </span></div>';
        }
        
	    echo json_encode($output);
		exit();
	}
	   
	   
	   
	   
// Process Withdrawal
if($_POST["action"] == "process_withdrawal")
	{	   
	    //Check Balance
	    $oldBalance = getAccountBalance($staffid);
	    if($oldBalance > sanitizeNumber($_POST["amount"])){
	        //Can Withdraw
	         //process transfer
        	    $amount = sanitizeNumber($_POST["amount"]);
        	    $recipient = trim(strip_tags(stripslashes($_POST["recipient"])));
        	    $reason = sanitizeText($_POST["reason"]);

                	$url = "https://api.paystack.co/transfer";
                    $fields = [
                    'source' => "balance",
                    'amount' => $amount * 100,
                    'recipient' => $recipient,
                    'reason' => $reason
                  ];
                  $fields_string = http_build_query($fields);
                  //open connection
                  $ch = curl_init();
                  
                  //set the url, number of POST vars, POST data
                  curl_setopt($ch,CURLOPT_URL, $url);
                  curl_setopt($ch,CURLOPT_POST, true);
                  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                     "Authorization: Bearer ".$secket_key_live,
                    "Cache-Control: no-cache",
                  ));
                  
                  //So that curl_exec returns the contents of the cURL; rather than echoing it
                  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
                  
                  //execute post
                  $response = curl_exec($ch);
                  $result = json_decode($response);
                                        
                                        if($result->status == true) {
                                             $staffid = $_SESSION['staffid'];
                                             $reference = $result->data->reference;
                                             $amount = $result->data->amount / 100;
                                             $currency = $result->data->currency;
                                             $status = $result->data->status;
                                             $type = "Withdrawal";
                                             $medium = "Processed";
                                             $ip = getUserIpAddr();
                                             $time = time();
                                             $date = date('Y-m-d', $time);
                                             
                                             //$transfer_code =  $result->data->transfer_code;
                                             //$recipient= $result->data->recipient;
                                             //$reason = $result->data->reason;
                                             //$response_msg =  $result->message;
                                             //$id =  $result->data->id;
                                             //$output = $result->message;
                                            
                                                    $data = array(
                                            	        ':staffid'=> $staffid, 
                                            	        ':reference' => $reference,
                                            	        ':amount'=> $amount, 
                                            	        ':currency' => $currency,
                                            	        ':status'=> $status, 
                                            	        ':type' => $type,
                                            	        ':medium'=> $medium, 
                                            	        ':ip' => $ip,
                                            	        ':time'=> $time, 
                                            	        ':date' => $date
                                            	        );
                                            
                                                    $query = "INSERT INTO transaction 
                                                            (staffid, amount, currency, refcode, status, type, medium, ip_address, time, date)
                                                            VALUES 
                                                            (:staffid, :amount, :currency, :reference, :status, :type, :medium, :ip, :time, :date)";
                                                $statement = $connect->prepare($query);
                                                if($statement->execute($data)){
                                                    
                                                    //update balance
                                                    $newBalance = $oldBalance - $amount;
                                                    $data = array(':staffid'=> $staffid, ':balance'=> $newBalance, ':time'=> $time);
                                            	    $query = "UPDATE account_balance SET balance = :balance, time = :time WHERE staffid = :staffid	";
                                            		$statement = $connect->prepare($query);
                                                    if($statement->execute($data)){
                                                        
                                                       //verify transaction (move it to its own page)
                                                         $curl = curl_init();
                                                            curl_setopt_array($curl, array(
                                                                    CURLOPT_URL => "https://api.paystack.co/transfer/verify/".rawurlencode($reference),
                                                                    CURLOPT_RETURNTRANSFER => true,
                                                                    CURLOPT_ENCODING => "",
                                                                    CURLOPT_MAXREDIRS => 10,
                                                                    CURLOPT_TIMEOUT => 30,
                                                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                                    CURLOPT_CUSTOMREQUEST => "GET",
                                                                    CURLOPT_HTTPHEADER => array(
                                                                       "Authorization: Bearer ".$secket_key_live,
                                                                      "Cache-Control: no-cache",
                                                                    ),
                                                                  ));
                                                                  
                                                                  $response = curl_exec($curl);
                                                                  $err = curl_error($curl);
                                                                  curl_close($curl);
                                                                  
                                                                  if ($err) {
                                                                    echo "cURL Error #:" . $err;
                                                                  } else {
                                                                    $result = json_decode($response);
                                                                  }
                                                                  
                                                                  if ($result->status  == true) {
                                                                      //verified payout
                                                                               $output = '
                                                                                 <div style="background: white;">
                                                                                 <div class="swal2-header">
                                                                                 <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                                                                                    <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                                                                    <span class="swal2-success-line-tip"></span> 
                                                                                    <span class="swal2-success-line-long"></span>
                                                                                    <div class="swal2-success-ring"></div> 
                                                                                    <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                                                    <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                                                                    </div>
                                                                                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Transaction Successful</h2>
                                                                                    </div>
                                                                                        <div class="swal2-content">
                                                                                        <div id="swal2-content" style="display: block;">Your withdrawal was successful...</div>
                                                                                        </div>
                                                                                    <div class="swal2-actions" style="display: flex;">
                                                                                    <a type="button" class="swal2-confirm btn btn-success" aria-label="" style="display: inline-block;color: white;" href="account-history.php">Transaction History</a>
                                                                                  </div>
                                                                                  </div>';
                                                                  }else{
                                                                      //still in que but not yet verified
                                                                     $output = '
                                                                                 <div style="background: white;">
                                                                              <div class="swal2-header">
                                                                                 <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"></div>
                                                                                     <h2 class="swal2-title" id="swal2-title" style="display: flex;">Request Queued!</h2>
                                                                                     </div>
                                                                                    <div class="swal2-content">
                                                                                      <div id="swal2-content" style="display: block;">Your withdrawl request has been queued. Your request would be completed within the next 24hrs.</div>
                                                                                      </div>
                                                                                     <div class="swal2-actions" style="display: flex;">
                                                                                     <a type="button" class="swal2-confirm btn btn-warning" aria-label="" style="display: inline-block;color: white;" href="account-history.php">Transaction History</a>
                                                                                     </div>   
                                                                                 </div>';
                                                                      
                                                                  }
                                            
                                                       
                                                    } //if inserted into account_balance database
                                             }//if inserted into transaction database
                                            
                                            
                                            
   

                          
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                        }else {
                                            //withdrawal failed
                                             $output = '
                     <div style="background: white;">
                  <div class="swal2-header">
                     <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"></div>
                         <h2 class="swal2-title" id="swal2-title" style="display: flex;">Withdrawal Failed</h2>
                         </div>
                        <div class="swal2-content">
                          <div id="swal2-content" style="display: block;">We can\'t process your transaction at the moment. Please try again later.</div>
                          </div>
                         <div class="swal2-actions" style="display: flex;">
                         <a type="button" class="swal2-confirm btn btn-warning" aria-label="" style="display: inline-block;color: white;" href="account-history.php">Transaction History</a>
                         </div>   
                     </div>';
                }
	        
	    } else {
	        //Insufficient Balance 
	            $output = '
                     <div style="background: white;">
                  <div class="swal2-header">
                     <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"></div>
                         <h2 class="swal2-title" id="swal2-title" style="display: flex;">Withdrawal Failed</h2>
                         </div>
                        <div class="swal2-content">
                          <div id="swal2-content" style="display: block;">Insufficient Balance</div>
                          </div>
                         <div class="swal2-actions" style="display: flex;">
                         <a type="button" class="swal2-confirm btn btn-warning" aria-label="" style="display: inline-block;color: white;" href="account-history.php">Transaction History</a>
                         </div>   
                     </div>';
	        
	    }//Check Balance
	    
	    
	   
                                        
        echo json_encode($output);
		exit();
                                        
	} 