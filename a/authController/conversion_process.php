 <?php
require_once("../PH.php");

if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT A.id, A.amount, A.time, A.staffid, A.status, B.fname, B.lname FROM( 
    SELECT id, amount, time, staffid, status FROM conversion) As A
    JOIN (SELECT staffid, fname, lname FROM usertable) As B
    ON A.staffid = B.staffid
	    
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			 WHERE A.amount LIKE "%'.$_POST["search"]["value"].'%"
			  OR A.staffid LIKE "%'.$_POST["search"]["value"].'%"
			   OR A.status LIKE "%'.$_POST["search"]["value"].'%"
			   OR B.fname LIKE "%'.$_POST["search"]["value"].'%"
			  OR B.lname LIKE "%'.$_POST["search"]["value"].'%"
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
		    if($row["status"] == "approved"){
		         $status = "<label class='badge badge-pill badge-success' style='opacity:.7'>APPROVED</label>";
		    } else {
		         $status = "<label class='badge badge-pill badge-primary conversion-item' data-cid='".$row["id"]."' data-amount='".$row["amount"]."' data-sid='".$row["staffid"]."'>APPROVE NOW</label>";
		    }
		    
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
		    
		    
		    
			$sub_array = array();
			$sub_array[] = $sn++;
			$sub_array[] = ucwords($row["fname"].' '.$row["lname"]);
			$sub_array[] = $row["staffid"];
			$sub_array[] = $row["amount"];
		    $sub_array[] = $walletbal;
		    $sub_array[] = $contributionbal;
		    $sub_array[] = $loanbal;
            $sub_array[] = $status;
            $sub_array[] = date('jS M, Y', $row["time"]);
            $data[] = $sub_array;
		}

function recordsTotal()
	{
	global $connect;
 $query = "	SELECT A.id, A.amount, A.time, A.staffid, B.fname, B.lname FROM( 
    SELECT id, amount, time, staffid FROM conversion) As A
    JOIN (SELECT staffid, fname, lname FROM usertable) As B
    ON A.staffid = B.staffid
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
if($_POST["action"] == "update_conversion"){
  $data = array(
                ':cid'=> sanitizeNumber($_POST["cid"]),
                ':status'=> 'approved'
            );

 $query = "SELECT id FROM conversion WHERE id =:cid AND status= :status";
            $statement = $connect->prepare($query);
            $statement->execute($data);
            $rows = $statement->fetchAll();
            $statement->setFetchMode(PDO::FETCH_ASSOC);           
            if (count($rows) > 0) {             
                   $output = array(
                    	'saved' => true,
                    	'notice' =>	'<div class="alert d-flex align-items-center pl-4 align-content-center alert-warning show">
                        	<span><strong class="d-block">Notice!</strong>Already Approved!</span></div>'
                	);                   
            } else {
        //Balance Check
        $oldBalance = getAccountBalance(sanitizeNumber($_POST["sid"]));
	    if($oldBalance >= sanitizeNumber($_POST["amount"])){  
                $newBalance = $oldBalance - sanitizeNumber($_POST["amount"]);
                //update wallet
                //increase contribution
                 $sid = sanitizeNumber($_POST["sid"]);
                 $amount = sanitizeNumber($_POST["amount"]);
    if(updateSavingsWalletBalance($sid, $newBalance)){
    if(addToUserContribution($sid, $amount)){
         //Approve Request
                $query = "UPDATE conversion SET status= :status WHERE id =:cid";
                $statement = $connect->prepare($query);
                if($statement->execute($data)){
                         $output = array(
                        	'saved' => true,
                        	'notice' =>	'<div class="alert d-flex align-items-center pl-4 align-content-center alert-success show">
                        	<span><strong class="d-block">Success!</strong>Transfer Approved!</span></div>'
                    	);
                }else{
                       $output = array(
                        	'error' => true,
                        	'notice' =>	'<div class="alert d-flex align-items-center pl-4 align-content-center alert-danger show">
                        	<span><strong class="d-block">Failed!</strong>Transfer Failed!</span></div>',
                    	);
                  }
        
    }  else {
                $output = array(
                        	'error' => true,
                        	'notice' =>	'<div class="alert d-flex align-items-center pl-4 align-content-center alert-danger show">
                        	<span><strong class="d-block">An Error Occured!</strong>Kindly report this error to the maintenance team.</span></div>',
                    	);
            }
} else {
                $output = array(
                        	'error' => true,
                        	'notice' =>	'<div class="alert d-flex align-items-center pl-4 align-content-center alert-danger show">
                        	<span><strong class="d-block">An Error Occured!</strong>Kindly report this error to the maintenance team.</span></div>',
                    	);
            }
            } else {
                $output = array(
                        	'error' => true,
                        	'notice' =>	'<div class="alert d-flex align-items-center pl-4 align-content-center alert-danger show">
                        	<span><strong class="d-block">Failed!</strong>Insufficient savings wallet balance.</span></div>',
                    	);
            }//bal check
            }

echo json_encode($output);
exit();
}



function updateSavingsWalletBalance($sid, $amount){
    global $connect;
    $data = array(':staffid'=> $sid, ':amount'=> $amount);
	$query = "UPDATE account_balance SET balance =:amount WHERE staffid = :staffid";
    $statement = $connect->prepare($query);
    if($statement->execute($data)){
        		   return true;
        	} else {
        		   return false;
		    }
    }

function addToUserContribution($sid, $amount){
    global $connect;
             $data = array(
				':staffid' => $sid,
				':amount' =>  $amount,
				':date'	=>	date("Y-m-d")
			);
			$query = "
			INSERT INTO contributions 
			(staffid, amount, date) 
			VALUES (:staffid, :amount, :date)
			";
			$statement = $connect->prepare($query);
		    if($statement->execute($data)){
        		   return true;
        	} else {
        		   return false;
		    }
        }
	
	
