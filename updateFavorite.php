<?php
include("connectDB.php");

$cosmeticId = $_POST["desk_id"];
$favorite = $_POST["favorite"];

$sql = "UPDATE cosmetic_desk SET favorite = $favorite WHERE desk_id = $cosmeticId";

if($result = mysqli_query($connectDB, $sql)){
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