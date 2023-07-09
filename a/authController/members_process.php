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
		    $sub_array[] = '<button type="button" data-sid="'.$row["staffid"].'" class="btn btn-pill btn-dark btn-sm view-member">View</button>';
		     $sub_array[] = '<button type="button" data-sid="'.$row["staffid"].'" class="btn btn-pill btn-warning btn-sm allotment-edit">Edit</button>';
            $sub_array[] = '<button type="button" data-sid="'.$row["staffid"].'" class="btn btn-pill btn-primary btn-sm update-member">Update</button>';
            $sub_array[] = '<button type="button" data-sid="'.$row["staffid"].'" class="btn btn-pill btn-danger btn-sm delete-member">Delete</button>';
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
	
	
	//update bio
if($_POST["action"] == "update_member"){

$error = 0;
$first_name = "";
$last_name = "";
$user_image = "";
$user_email = "";
$user_phone = "";
$user_gender = "";

$error_first_name = "";
$error_last_name = "";
$error_user_image = "";
$error_user_email = "";
$error_user_phone = "";
$error_user_gender = "";

$sid = $_POST["sid"];

if(empty($_POST["first_name"]))
{
	$error_first_name = 'First name is required';
	$error++;
} else {
	$first_name = $_POST["first_name"];
}

if(empty($_POST["last_name"]))
{
	$error_last_name = 'Last name is required';
	$error++;
} else {
	$last_name = $_POST["last_name"];
}

if(empty($_POST["email_address"]))
{
	$error_user_email = 'Email is required';
	$error++;
} else {
	$user_email = $_POST["email_address"];
}


if(empty($_POST["user_phone"]))
{
	$error_user_phone = 'Phone is required';
	$error++;
} else {
	$user_phone = $_POST["user_phone"];
}

if(empty($_POST["user_gender"]))
{
	$error_user_gender = 'Gender is required';
	$error++;
} else {
	$user_gender = $_POST["user_gender"];
}




        if($error > 0){
                $output = array(
                        'error'=> true,
                        'notice' =>	"Pay attention to the form below.",
                        'error_first_name'=> $error_first_name,
                        'error_last_name'=> $error_last_name,
                        'error_user_email'=> $error_user_email,
                        'error_user_phone'=> $error_user_phone,
                        'error_user_gender'=> $error_user_gender
                    );
        } else {
            
            $data = array(
                ':sid'=> $sid,
                ':fname'=> $first_name,
                ':lname'=> $last_name,
                ':email'=> $user_email,
                ':phone'=> $user_phone,
                ':gender'=> $user_gender
            );

            $query = "UPDATE usertable SET fname= :fname, lname = :lname, email = :email, phone = :phone, gender= :gender WHERE staffid =:sid";
            $statement = $connect->prepare($query);
            if($statement->execute($data)){
                     $output = array(
                    	'saved' => true,
                    	'notice' =>	"Profile Updated Successfully!",
                	);
            }else{
                   $output = array(
                    	'error' => true,
                    	'notice' =>	"Failed to Update Profile!",
                	);
            }
   
    }//error check
    
echo json_encode($output);
exit();
}

	
	
	
	
	
	
if($_POST["action"] == "edit_fetch")
	{
		$query = "
    		SELECT * FROM usertable 
    		WHERE staffid = '".$_POST["staffid"]."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{   $output= null;
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
				$output["staffid"] = $row["staffid"];
				$output["first_name"] = $row["fname"];
				$output["last_name"] = $row["lname"];
				$output["user_phone"] = $row["phone"];
				$output["user_gender"] = $row["gender"];
				$output["email_address"] = $row["email"];
				$output["allotment_desc"] = $row["allotment_desc"];
				$output["allotment_amount"] = $row["allotment_amount"];
			}
			echo json_encode($output);
			exit();
		}
	}	 
	





	//update bio
if($_POST["action"] == "allotment_update"){

$error = 0;
$allotment_amount = "";
$allotment_desc = "";

$error_allotment_amount = "";
$error_allotment_desc = "";

$sid = $_POST["sid"];

if($_POST["allotment_amount"] == "" || !is_numeric($_POST["allotment_amount"]))
{
	$error_allotment_amount = 'Allotment amount is required.';
	$error++;
} else {
	$allotment_amount = $_POST["allotment_amount"];
}

if(empty($_POST["allotment_desc"]))
{
	$error_allotment_desc = 'Allotment description is required.';
	$error++;
} else {
	$allotment_desc = $_POST["allotment_desc"];
}



        if($error > 0){
                $output = array(
                        'error'=> true,
                        'notice' =>	"Pay attention to the form below.",
                        'error_allotment_desc'=> $error_allotment_desc,
                        'error_allotment_amount'=> $error_allotment_amount
                    );
        } else {
            
            $data = array(
                ':sid'=> $sid,
                'allotment_desc'=> $allotment_desc,
                'allotment_amount'=> $allotment_amount
            );

            $query = "UPDATE usertable SET allotment_amount= :allotment_amount, allotment_desc = :allotment_desc WHERE staffid =:sid";
            $statement = $connect->prepare($query);
            if($statement->execute($data)){
                     $output = array(
                    	'saved' => true,
                    	'notice' =>	"Allotment Updated Successfully!",
                	);
            }else{
                   $output = array(
                    	'error' => true,
                    	'notice' =>	"Allotment to Update Profile!",
                	);
            }
   
    }//error check
    
echo json_encode($output);
exit();
}

	
	
