<?php
include("connectDB.php");

$response = array();

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];

$sql = "INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, profilepic) VALUES (NULL, '$firstname', '$lastname', '$email', 's')";

if($connectDB->query($sql) === true){
    $response['error'] = false;
    $response['message'] = "Insert data successfully";
}
else{
    $response['error'] = true;
    $response['message'] = "Error cannot insert data!";
}

echo json_encode($response);


mysqli_close($connectDB);
?>