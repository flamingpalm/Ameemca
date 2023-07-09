<?php
require_once("../PH.php");

if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT allotment_file, file_uploader, id, date FROM allotment_records 
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			 WHERE allotment_records.date LIKE "%'.$_POST["search"]["value"].'%" 
			';
		}
        $query .= 'GROUP BY allotment_records.id';
		if(isset($_POST["order"]))
		{
			$query .= '
			ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].'
			';
		}
		else
		{
			$query .= '
			ORDER BY allotment_records.id ASC 
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
    $badge = "<center><a class='badge badge-pill badge-primary' href='".$row["allotment_file"]."' download>Download</a></center>";
}	    $pronoun = "'s";
			$sub_array = array();
			$sub_array[] = $sn++;
			$sub_array[] = getAdminFullName($row["file_uploader"]);
			$sub_array[] = $row["date"];
			$sub_array[] = $badge;
			$sub_array[] = "<center><button type='button' id='add_button' data-aid='".$row["id"]."' data-source='".$row["allotment_file"]."' data-name='".getAdminFullName($row["file_uploader"])."' class='btn btn-pill btn-warning btn-sm'>Update</button></center>";
			$data[] = $sub_array;
		}

function recordsTotal()
	{ 
	global $connect;
 $query = "SELECT id FROM allotment_records 
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
	
	


//Upload New
//import.php   
if($_POST["action"] == "upload_new")
	{
if($_FILES["allotment_file"]["name"] != '')
{
	$allowed_extension = array('pdf', 'jpg','png','jpeg');
	$extension_array = explode(".", $_FILES["allotment_file"]["name"]);
    $extension = strtolower($extension_array[1]);

	if(in_array($extension, $allowed_extension))
	{
	    if(!file_exists('../assets/allotments_records')){
	        mkdir('../assets/allotments_records', 0777, true);
	    }
	    $rand = rand(1111, 9999).'_'. $admin_id.'_'.time();
		$file_path = '../assets/allotments_records/'.$rand.'.'.$extension;
		$file_name = 'assets/allotments_records/'. $rand.'.'.$extension;
		if(move_uploaded_file($_FILES['allotment_file']['tmp_name'], $file_path)){

            $dateTime = new DateTime('now', new DateTimeZone('Africa/Lagos')); 

		    $data = array(
                ':file_uploader'=> $admin_id,
                ':allotment_file'=> $file_name,
                ':date'=> $dateTime->format('Y-m-d H:i A')
            );

            $query = "INSERT INTO allotment_records (allotment_file, file_uploader, date)
                     VALUES (:allotment_file, :file_uploader, :date)";
             $statement = $connect->prepare($query);
            if($statement->execute($data)){
                      $output = array(
                			'success' 	=>	true,
                			'notice'   =>  'New Allotment Uploaded'
                			
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
			'notice'   =>  'Only .pdf .png or .jpg file allowed'
		);
	}
}
else {
    //no file
	 $output = array(
			'error' 	=>	true,
			'notice'   =>  'Please Select File'
		);
}
		echo json_encode($output);
		exit();
	}



function getAdminFullName($id){
    global $connect;
	 $data = array(':id'=> $id);
     $query = "SELECT firstname, lastname FROM admin WHERE id = :id";
     $statement = $connect->prepare($query);
     $statement->execute($data);
     $result = $statement->fetchAll();
     $output = 'Error';
      foreach($result as $row)
		   {
		      $output = ucwords($row["firstname"].' '.$row["lastname"]);
	        }
	   return $output;
 }















//Modify 
if($_POST["action"] == "modify_old")
	{
if($_FILES["allotment_file"]["name"] != '')
{
	$allowed_extension = array('pdf', 'jpg','png','jpeg');
	$extension_array = explode(".", $_FILES["allotment_file"]["name"]);
    $extension = strtolower($extension_array[1]);

	if(in_array($extension, $allowed_extension))
	{
	    if(!file_exists('../assets/allotments_records')){
	        mkdir('../assets/allotments_records', 0777, true);
	    }
	    $rand = rand(1111, 9999).'_'. $admin_id.'_'.time();
		$file_path = '../assets/allotments_records/'.$rand.'.'.$extension;
		$file_name = 'assets/allotments_records/'. $rand.'.'.$extension;
		if(move_uploaded_file($_FILES['allotment_file']['tmp_name'], $file_path)){
            
            $dateTime = new DateTime('now', new DateTimeZone('Africa/Lagos')); 

		    $data = array(
		        ':id'=> $_POST["aid"],
                ':file_uploader'=> $admin_id,
                ':allotment_file'=> $file_name,
                ':date'=> $dateTime->format('Y-m-d H:i A')
            );

            $query = "UPDATE allotment_records SET  allotment_file = :allotment_file, file_uploader= :file_uploader, date = :date  WHERE id =:id";
             $statement = $connect->prepare($query);
            if($statement->execute($data)){
                @unlink($_POST["oldfile"]);
                      $output = array(
                			'success' 	=>	true,
                			'notice'   =>  'Allotment updated.'
                			
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
			'notice'   =>  'Only .pdf .png or .jpg file allowed'
		);
	}
}
else {
    //no file
	 $output = array(
			'error' 	=>	true,
			'notice'   =>  'Please Select File'
		);
}
		echo json_encode($output);
		exit();
	}
	    
