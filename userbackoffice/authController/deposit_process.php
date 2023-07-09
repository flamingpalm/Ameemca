<?php
include_once '../pdo.php';

if($_POST["action"] == "verify")
	{
$ref = trim($_POST['token']); 
if(!empty($ref)){

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/".rawurlencode($ref),
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


  if ($result->data->status == 'success') {
      //$amount = $result->data->amount / 100;
      $status = $result->data->status; 
      $time = time();
      $date = date('Y-m-d', $time);
      $currency = $result->data->currency;
      $ip = $result->data->ip_address;
      $refcode = $result->data->reference;
      $medium = $result->data->channel;
      $type = $result->data->metadata->custom_fields[0]->type;
      $amount = $result->data->metadata->custom_fields[0]->real_amt  / 100;
      //check deposit user id and session uid
                     $data = array(':staffid'=> $staffid, ':refcode'=> $refcode);
                    $query = "SELECT * FROM transaction WHERE staffid =:staffid AND refcode =:refcode LIMIT 1";
		            $statement = $connect->prepare($query);
                    $statement->execute($data);
                     $result = $statement->rowCount();
                    if($result > 0){
                        //record exists so exit
                        $msg = '<div style="background: white;">
                  <div class="swal2-header">
                     <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"></div>
                         <h2 class="swal2-title" id="swal2-title" style="display: flex;">Deposit Failed</h2>
                         </div>
                        <div class="swal2-content">
                          <div id="swal2-content" style="display: block;">Sorry, we are unable to process your transaction.</div>
                          </div>
                         <div class="swal2-actions" style="display: flex;">
                         <a type="button" class="swal2-confirm btn btn-warning" aria-label="" style="display: inline-block;color: white;" href="account-history">Transaction History</a>
                         </div>   
                     </div>';
                          $output = array(
        						'failed' => true,
        						'notice' =>	$msg,
    						    );
                      } else{
                          //does not exist
                           //update transaction
                            $data = array(
                                        ':staffid'=> $staffid, 
                                        ':amount'=> $amount,
                                        ':currency'=> $currency, 
                                        ':refcode'=> $refcode,
                                        ':status'=> $status, 
                                        ':type'=> $type,
                                        ':medium'=> $medium,
                                        ':ip'=> $ip, 
                                        ':time'=> $time,
                                        ':date'=> $date
                                        );
                    	    $query = "INSERT INTO transaction (staffid, amount, currency, refcode, status, type, medium, ip_address, time, date)
                                            VALUE (:staffid, :amount, :currency, :refcode, :status, :type, :medium, :ip, :time, :date)";
                    		$statement = $connect->prepare($query);
                         if($statement->execute($data)){
                              //update balance
                            $oldBalance = getAccountBalance($staffid);
                            $newBalance = $oldBalance + $amount;
                            $data = array(':staffid'=> $staffid, ':balance'=> $newBalance, ':time'=> $time);
                    	    $query = "UPDATE account_balance SET balance = :balance, time = :time WHERE staffid = :staffid";
                    		$statement = $connect->prepare($query);
                            if($statement->execute($data)){
                          //header('Location: account-history.php');
                          $msg = '
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
                            <h2 class="swal2-title" id="swal2-title" style="display: flex;">Deposit Successful</h2>
                            </div>
                                <div class="swal2-content">
                                <div id="swal2-content" style="display: block;">Your Ameemca Savings wallet has been credited with N'.$amount.'</div>
                                </div>
                            <div class="swal2-actions" style="display: flex;">
                            <a type="button" class="swal2-confirm btn btn-success" aria-label="" style="display: inline-block;color: white;" href="account-history"> Transaction History</a>
                          </div></div>';
                             $output = array(
                                'approved' => true,
        						'notice' =>	$msg
    						    );
                            }
                         }
                      }
      }
echo json_encode($output);
exit();
}
	    
	    
	    
	    
	}
?>