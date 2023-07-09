<?php
include_once '../pdo.php';

if($_POST["action"] == "insert")
	{
	    //check
	            $data = array(
                    ':bank_id' => sanitizeNumber($_POST["bank"]),
                    ':staffid'  => $staffid
                   );
	           $query = "SELECT * FROM userbank
	                     WHERE bank_id = :bank_id
	                     AND staffid = :staffid";
            	    $statement = $connect->prepare($query);
            	    $statement->execute($data);
                    $result = $statement->rowCount();
                  if($result > 0){
                              $output = '<div class="alert d-flex align-items-center align-content-center alert-danger fade show" role="alert">
                              <span><strong class="d-block">Oops!</strong>An account record with this bank already exists.</span></div>';
                  }else{
         //insert
                        $data = array(
                            ':account_no' => sanitizeNumber($_POST["account"]),
                            ':bank_id' => sanitizeNumber($_POST["bank"]),
                            ':staffid'  => $staffid
                           );
        	           $query = "INSERT INTO userbank (staffid, bank_id, account_no) 
                            VALUES (:staffid, :bank_id, :account_no)";
                    	    $statement = $connect->prepare($query);
                          $result = $statement->execute($data);
                                  if($result){
                                      $output = '<div class="alert d-flex align-items-center align-content-center alert-success fade show" role="alert">
                                      <span><strong class="d-block">Success!</strong> Account added successfully.</span></div>';
                                  }else{
                                      $output = '<div class="alert d-flex align-items-center align-content-center alert-danger fade show" role="alert">
                                      <span><strong class="d-block">Failed!</strong> An error occured.</span></div>';
                                  }
                      
                      
                  }

	    echo json_encode($output);
		exit();
	}



if($_POST["action"] == "fetch")
	{
	    	$query = "
		SELECT * FROM usertable
		INNER JOIN userbank 
		ON usertable.staffid = userbank.staffid
		INNER JOIN banks 
		ON userbank.bank_id = banks.id 
		WHERE usertable.staffid = :staffid
	    AND ( 
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			 banks.bankname LIKE "%'.$_POST["search"]["value"].'%" 
			OR userbank.account_no LIKE "%'.$_POST["search"]["value"].'%")
			';
		}
            $query .= 'GROUP BY banks.id';
		if(isset($_POST["order"]))
		{
			$query .= '
			ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].'
			';
		}
		else
		{
			$query .= '
			ORDER BY banks.id DESC 
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
		   
		    
			$sub_array = array(); 
			$sub_array[] = $sn++;
			$sub_array[] = $row["account_no"];
			$sub_array[] = $row["bankname"];
            $sub_array[] = '<button type="button" name="delete" data-bank="'.$row["id"].'" class="btn btn-pill btn-danger btn-sm delete-bank" onclick="deleteBank()">Delete</button>';
 
			$data[] = $sub_array;
		}

function recordsTotal()
	{
	global $connect, $staffid;
	$dataArr = array(':staffid'=> $staffid);
 $query = "	SELECT * FROM usertable
		INNER JOIN userbank 
		ON usertable.staffid = userbank.staffid
		INNER JOIN banks 
		ON userbank.bank_id = banks.id 
		WHERE usertable.staffid = :staffid
    	GROUP BY banks.id
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
	
	
	
if($_POST["action"] == "delete")
	{
	    $data = array(
                    ':bank_id' => sanitizeNumber($_POST["bank_id"]),
                    ':staffid'  => $staffid
                   );
                   $query = "DELETE FROM userbank WHERE staffid = :staffid AND bank_id = :bank_id";
	     $statement = $connect->prepare($query);
         $result = $statement->execute($data);
         if($result)
         {
                     $output = '<div class="alert d-flex align-items-center align-content-center alert-success fade show" role="alert">
              <span><strong class="d-block">Success!</strong>Bank removal successful.</span></div>';
                 }else{
                  $output = '<div class="alert d-flex align-items-center align-content-center alert-danger fade show" role="alert">
                 <span><strong class="d-block">Failed!</strong> An error occured.</span></div>';
                }
	    
	    
	    echo json_encode($output);
		exit();
	}
	
	