<?php
include("connectDB.php");

$userId = $_POST["user_id"];
$topicId = $_POST["topic_id"];

$sql = "SELECT * FROM topic_like 
    WHERE user_id = $userId 
    AND topic_id = $topicId";

if($result = mysqli_query($connectDB, $sql)){
    $count_row = $result->num_rows;
    if($count_row > 0){
        $response["like"] = true;
    }else{
        $response["like"] = false;
    }
}
else{
    $response["error"] = true;
}

echo json_encode($response);
mysqli_close($connectDB);


?>