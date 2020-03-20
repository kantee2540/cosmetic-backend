<?php
include("connectDB.php");

$drawer_collection_id = $_POST["drawer_collection_id"];

$sql = "DELETE FROM drawer_collection WHERE drawer_collection_id = '$drawer_collection_id'";

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