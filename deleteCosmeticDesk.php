<?php
include("connectDB.php");
$user_id = $_POST["user_id"];
$product_id = $_POST["product_id"];

$sql = "DELETE FROM cosmetic_desk WHERE user_id = '$user_id' AND product_id = '$product_id'";

if($connectDB->query($sql) === true){
    $response['error'] = false;
    $response['message'] = "Deleted data successfully";
}
else{
    $response['error'] = true;
    $response['message'] = "Error cannot insert data!";
}

echo json_encode($response);

mysqli_close($connectDB);

?>