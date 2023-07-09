 <?php
require_once("../PH.php");

if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM expenditure 
	    
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			 WHERE expenditure.title LIKE "%'.$_POST["search"]["value"].'%" 
			  OR expenditure.amount LIKE "%'.$_POST["search"]["value"].'%"
			   OR expenditure.recipient_name LIKE "%'.$_POST["search"]["value"].'%"
			    OR expenditure.date LIKE "%'.$_POST["search"]["value"].'%"
			';
		}
       $query .= 'GROUP BY expenditure.id';
		
		if(isset($_POST["order"]))
		{
			$query .= '
			ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].'
			';
		}
		else
		{
			$query .= '
			ORDER BY expenditure.id DESC 
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
		$sn = 1;
foreach($result as $row)
		{
			$sub_array = array();
			$sub_array[] = $sn++;
			$sub_array[] = ucfirst($row["title"]);
			$sub_array[] = ucfirst($row["amount"]);
            $sub_array[] = ucfirst($row["recipient_name"]);
		    $sub_array[] = '<button type="button" data-id="'.$row["id"].'" class="btn btn-pill btn-dark btn-sm view-member">View</button>';
		    $sub_array[] = ucfirst($row["date"]);
            $data[] = $sub_array;
		}

function recordsTotal()
	{
	global $connect;
 $query = "	SELECT * FROM expenditure 
    	GROUP BY expenditure.id
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
	
	
	//update bio
if($_POST["action"] == "update_expenditure"){

$error = 0;
$title = "";
$amount = "";
$reason = "";
$error_title = "";
$error_amount = "";
$error_reason = "";
$error_recipient_bank = "";
$recipient_bank = "";
$error_recipient_account = "";
$recipient_account = "";
$error_recipient_name = "";
$recipient_name = "";


















if(empty($_POST["title"]))
{
	$error_title = 'Title is required';
	$error++;
} else {
	$title = $_POST["title"];
}

if(empty($_POST["amount"]))
{
	$error_amount = 'Amount is required';
	$error++;
} else {
	$amount = $_POST["amount"];
}

if(empty($_POST["reason"]))
{
	$error_reason = 'Reason is required';
	$error++;
} else {
	$reason = $_POST["reason"];
}

if(empty($_POST["recipient_bank"]))
{
	$error_recipient_bank = 'Recipient bank is required';
	$error++;
} else {
	$recipient_bank = $_POST["recipient_bank"];
}

if(empty($_POST["recipient_account"]))
{
	$error_recipient_account = 'Recipient account is required';
	$error++;
} else {
	$recipient_account = $_POST["recipient_account"];
}

if(empty($_POST["recipient_name"]))
{
	$error_recipient_name = 'Recipient name is required';
	$error++;
} else {
	$recipient_name = $_POST["recipient_name"];
}
        if($error > 0){
                $output = array(
                        'error'=> true,
                        'notice' =>	"Pay attention to the form below.",
                        'error_title'=> $error_title,
                        'error_amount'=> $error_amount,
                        'error_reason'=> $error_reason,
                        'error_recipient_name'=> $error_recipient_name,
                        'error_recipient_account'=> $error_recipient_account,
                        'error_recipient_bank'=> $error_recipient_bank
                    );
        } else {
                    //Process Transfer
            	    $amount = $_POST["amount"];
            	    $recipient = $_POST["recipient_code"];
            	    $title = $_POST["title"];
            	    
                	$url = "https://api.paystack.co/transfer";
                    $fields = [
                    'source' => "balance",
                    'amount' => $amount * 100,
                    'recipient' => $recipient,
                    'reason' => $title
                  ];
                  $fields_string = http_build_query($fields);
                  //open connection
                  $ch = curl_init();
                  $skey = getSystemSetting('paystack_live_secretkey');
                  //set the url, number of POST vars, POST data
                  curl_setopt($ch,CURLOPT_URL, $url);
                  curl_setopt($ch,CURLOPT_POST, true);
                  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    "Authorization: Bearer ".$skey,
                    "Cache-Control: no-cache",
                  ));
                  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
                  $response = curl_exec($ch);
                  $result = json_decode($response);
                  //$output = $result;
                    if($result->status == true) {
                         
                          $html = "";
                        
                        $response_msg =  $result->message;
                        $reference = $result->data->reference;
                        $amount = $result->data->amount / 100;
                        //$ip = getUserIpAddr();
                        $data = array(
                            ':admin_id' => $_SESSION['admin_id'], 
                            ':title' => $result->data->reason,
                            ':amount' => $amount,
                            ':reason' => $reason,
                            ':recipient_name' => $recipient_name,
                            ':recipient_account' => $recipient_account,
                            ':recipient_bank' => $recipient_bank,
                            ':transaction_id' => $result->data->id,
                            ':recipient' => $result->data->recipient,
                            ':transfer_code' => $result->data->transfer_code,
                            ':reference' => $reference,
                            ':currency' => $result->data->currency,
                            ':status'=> $result->data->status, 
                            ':ip' => getUserIpAddr(),
                            ':time'=> time(), 
                            ':date' => date('Y-m-d', time())
                        );

                            $query = "
                            INSERT INTO expenditure
                            (admin_id, title, amount, reason, recipient_name, recipient_account, recipient_bank, transaction_id, recipient, transfer_code, reference, currency, status, ip, time, date)
                            VALUES
                            (:admin_id, :title, :amount, :reason, :recipient_name, :recipient_account, :recipient_bank, :transaction_id, :recipient, :transfer_code, :reference, :currency, :status, :ip, :time, :date)
                            ";
                                                $statement = $connect->prepare($query);
                                                if($statement->execute($data)){
                                                        //verify transaction (move it to its own page)
                                                         $curl = curl_init();
                                                         $skey = getSystemSetting('paystack_live_secretkey');
                                                            curl_setopt_array($curl, array(
                                                                    CURLOPT_URL => "https://api.paystack.co/transfer/verify/".rawurlencode($reference),
                                                                    CURLOPT_RETURNTRANSFER => true,
                                                                    CURLOPT_ENCODING => "",
                                                                    CURLOPT_MAXREDIRS => 10,
                                                                    CURLOPT_TIMEOUT => 30,
                                                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                                    CURLOPT_CUSTOMREQUEST => "GET",
                                                                    CURLOPT_HTTPHEADER => array(
                                                                      "Authorization: Bearer ".$skey,
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
                                                                               $html .= '
                                                                                 <div style="background: white; padding: 1em; border-radius: .65rem;">
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
                                                                                        <div id="swal2-content" style="display: block;">You just sent <b style="font-weight:bold">N'.$amount.'</b> to <b style="font-weight:bold">'.ucwords($recipient_name).'</b></div>
                                                                                        </div>
                                                                                    <div class="swal2-actions" style="display: flex;">
                                                                                    <button type="button" type="button" class="swal2-confirm btn btn-success" data-dismiss="modal">Close</button>
                                                                                  </div>
                                                                                  </div>';
                                                                                    $output = array('success'=> true, 'html'=> $html);
                                                                  }else{
                                                                     //still in que but not yet verified
                                                                     $html .= 'still queued';
                                                                    $output = array('success'=> true, 'html'=> $html);
                                                                  }
                                             }//if inserted into transaction database
                        
                        
                                           
                       
                    }else {
                        //withdrawal failed
                        $output = $result;
                    }  
   
         }//error check
    
echo json_encode($output);
exit();
}





	
	
	
	
	
	//Get account info
if($_POST["action"] == "fetch_info")
	{
 $output = "";$html = "";
	                $account_no = $_POST["recipient_account"];
	                $bankcode = $_POST["recipient_bank"];
                    $username = $_POST["recipient_name"];
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
                                      $skey = getSystemSetting('paystack_live_secretkey');
                                      //set the url, number of POST vars, POST data
                                      curl_setopt($ch,CURLOPT_URL, $url);
                                      curl_setopt($ch,CURLOPT_POST, true);
                                      curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                                      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                        "Authorization: Bearer ".$skey,
                                        "Cache-Control: no-cache",
                                      ));
                                      
                                      //So that curl_exec returns the contents of the cURL; rather than echoing it
                                      curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
                                      $response = curl_exec($ch);//execute post
                                      $result = json_decode($response);
                                        if($result->status == true) {
                                             if($result->data->active == true) {
                                        
                                                        $html .='
                                                        <div class="form-group col-md-12">
                                                        <div class="alert d-block align-content-center alert-success fade show">
                                                        <div class="d-flex align-content-center">
                                                        <span class="font-size-lg d-block d-40 mr-2 text-center"><i class="far fa-question-circle"></i></span>
                                                        <span class=" d-block mr-2 text-center"><strong class="d-40">Account Verification!</strong></span>
                                                        </div>
                                                        <div><p>
                                                        <span><b>Account Holder:</b> '.$result->data->details->account_name.'</span><br>
                                                        <span><b>Account No:</b> '.$result->data->details->account_number.'</span><br>
                                                        <span><b>Bank Name:</b> '.$result->data->details->bank_name.'</span><br>
                                                        </p></div>
                                                        </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                        <label>Amount:</label>
                                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="N0.00"/>
                                                        <div id="error_amount" style="color: red"> </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                        <label>Transaction Reason:</label>
                                                        <textarea placeholder="Describe your expense:" name="reason" id="reason" class="form-control"></textarea>
                                                        <div id="error_reason" style="color: red"> </div>  
                                                        </div>
                                                        <div class="form-group col-md-12" style="text-align: right;">
                                                        <input type="hidden" name="action" value="update_expenditure"/>
                                                        <input type="hidden" id="recipient_code" name="recipient_code" value="'.$result->data->recipient_code.'">
                                                        <button class="btn btn-pill btn-primary" type="submit" id="save_btn">Proceed</button>
                                                        <button type="button" class="btn btn-default btn btn-pill btn-sm" data-dismiss="modal" id="close_btn">Close</button>
                                                        </div>';
                                                         $output .=  $html;                         
                                                 }  
                                        } else {
                                            //failed to fetch info from paystack
                                            $output .= '
                                            <div class="form-group col-md-12">
                                            <div class="alert d-flex align-items-center pl-2 align-content-center alert-danger fade show" role="alert">
                                            <span class="font-size-lg d-block d-40 mr-2 text-center"><i class="fas fa-headset"></i></span>
                                            <span><strong class="d-block">Verification Failed!</strong> 
                                            Sorry, we can not retrieve your info at the moment. Try again later.
                                            </span>
                                            </div></div>';
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
//the new code
  if($_POST["action"] == "single_fetch")
	{
		$query = "
    		SELECT * FROM expenditure		
    		WHERE id = '".$_POST["id"]."'
        ";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
        	$result = $statement->fetchAll();
			$output = '
			<div class="modal-header">
                  <h4 class="modal-title">Transaction Record</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body" id="view_user_details">
                  <div class="row">
			';
			foreach($result as $row)
			{
				$output .= '
				<div class="col-md-12">
					<table class="table">
					<div class="alert alert-info" role="alert">
                   <b>N'.$row["amount"].'</b> payout to <b>'.ucwords($row["recipient_name"]).'</b>
                    </div>
						<tr>
							<th>Transaction Title::</th>
							<td>'.ucwords($row["title"]).'</td>
						</tr>
						<tr>
				    <th>Amount :</th>
				    <td>'.$row["amount"].'</td>
						</tr>
						<tr>
        			<th>Recipient Name:</th>
        			<td>'.ucwords($row["recipient_name"]).'</td>
        						</tr>
        						<tr>
        			<th>Recipient Account No:</th>
        			<td>'.$row["recipient_account"].'</td>
        						</tr>
        						<tr>
        			<th>Recipient Bank:</th>
        			<td>'.getBankByCode($row["recipient_bank"]).'</td>
        						</tr>
        						<tr>
        			<th>Transaction Reason:</th>
        			<td>'.ucfirst($row["reason"]).'</td>
					</tr>
					</table>
				</div>
				
			
				';
			}
			$output .= '</div><div class="modal-footer">
                <button type="button" class="btn btn-default btn-pill btn-sm" data-dismiss="modal">Close</button>
              </div>
              </div>
			';
			echo $output;
			exit();
		}
	}

      
	function getBankByCode($code){
	     global $connect;
		 $data = array(':code'=> $code);
	$query = "
	    SELECT bankname FROM banks
		WHERE bankcode = :code
		LIMIT 1
		";
		$statement = $connect->prepare($query);
		$bank = "Error";
        if($statement->execute($data)){
            $result = $statement->fetchAll();
            foreach($result as $row)
		       {
	                $bank = $row["bankname"];
    	       }
        }
	     return $bank;
	   } 
