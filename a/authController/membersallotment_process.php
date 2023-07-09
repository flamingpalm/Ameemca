<?php
require_once("../PH.php");

if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT allotment_file, staffid, fname, lname FROM usertable 
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			 WHERE usertable.fname LIKE "%'.$_POST["search"]["value"].'%" 
			 OR usertable.lname LIKE "%'.$_POST["search"]["value"].'%"
			  OR usertable.staffid LIKE "%'.$_POST["search"]["value"].'%"
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
		    
if(empty($row["allotment_file"])){
    $badge = "<center><span class='badge badge-pill badge-danger'>None</span></center>";
} else {
    $badge = "<center><a class='badge badge-pill badge-primary' href='../userbackoffice/".$row["allotment_file"]."' download>Download</a></center>";
}	    $pronoun = "'s";
			$sub_array = array();
			$sub_array[] = $sn++;
			$sub_array[] = ucfirst($row["fname"]).' '.ucfirst($row["lname"]);
			$sub_array[] = $row["staffid"];
			$sub_array[] = $badge;
			$sub_array[] = "<center><button type='button' id='add_button' data-sid='".$row["staffid"]."' data-name='".$row["fname"]."' class='btn btn-pill btn-primary btn-sm'>Upload</button></center>";
			$data[] = $sub_array;
		}

function recordsTotal()
	{ 
	global $connect;
 $query = "SELECT allotment_file FROM usertable 
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
	
	


//import.php   
if($_POST["action"] == "upload")
	{
if($_FILES["allotment_file"]["name"] != '')
{
	$allowed_extension = array('pdf', 'jpg','png','jpeg');
	$extension_array = explode(".", $_FILES["allotment_file"]["name"]);
    $extension = strtolower($extension_array[1]);

	if(in_array($extension, $allowed_extension))
	{
	    if(!file_exists('../../userbackoffice/assets/user_allotments')){
	        mkdir('../../userbackoffice/assets/user_allotments', 0777, true);
	    }
	    $rand = rand(1111, 9999).'_'. $_POST["sid"].'_'.time();
		$file_path = '../../userbackoffice/assets/user_allotments/'.$rand.'.'.$extension;
		$file_name = 'assets/user_allotments/'. $rand.'.'.$extension;
		if(move_uploaded_file($_FILES['allotment_file']['tmp_name'], $file_path)){
		    
		    $data = array(
                ':staffid'=> $_POST["sid"],
                ':allotment_file'=> $file_name
            );

            $query = "UPDATE usertable SET  allotment_file = :allotment_file  WHERE staffid =:staffid";
             $statement = $connect->prepare($query);
            if($statement->execute($data)){
                      $output = array(
                			'success' 	=>	true,
                			'notice'   =>  'Allotment Uploaded'
                			
                	);
            }else{
                   $output = array(
                    	'error' => true,
                    	'notice' =>	"An error occured",
                	);
            }
 
		} else {
		//invalid file
	         $output = array(
			'error' 	=>	true,
			'notice'   =>  'Upload failed'
		);
	    }
	}
	else {
		//invalid file
	 $output = array(
			'error' 	=>	true,
			'notice'   =>  'Only .pdf .png or .jpg file allowed1'
		);
	}
}
else
{
    //no file
	 $output = array(
			'error' 	=>	true,
			'notice'   =>  'Please Select File'
		);
}
		echo json_encode($output);
		exit();
	}    
	    
	    
