 <?php
require_once("../PH.php");

if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM usertable 
	    
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			 WHERE usertable.fname LIKE "%'.$_POST["search"]["value"].'%" 
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
			$sub_array = array();
			$sub_array[] = $sn++;
			$sub_array[] = ucfirst($row["fname"]).' '.ucfirst($row["lname"]);
			$sub_array[] = $row["staffid"];
            $sub_array[] = getUserPackageNameByID($row["package"]);
            $sub_array[] = '<button type="button" data-sid="'.$row["staffid"].'" class="btn btn-pill btn-warning btn-sm account-upgrade">Upgrade</button>';
            $data[] = $sub_array;
		}

function recordsTotal()
	{
	global $connect;
 $query = "	SELECT * FROM usertable 
    	GROUP BY usertable.id
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
	

//for reg
function getUserPackageNameByID($id){
    global $connect;
	 $data = array(':id'=> $id);
     $query = "SELECT package_name FROM package WHERE id = :id";
     $statement = $connect->prepare($query);
     $statement->execute($data);
     $result = $statement->fetchAll();
      $output = '';
      foreach($result as $row)
		   {
		      $output .= $row["package_name"];
	        }
	   return $output;
 }












	
	//update bio
if($_POST["action"] == "update_member"){

$error = 0;
$change_pkg = "";
$error_change_pkg = "";
$sid = $_POST["sid"];

if(empty($_POST["change_pkg"]))
{
	$error_change_pkg = 'Package is required';
	$error++;
} else {
	$change_pkg = $_POST["change_pkg"];
}

        if($error > 0){
                	$output = array(
                        'error'=> true,
                        'notice' =>	"Pay attention to the form below.",
                        'error_change_pkg'=> $error_change_pkg
                    );
        } else {
            
            if(!empty($_POST["email_address"]))
                {
                $data = array(
                        ':sid'=> $sid,
                        ':package'=> $change_pkg,
                        ':email'=> sanitizeEmail($_POST["email_address"])
                    );
                $query = "UPDATE usertable SET package= :package, email = :email WHERE staffid =:sid";
            
                } else {
                	$data = array(
                        ':sid'=> $sid,
                        ':package'=> $change_pkg
                    );
                $query = "UPDATE usertable SET package= :package WHERE staffid =:sid";
            
                }
            $statement = $connect->prepare($query);
            if($statement->execute($data)){
                     $output = array(
                    	'saved' => true,
                    	'notice' =>	"Package Upgrade Successful!",
                	);
            }else{
                   $output = array(
                    	'error' => true,
                    	'notice' =>	"Failed to Package Upgrade!",
                	);
            }
   
    }//error check
    
echo json_encode($output);
exit();
}

	
	
	
	
	
