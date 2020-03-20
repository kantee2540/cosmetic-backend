<?php
include("connectDB.php");

$desk_id = $_POST["desk_id"];
$drawer_id = $_POST["drawer_id"];

$sql = "INSERT INTO drawer_collection(drawer_id, desk_id) VALUES ('$drawer_id', '$desk_id')";

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