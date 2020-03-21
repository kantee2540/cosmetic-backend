<?php
include("connectDB.php");

$user_id = $_POST["user_id"];

$sql = "DELETE FROM user WHERE user_id = '$user_id' ";

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