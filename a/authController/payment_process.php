<?php
  require_once("../../userbackoffice/DB.php");
    
if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM usertable WHERE NOT staffid = '210035'
	    
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			AND (usertable.allotment_amount LIKE "%'.$_POST["search"]["value"].'%"
			OR usertable.fname LIKE "%'.$_POST["search"]["value"].'%"
			OR usertable.lname LIKE "%'.$_POST["search"]["value"].'%")
			';
		}
            $query .= 'GROUP BY usertable.staffid';
		if(isset($_POST["order"]))
		{
			$query .= '
			ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].'
			';
		}
		else
		{
			$query .= '
			ORDER BY usertable.staffid ASC 
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
			$sub_array[] = ucwords($row["fname"].' '.$row["lname"]);
			$sub_array[] = $row["staffid"];
			$sub_array[] = number_format($row["allotment_amount"]);
			$data[] = $sub_array;
		}

function recordsTotal()
	{
	global $connect;
 $query = "SELECT * FROM usertable 
    	GROUP BY usertable.staffid
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
	
	
	//the new code
  if($_POST["action"] == "single_fetch")
	{
		$query = "
    	     SELECT SUM(allotment_amount) as total_allotment, COUNT(id) as total_user FROM usertable
    	     WHERE NOT staffid = '210035'
        ";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
        	$result = $statement->fetchAll();
			foreach($result as $row)
			{
				
				$output = '
				<p><b>You are about to make all user contributions.</b></p>
				<p><b>Total Contribution:</b> N'.number_format($row["total_allotment"]).'</p>
				<p><b>Total contributors:</b> '.$row["total_user"].'</p>
				';
			}
			echo $output;
			exit();
		}
	}





/************
 *  PAYMENT PROCESSING MODULE
 * 
 * ************/
if($_POST["action"] == "contribution_payout")
	{

	$query = "SELECT allotment_amount, staffid FROM usertable
    	     GROUP BY staffid";
		$statement = $connect->prepare($query);
		$statement->execute();
		$rowCount = $statement->rowCount();
		if($rowCount > 0){
		    $result = $statement->fetchAll();
		    foreach($result as $row)
			{
			//Loan Repayment Module
		    $loanObj = json_decode(repayUserLoan($row['staffid']));
		    $borrower_staffid = $loanObj->staffid;
		    $balance = $loanObj->balance;
		    $amount = $loanObj->amount;
            $monthlydue = $loanObj->monthlydue;
            $biweekly = $loanObj->biweeklydue;
            $interest = $loanObj->interest;
            $last_loan_id = $loanObj->last_loan_id;
            //Debit from contribution
		    $userCredit = ceil($row['allotment_amount'] - $biweekly);
		    //Reduce Loan Balance
		    $oldLoanBalance = getLoanBalance($row['staffid']);
		    $newBalance = $oldLoanBalance - $biweekly;
		   //Update Loan Balance
		   updateUserLoan($borrower_staffid, $newBalance, $last_loan_id);

		    //Add new Contribution
		    $data = array(
				':staffid' => $row['staffid'],
				':amount' => $userCredit,
				':date'	=>	date("Y-m-d")
			);
			$query = "
			INSERT INTO contributions 
			(staffid, amount, date) 
			VALUES (:staffid, :amount, :date)
			";
			$statement = $connect->prepare($query);
			$statement->execute($data); 
			}
			$output = array(
			'success' 	=>	true,
			'notice'   =>  'Contributions Payment is Successful.'
		);
		} else {
		    $output = array(
			'failed' 	=>	true,
			'notice'   =>  'Contributions Payment Failed.'
		);
		}

		echo json_encode($output);
		exit();
	}    
	    
	    
// function getStaffIdByEmployeeID($employee_number){
//     global $connect;	    
// 	    $data = array(':employee_number'=> $employee_number);
// 	    $query = "
//           SELECT staffid FROM usertable
//           WHERE employee_number = :employee_number
//           LIMIT 1";
//           $statement = $connect->prepare($query);
//           $statement->execute($data);
//           $result = $statement->rowCount();
//           $output = "0";
//           if($result > 0){
//              $result = $statement->fetchAll();
//                 foreach($result as $row)
//                  {
//                     $output = $row['staffid'];
//                  }
//           } 
//           return $output;
// }

function repayUserLoan($staffid){
    global $connect;
    $data = array(':staffid'=> $staffid);
	    $query = "
          SELECT loan_balance.balance, loan_balance.last_loan_id, loan_balance.staffid, loan_request.amount, loan_request.monthlydue, loan_request.biweeklydue, loan_request.interest 
          FROM loan_balance
          INNER JOIN loan_request
          ON loan_balance.last_loan_id = loan_request.id
          WHERE loan_balance.staffid = :staffid
          LIMIT 1";
          $statement = $connect->prepare($query);
          $statement->execute($data);
          $result = $statement->rowCount();
          if($result > 0){
             $result = $statement->fetchAll();
                foreach($result as $row)
                 {
                    if($row['balance'] > 0){
                             $output = array(
                                    'staffid' => $row['staffid'],
                                    'amount' => $row['amount'],
                                    'last_loan_id' => $row['last_loan_id'],
                                    'balance' => $row['balance'],
                        			'monthlydue'=> $row['monthlydue'],
                        			'biweeklydue'=> $row['biweeklydue'],
                        			'interest' =>   $row['interest']
                        		);
                    } else {
                        $output = array(
                                    'staffid' => 0,
                                    'amount' => 0,
                                    'last_loan_id' => 0,
                                    'balance' => 0,
                        			'monthlydue'=> 0,
                        			'biweeklydue'=> 0,
                        			'interest' =>   0
                        		);
                    }
                 }
                 
          } else {
                        $output = array(
                                    'staffid' => 0,
                                    'amount' => 0,
                                    'last_loan_id' => 0,
                                    'balance' => 0,
                        			'monthlydue'=> 0,
                        			'biweeklydue'=> 0,
                        			'interest' =>   0
                        		);
          }
             return json_encode($output);        
}


function updateUserLoan($sid, $amount, $last_loan_id){
    global $connect;
    $data = array(':staffid'=> $sid, ':amount'=> $amount, ':loan_id'=> $last_loan_id);
	$query = "UPDATE loan_balance SET balance =:amount, last_loan_id =:loan_id WHERE staffid = :staffid";
    $statement = $connect->prepare($query);
    $statement->execute($data);
}

	