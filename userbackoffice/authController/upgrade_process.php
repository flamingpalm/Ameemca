<?php
 require "../pdo.php";
 
 
if($_POST["action"] == "fetch")
	{
	    $id = $_POST["pkgid"];
     $data = array(':id'=> $id);
     $query = "SELECT * FROM package WHERE id = :id";
     $statement = $connect->prepare($query);
     $statement->execute($data);
     $result = $statement->fetchAll();
     $name = ''; $price = ''; $email = '';
      foreach($result as $row)
		   {
		      $name = $row["package_name"];
		      $price = $row["package_price"];
		      $email = getUserInfo("email");
	        }
	  if(!empty($name) && !empty($name) && !empty($name)){
        	  $output = array(
        			'approved' => true,
        			'name'   =>  $name,
                    'price'  =>  $price,
        			'email'	 =>	$email
        		);
	  } else {
	            $output = array(
        			'error' => true,
        			'notice' => 'Sorry, An error occured.'
        		);
	  }
	  
echo json_encode($output);
		exit();
}

//update nok info
if($_POST["action"] == "upgrade"){
           $data = array(
                ':staffid'=> $staffid,
                ':package'=> $_POST['pkgid']
            );

            $query = "UPDATE usertable SET package= :package WHERE staffid =:staffid";
             $statement = $connect->prepare($query);
            if($statement->execute($data)){
                     $output = array(
                    	'upgraded' => true,
                    	'notice' =>	"Congratulations, Your package has beeen upgraded!"
                	);
            }else{ 
                   $output = array(
                    	'error' => true,
                    	'notice' =>	"Sorry, Your package upgraded failed! - Contact Admin to refund your payment."
                	);
            }

echo json_encode($output);
exit();
}
