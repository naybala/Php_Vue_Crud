<?php
  
$conn = new mysqli("localhost", "root", "", "php_vue_db");
  
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  
$out = array('error' => false, 'username'=> false, 'email'=> false, 'password' => false);
  
$action = 'alldata';
  
if(isset($_GET['action'])){
    $action = $_GET['action'];
}
  
  
if($action == 'alldata'){
    $sql = "select * from user";
    $query = $conn->query($sql);
    $users = array();
  
    while($row = $query->fetch_array()){
        array_push($users, $row);
    }
  
    $out['users'] = $users;
}
  
if($action == 'register'){
  
    function check_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
  
    $username = check_input($_POST['username']);
    $email = check_input($_POST['email']);
    $password = check_input($_POST['password']);
  
    if($username==''){
        $out['username'] = true;
        $out['message'] = "User Name is required";
    }   
     
    elseif($email==''){
        $out['email'] = true;
        $out['message'] = "Email is required";
    }
  
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $out['email'] = true;
        $out['message'] = "Invalid Email Format";
    }
  
    elseif($password==''){
        $out['password'] = true;
        $out['message'] = "Password is required";
    }
  
    else{
        $sql="select * from user where user_email='$email'";
        $query=$conn->query($sql);
  
        if($query->num_rows > 0){
            $out['email'] = true;
            $out['message'] = "Email already exist";
        }
  
        else{
            $sql = "insert into user (user_name, user_email, user_password) values ('$username', '$email', '$password')";
            $query = $conn->query($sql);
  
            if($query){
                $out['message'] = "User Added Successfully";
            }
            else{
                $out['error'] = true;
                $out['message'] = "Could not add User";
            }
        }
    }
}
 
if($action == 'delete'){
 
    $del = $_GET['id'];                              
    $sqldel = "DELETE FROM user WHERE user_id = '".$del."'";
    $conn->query($sqldel);
       
    $out['message'] = "Deleted $del";
     
}
 
$conn->close();
  
header("Content-type: application/json");
echo json_encode($out);
die();
  
  
?>