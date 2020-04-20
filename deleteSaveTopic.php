<?php
include("connectDB.php");

$topicId = $_POST["topic_id"];
$userId = $_POST["user_id"];

$sql = "DELETE FROM save_today_topic WHERE topic_id = '$topicId' AND user_id = '$userId' ";

if($result = mysqli_query($connectDB, $sql)){
    $response['error'] = false;
    $response['message'] = "Delete data successfully";
}
else{
    $response['error'] = true;
    $response['message'] = "Error cannot delete data!"; 
}

echo json_encode($response);

mysqli_close($connectDB);

?>