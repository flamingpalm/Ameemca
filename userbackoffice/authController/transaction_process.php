<?php
    require_once "../pdo.php";
    
if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM usertable 
		INNER JOIN transaction 
		ON usertable.staffid = transaction.staffid 
		WHERE usertable.staffid = :staffid
	    AND ( 
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			 transaction.amount LIKE "%'.$_POST["search"]["value"].'%" 
			OR transaction.status LIKE "%'.$_POST["search"]["value"].'%" 
			OR transaction.currency LIKE "%'.$_POST["search"]["value"].'%" 
			OR transaction.refcode LIKE "%'.$_POST["search"]["value"].'%" 
			OR transaction.type LIKE "%'.$_POST["search"]["value"].'%" 
			OR transaction.date LIKE "%'.$_POST["search"]["value"].'%")
			';
		}
$query .= 'GROUP BY transaction.id';
		if(isset($_POST["order"]))
		{
			$query .= '
			ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].'
			';
		}
		else
		{
			$query .= '
			ORDER BY transaction.id DESC 
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
		   if($row["status"] == "success"){
		    $status = '<span class="badge badge-pill badge-success">Verified</span>';
		} 
		    
			$sub_array = array();
			$sub_array[] = $sn++;
			$sub_array[] = ucfirst($row["fname"]).' '.ucfirst($row["lname"]);
			$sub_array[] = ucfirst($row["type"]);
			$sub_array[] = number_format($row["amount"]);
			$sub_array[] = $row["currency"];
			$sub_array[] = $row["refcode"];
			$sub_array[] = $status ;
			$sub_array[] = $row["date"];
			$data[] = $sub_array;
		}

function recordsTotal()
	{
	global $connect, $staffid;
	$dataArr = array(':staffid'=> $staffid);
 $query = "	SELECT * FROM usertable 
		INNER JOIN transaction 
		ON usertable.staffid = transaction.staffid 
			WHERE usertable.staffid = :staffid
    	GROUP BY transaction.id
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
	
	
	
	