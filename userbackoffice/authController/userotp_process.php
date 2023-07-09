<?php
include_once "../DB.php";


//verify otp
//$_POST['action'] = 'verifyotp';
//$_POST["otp"] = 785707;
if($_POST["action"] == "verifyotp")
	{
$data = array("code"=> sanitizeNumber($_POST["otp"]));
$query = "SELECT * FROM usertable WHERE code = :code";
$statement = $connect->prepare($query);
$statement->execute($data);
$result = $statement->rowCount();
if($result > 0){
    //otp is valid
            $result = $statement->fetchAll();
            foreach($result as $row)
		       {
		            $sid = $row["staffid"];
	                $fname = $row["fname"];
	                $lname = $row["lname"];
	                $email = $row["email"];
	                $address = $row["address"];
	                $phone = $row["phone"];
	                $gender = $row["gender"];
    	            $state = $row["state"];
	                $country = $row["country"];
	                $nokfname = $row["nokfname"];
	                $noklname = $row["noklname"];
	                $nokemail = $row["nokemail"];
	                $nokaddress = $row["nokaddress"];
	                $nokphone = $row["nokphone"];
	                $nokgender = $row["nokgender"];
	                $nokstate = $row["nokstate"];
	                $nokcountry = $row["nokcountry"];
	                
    	       }
    //update otp code
    $data = array("code"=> 0, "status"=> 'verified', "otp"=> $_POST["otp"]);
    $query = "UPDATE usertable SET code = :code, status = :status WHERE code = :otp";
    $statement = $connect->prepare($query);
    if($statement->execute($data)){
        
        //for now
        $_SESSION['staffid'] = $sid;
        
            //force user to update bio
                if($fname == '' || $lname == '' || $email == ''|| $address == '' || $phone == '' || $gender == ''|| $state == '' || $country == '' || 
                    $nokfname == '' || $noklname == '' || $nokemail == ''|| $nokaddress == '' || $nokphone == '' || $nokgender == ''|| $nokstate == '' || $nokcountry == '') {
                                $output = array(
                    				'approved' => true,
                    				'notice' =>	"Update your bio",
                    				'protocol' => 'bio-setup'
                					);
                    }else{
                                $output = array(
                    				'approved' => true,
                    				'notice' =>	"Welcome",
                    				'protocol' => 'index'
                					);
                    } 

    } else {
        // failed to update otp
                        $output = array(
                    				'error' => true,
                    				'notice' =>	"Failed to update otp",
                    				'protocol' => ''
                					);
    }
    
} else {
    //invalid otp
                            $output = array(
                    				'error' => true,
                    				'notice' =>	"Invalid otp",
                    				'protocol' => ''
                					);
    
}
echo json_encode($output);
exit();
}





