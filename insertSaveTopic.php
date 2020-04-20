<?php
include("connectDB.php");

$topicId = $_POST["topic_id"];
$userId = $_POST["user_id"];

$sql = "INSERT INTO save_today_topic(topic_id, user_id) VALUES('$topicId', '$userId')";

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