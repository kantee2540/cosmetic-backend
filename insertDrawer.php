<?php
include("connectDB.php");

$userId = $_POST["user_id"];
$drawer_name = $_POST["drawer_name"];

$sql = "INSERT INTO drawer(drawer_name, user_id) VALUES ('$drawer_name', '$userId')";

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