<?php
include("connectDB.php");
$user_id = $_POST["user_id"];
$product_id = $_POST["product_id"];

$sql = "INSERT INTO `cosmetic_desk` (`desk_id`, `product_id`, `user_id`) VALUES (NULL, '$product_id', '$user_id');";

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