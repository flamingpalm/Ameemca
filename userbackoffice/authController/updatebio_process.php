<?php
require_once "../pdo.php";

//update bio
if($_POST["action"] == "updatebio"){

$error = 0;
$first_name = "";
$last_name = "";
$user_image = "";
$user_email = "";
$user_address = "";
$user_phone = "";
$user_sec_phone = "";
$user_gender = "";
$user_state = "";
$user_country = "";

$error_first_name = "";
$error_last_name = "";
$error_user_image = "";
$error_user_email = "";
$error_user_address = "";
$error_user_phone = "";
$error_user_sec_phone = "";
$error_user_gender = "";
$error_user_state = "";
$error_user_country = "";
$canUpload = false;


$employee_number = "";
$error_employee_number = "";
$agency_bureau = "";
$error_agency_bureau = "";
$employee_post = "";
$error_employee_post = "";


$user_image = $_POST["hidden_user_image"];
if($_FILES["user_image"]["name"] != '')
{
$file_name = $_FILES["user_image"]["name"];
$tmp_name = $_FILES["user_image"]["tmp_name"];
$extension_array = explode(".", $file_name);
$extension = strtolower($extension_array[1]);
$allowed_extension = array('jpg','png','jpeg');
$fileSize = $_FILES["user_image"]['size'];
        if(!in_array($extension, $allowed_extension))
        {
           $error_user_image = 'Invalid Image Format';
           $error++;
        } 
        else if ($fileSize > 200000000000) {
                    $error_user_image = "Image size is more than 2mb, kindly reduce it.";
                    $error++;
        } else {
        	if (!file_exists('../assets/user_image')) {
            	mkdir('../assets/user_image', 0777, true);
        	 }
            $imgPath = 'assets/user_image/' . uniqid().md5(time()) . '.' . $extension;
            $uploadPath = '../'.$imgPath;
            $user_image = $imgPath;
            $canUpload = true;
        	}
} else {
        if($user_image == '') {
           $error_user_image = 'Upload a passport';
           $error++;
        }
}


if(empty($_POST["fname"]))
{
	$error_first_name = 'First name is required';
	$error++;
} else {
	$first_name = sanitizeText($_POST["fname"]);
}

if(empty($_POST["lname"]))
{
	$error_last_name = 'Last name is required';
	$error++;
} else {
	$last_name = sanitizeText($_POST["lname"]);
}

if(empty($_POST["email"]))
{
	$error_user_email = 'Email is required';
	$error++;
} else {
	$user_email = sanitizeEmail($_POST["email"]);
}

if(empty($_POST["address"]))
{
	$error_user_address = 'Last name is required';
	$error++;
} else {
	$user_address = sanitizeText($_POST["address"]);
}


if(empty($_POST["sec_phone"]))
{
	$error_user_sec_phone = 'Phone is required';
	$error++;
} else {
	$user_sec_phone = sanitizeNumber($_POST["sec_phone"]);
}



if(empty($_POST["phone"]))
{
	$error_user_phone = 'Phone is required';
	$error++;
} else {
	$user_phone = sanitizeNumber($_POST["phone"]);
}

if(empty($_POST["gender"]))
{
	$error_user_gender = 'Gender is required';
	$error++;
} else {
	$user_gender = sanitizeText($_POST["gender"]);
}

if(empty($_POST["state"]))
{
	$error_user_state = 'State is required';
	$error++;
} else {
	$user_state = sanitizeText($_POST["state"]);
}

if(empty($_POST["country"]))
{
	$error_user_country = 'Country is required';
	$error++;
} else {
	$user_country = sanitizeText($_POST["country"]);
}

if(empty($_POST["employee_number"]))
{
	$error_employee_number = 'Employee number is required';
	$error++;
} else {
	$employee_number = sanitizeNumber($_POST["employee_number"]);
}

if(empty($_POST["agency_bureau"]))
{
	$error_agency_bureau = 'Agency/Bureau is required';
	$error++;
} else {
	$agency_bureau = sanitizeText($_POST["agency_bureau"]);
}


if(empty($_POST["employee_post"]))
{
	$error_employee_post = 'Employee post is required';
	$error++;
} else {
	if(sanitizeNumber($_POST["employee_post"]) ==1){
	    $employee_post = '56001-Nigeria-Lagos';
	}else if(sanitizeNumber($_POST["employee_post"]) ==2){
	    $employee_post = '56002-Nigeria-Abuja';
	} else {
	     $employee_post = 'Error';
	}
}




        if($error > 0){
                $output = array(
                        'error'=> true,
                        'notice' =>	"Pay attention to the form below.",
                        'error_first_name'=> $error_first_name,
                        'error_last_name'=> $error_last_name,
                        'error_user_image'=> $error_user_image,
                        'error_user_email'=> $error_user_email,
                        'error_user_address'=> $error_user_address,
                        'error_user_phone'=> $error_user_phone,
                        'error_user_sec_phone'=> $error_user_sec_phone,
                        'error_user_gender'=> $error_user_gender,
                        'error_user_state'=> $error_user_state,
                        'error_user_country'=> $error_user_country,
                        'error_employee_number'=> $error_employee_number,
                        'error_agency_bureau'=> $error_agency_bureau,
                        'error_employee_post'=> $error_employee_post
                    );
    } else {
            //Run Upload
            if($canUpload){
               uploadUserImage($tmp_name, $uploadPath);
            }
            
            $data = array(
                ':staffid'=> $staffid,
                ':fname'=> $first_name,
                ':lname'=> $last_name,
                ':email'=> $user_email,
                ':address'=> $user_address,
                ':phone'=> $user_phone,
                ':sec_phone'=> $user_sec_phone,
                ':gender'=> $user_gender,
                ':state'=> $user_state,
                ':country'=> $user_country,
                ':avatar'=> $user_image,
                ':agency_bureau'=> $agency_bureau,
                ':employee_post'=> $employee_post,
                ':employee_number'=> $employee_number
            );

            $query = "UPDATE usertable SET fname= :fname, lname = :lname, email = :email, phone = :phone, second_phone = :sec_phone, address = :address, gender= :gender, state= :state, country = :country, photo = :avatar, agency_bureau= :agency_bureau, employee_post = :employee_post,  employee_number = :employee_number  WHERE staffid =:staffid";
             $statement = $connect->prepare($query);
            if($statement->execute($data)){
                     $output = array(
                    	'saved' => true,
                    	'notice' =>	"Bio updated successfully!",
                    	'protocol' =>	"nokbio_setup"
                	);
            }else{
                   $output = array(
                    	'error' => true,
                    	'notice' =>	"Failed to Update Bio",
                	);
            }
   
    }//error check
    
echo json_encode($output);
exit();
}



