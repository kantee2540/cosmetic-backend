<?php
include("connectDB.php");

$user_id = $_POST["user_id"];
$drawer_id = $_POST["drawer_id"];

$sql = "DELETE FROM drawer WHERE drawer_id = '$drawer_id' AND user_id = '$user_id' ";

if($connectDB->query($sql) === true){
    $response['error'] = false;
    $response['message'] = "Deleted data successfully";
}
else{
    $response['error'] = true;
    $response['message'] = "Error cannot delete data!";
}

echo json_encode($response);

mysqli_close($connectDB);

?>