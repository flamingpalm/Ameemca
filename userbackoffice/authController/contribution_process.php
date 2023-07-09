<?php
    require "../pdo.php";
    
if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM usertable 
		INNER JOIN contributions 
		ON usertable.staffid = contributions.staffid 
		WHERE usertable.staffid = :staffid
	    AND ( 
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			 contributions.amount LIKE "%'.$_POST["search"]["value"].'%" 
			OR contributions.date LIKE "%'.$_POST["search"]["value"].'%")
			';
		}
$query .= 'GROUP BY contributions.id';
		if(isset($_POST["order"]))
		{
			$query .= '
			ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].'
			';
		}
		else
		{
			$query .= '
			ORDER BY contributions.id DESC 
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
			$sub_array[] = number_format($row["amount"]);
			$sub_array[] = $row["date"];
			$data[] = $sub_array;
		}

function recordsTotal()
	{
	global $connect, $staffid;
	$dataArr = array(':staffid'=> $staffid);
 $query = "	SELECT * FROM usertable 
		INNER JOIN contributions 
		ON usertable.staffid = contributions.staffid 
			WHERE usertable.staffid = :staffid
    	GROUP BY contributions.id
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
	
	
	
	