//update nok info
if($_POST["action"] == "updatenok"){
    
    $protocol = "";
    if($_POST['can-redirect'] == "yes"){
         $protocol = "index";
    }
        $data = array(
                ':staffid'=> $staffid,
                ':nokfname'=> sanitizeText($_POST['nokfname']),
                ':noklname'=> sanitizeText($_POST['noklname']),
                ':nokemail'=> sanitizeEmail($_POST['nokemail']),
                ':nokaddress'=> sanitizeText($_POST['nokaddress']),
                ':nokphone'=> sanitizeNumber($_POST['nokphone']),
                ':nokgender'=> sanitizeText($_POST['nokgender']),
                ':nokstate'=> sanitizeText($_POST['nokstate']),
                ':nokcountry'=> sanitizeText($_POST['nokcountry'])
            );

            $query = "UPDATE usertable SET nokfname= :nokfname, noklname = :noklname, nokemail = :nokemail, nokaddress = :nokaddress, nokphone = :nokphone, nokgender= :nokgender, nokstate= :nokstate, nokcountry = :nokcountry WHERE staffid =:staffid";
             $statement = $connect->prepare($query);
            if($statement->execute($data)){
                     $output = array(
                    	'saved' => true,
                    	'notice' =>	"Next of kin bio saved",
                    	'protocol' => $protocol
                	);
            }else{ 
                   $output = array(
                    	'error' => true,
                    	'notice' =>	"Failed to save next of kin bio"
                	);
            }

echo json_encode($output);
exit();
}

