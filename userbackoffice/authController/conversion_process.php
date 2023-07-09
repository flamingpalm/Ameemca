 <?php
require "../pdo.php";

if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT A.id, A.amount, A.time, A.staffid, A.status, B.fname, B.lname FROM( 
    SELECT id, amount, time, staffid, status FROM conversion) As A
    JOIN (SELECT staffid, fname, lname FROM usertable) As B
    ON A.staffid = B.staffid
	    WHERE A.staffid = :staffid
	    AND ( 
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			  A.amount LIKE "%'.$_POST["search"]["value"].'%"
			  OR A.staffid LIKE "%'.$_POST["search"]["value"].'%"
			   OR A.status LIKE "%'.$_POST["search"]["value"].'%"
			   OR B.fname LIKE "%'.$_POST["search"]["value"].'%"
			  OR B.lname LIKE "%'.$_POST["search"]["value"].'%")
			';
		}
       $query .= 'GROUP BY A.id';
		
		if(isset($_POST["order"]))
		{
			$query .= '
			ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].'
			';
		}
		else
		{
			$query .= '
			ORDER BY A.id DESC 
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
foreach($result as $row)
		{
		    if($row["status"] == "approved"){
		         $status = "<label class='badge badge-pill badge-success' style='opacity:1'>Approved</label>";
		    } else {
		         $status = "<label class='badge badge-pill badge-warning'>Pending</label>";
		    }
		    
		   
		    
			$sub_array = array();
			$sub_array[] = $sn++;
            $sub_array[] = date('jS M, Y', $row["time"]);
			$sub_array[] = $row["amount"];
            $sub_array[] = $status;
            $data[] = $sub_array;
		}

function recordsTotal()
	{
	global $connect;
 $query = "	SELECT A.id, A.amount, A.time, A.staffid, B.fname, B.lname FROM( 
    SELECT id, amount, time, staffid FROM conversion) As A
    JOIN (SELECT staffid, fname, lname FROM usertable) As B
    ON A.staffid = B.staffid
     WHERE A.staffid = :staffid
";
 $statement = $connect->prepare($query);
 $dataArr = array(':staffid'=> $staffid);
 $statement->execute( $dataArr);
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
if($_POST["action"] == "convert_wallet"){
                    
$error_amount = '';
$amount ='';
$count = 0;

if(empty($_POST["amount"]))
		{
			$error_amount = 'Enter an amount.';
			$error++;
		}
		else {
			$amount = sanitizeNumber($_POST["amount"]);
		}

	 if($error > 0){
	            //error
		          $output = array (
		                'error'=> true,
                        'error_amount'=> $error_amount
                    ); 
	 } else {
	     
	     //Time Restriction
	     $data = array (':staffid'=> $staffid, ':time'=> time());
            $query = "SELECT id FROM conversion
                WHERE staffid = :staffid
                AND expiry >= :time
                ORDER BY id DESC
                LIMIT 1";
                $statement = $connect->prepare($query);
                $statement->execute($data);
                $result = $statement->rowCount();
                if($result > 0){
                     $html = '
                        <div style="background: white; padding: 1em; border-radius: .65rem;">
                        <div class="swal2-header">
                     <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"></div>
                         <h2 class="swal2-title" id="swal2-title" style="display: flex;">Request Denied</h2>
                         </div>
                        <div class="swal2-content">
                          <div id="swal2-content" style="display: block;">Its been less than 48hrs since your last request.</div>
                          </div>
                         <div class="swal2-actions" style="display: flex;">
                         <a type="button" class="swal2-confirm btn btn-warning" aria-label="" style="display: inline-block;color: white;" href="conversion.php">OK</a>
                         </div>   
                     </div>';
                                    
                                     $output = array(
                                    	'success' => true,
                                    	'html' =>	$html
                                	); 
                } else {
	                    //Check Wallet Balance Balance
	    $oldBalance = getAccountBalance($staffid);
	    if($oldBalance > sanitizeNumber($_POST["amount"])){
	                     $data = array(
                        ':staffid'=> $staffid,
                        ':amount'=> $amount,
                        ':status'=> 'notapproved',
                        ':time'=> time(),
                        ':expiry'=> time() + (60*60*48) 
                    );
                $query = " INSERT INTO conversion
                            (staffid, amount, status, time, expiry)
                            VALUES
                            (:staffid, :amount, :status, :time, :expiry)
                            ";
                $statement = $connect->prepare($query);
                if($statement->execute($data)){
                    //Saved
                           $html = '
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
                                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Request Submitted!</h2>
                                    </div>
                                        <div class="swal2-content">
                                        <div id="swal2-content" style="display: block;">Your wallet deduction request is awaiting approval.</div>
                                        </div>
                                    <div class="swal2-actions" style="display: flex;">
                                    <a type="button" class="swal2-confirm btn btn-success" aria-label="" style="display: inline-block;color: white;" href="conversion.php">OK</a>
                                  </div>
                                  </div>';
                                    
                                $output = array(
                                	'success' => true,
                                	'html' =>	$html
                            	);
                        
                }else{
                    //Failed
                             $html = '
                                 <div style="background: white; padding: 1em; border-radius: .65rem;">
                  <div class="swal2-header">
                     <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"></div>
                         <h2 class="swal2-title" id="swal2-title" style="display: flex;">Request Failed</h2>
                         </div>
                        <div class="swal2-content">
                          <div id="swal2-content" style="display: block;">An error occured.</div>
                          </div>
                         <div class="swal2-actions" style="display: flex;">
                         <a type="button" class="swal2-confirm btn btn-warning" aria-label="" style="display: inline-block;color: white;" href="conversion.php">OK</a>
                         </div>   
                     </div>';
                                    
                                     $output = array(
                                    	'success' => true,
                                    	'html' =>	$html
                                	);
                  }        
	     
	    } else {
	        //Insufficient Balance 
	            $html = '
                     <div style="background: white; padding: 1em; border-radius: .65rem;">
                  <div class="swal2-header">
                     <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"></div>
                         <h2 class="swal2-title" id="swal2-title" style="display: flex;">Request Failed!</h2>
                         </div>
                        <div class="swal2-content">
                          <div id="swal2-content" style="display: block;">Insufficient Savings Wallet Balance. <br> Kindly fund your savings wallet and retry.</div>
                          </div>
                         <div class="swal2-actions" style="display: flex;">
                         <a type="button" class="swal2-confirm btn btn-warning" aria-label="" style="display: inline-block;color: white;" href="conversion.php">OK</a>
                         </div>   
                     </div>';
	                        $output = array(
                                    	'success' => true,
                                    	'html' =>	$html
                                	);
	    }//Check Balance
	    
	           
        }//Time restriction
	     
	     
	     
	     
	     
	 }//error


                    

echo json_encode($output);
exit();
}

	
	
	