//the new code
  if($_POST["action"] == "allotment_fetch"){
		$query = "
    		SELECT * FROM usertable 		
    		WHERE staffid = '".$_POST["staffid"]."'
        ";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
        	$result = $statement->fetchAll();
			$output = '<form method="post" id="update_allotment_form" enctype="multipart/form-data">
                  <div class="modal-header">
                  <h4 class="modal-title">Allotment</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body" id="view_user_details">
                  <div class="row">
                ';
			foreach($result as $row)
			{
				$output .= '
				<div class="col-md-3">
				<a href="../userbackoffice/'.$row["allotment_file"].'" class="badge badge-primary" download>Download</a>
				</div>
				<div class="col-md-9">
				<div class="alert alert-info" role="alert">'.$row["fname"].' '.$row["lname"].'\'s Allotment</div>
				<label>Allotment Amount:</label>
                    <input type="number" name="allotment_amount" id="allotment_amount" class="form-control" value="'.$row["allotment_amount"].'"/>
                    <div id="error_allotment_amount" style="color: red"> </div>
                    <br />
                    <label>Pay period:</label>
                    <input type="text" name="allotment_desc" id="allotment_desc" class="form-control" value="'.$row["allotment_desc"].'"/>
                    <div id="error_allotment_desc" style="color: red"> </div>
				</div>
				';
			}
			$output .= '</div>
        		<div class="modal-footer">
        		<input type="hidden" name="action" value="allotment_update" />
                <input type="hidden" name="sid" id="al_sid"/>
        		<button type="submit" class="btn btn-pill btn-primary btn-sm" id="save_allotment_btn">Save</button>
                <button type="button" class="btn btn-default btn-pill btn-sm" data-dismiss="modal">Close</button>
              </div>
              </div></form>
			';
			echo $output;
			exit();
		}
	}
	
	
	
	
	
	
	
	
	
	
//the new code
  if($_POST["action"] == "single_fetch")
	{
		$query = "
    		SELECT * FROM usertable 		
    		WHERE staffid = '".$_POST["staffid"]."'
        ";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
        	$result = $statement->fetchAll();
			$output = '
			<div class="modal-header">
                  <h4 class="modal-title">User Details</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body" id="view_user_details">
                  <div class="row">
			';
			foreach($result as $row)
			{
				
				$output .= '
				<div class="col-md-4">
				<img src="../userbackoffice/'.$row["photo"].'" class="img-thumbnail">
				</div>
				<div class="col-md-8">
					<table class="table">
					<div class="alert alert-info" role="alert">
                    Account Summary
                    </div>
						<tr>
							<th>Name:</th>
							<td>'.$row["fname"].'</td>
						</tr>
												<tr>
				<th>Member ID:</th>
				<td>'.$row["staffid"].'</td>
						</tr>
						<tr>
				<th>Employee ID:</th>
				<td>'.$row["employee_number"].'</td>
						</tr>
						<tr>
				<th>Email Address:</th>
				<td>'.$row["email"].'</td>
						</tr>
						<tr>
							<th>Mobile No.:</th>
				<td>'.$row["phone"].'</td>
						</tr>
					</table>
				</div>
				
			
				';
			}
			$output .= '</div><div class="modal-footer">
                <button type="button" class="btn btn-default btn-pill btn-sm" data-dismiss="modal">Close</button>
              </div>
              </div>
			';
			echo $output;
			exit();
		}
	}
	
	
	if($_POST["action"] == "delete")
	{
	    //Delete Users
		$query = "
		DELETE FROM usertable
        WHERE staffid = '".$_POST["staffid"]."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
		 //Delete Balance
		$query = "
		DELETE FROM account_balance
        WHERE staffid = '".$_POST["staffid"]."'
		";
		$statement = $connect->prepare($query)->execute();
		//Delete Loans    
		$query = "
		DELETE FROM loan_balance
        WHERE staffid = '".$_POST["staffid"]."'
		";
		$statement = $connect->prepare($query)->execute();
		//Delete Contribution    
		$query = "
		DELETE FROM contribution_balance
        WHERE staffid = '".$_POST["staffid"]."'
		";
		$statement = $connect->prepare($query)->execute();    
		//Delete Transaction    
		$query = "
		DELETE FROM transaction
        WHERE staffid = '".$_POST["staffid"]."'
		";
		$statement = $connect->prepare($query)->execute();    
		//Delete User Banks    
		$query = "
		DELETE FROM userbank
        WHERE staffid = '".$_POST["staffid"]."'
		";
		$statement = $connect->prepare($query)->execute();   
 
			$output = array(
    			'success' => true,
    			'notice' => 'Data Deleted Successfully'
		        );

        		echo json_encode($output);
        		exit();
		}
	}