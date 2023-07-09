<?php
  require_once("../../userbackoffice/DB.php");
    
if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM usertable 
		INNER JOIN contributions
		ON usertable.staffid = contributions.staffid
		WHERE usertable.staffid = contributions.staffid 
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
			$sub_array[] = number_format($row["amount"]);
			$sub_array[] = $row["date"];
			$data[] = $sub_array;
		}

function recordsTotal()
	{
	global $connect;
 $query = "SELECT * FROM usertable 
		INNER JOIN contributions 
		ON usertable.staffid = contributions.staffid
		WHERE usertable.staffid = contributions.staffid 
    	GROUP BY contributions.id
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
	