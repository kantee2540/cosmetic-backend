<?php
include("connectDB.php");

$userId = $_POST["user_id"];

if(isset($_POST["topic_id"])){
    $topicId = $_POST["topic_id"];
    $sql = "SELECT * FROM save_today_topic s, today_topic t
    WHERE s.topic_id = t.topic_id 
    AND s.user_id = '$userId' 
    AND s.topic_id = '$topicId' ";
}else{
    $sql = "SELECT * FROM save_today_topic s, today_topic t 
    WHERE s.topic_id = t.topic_id 
    AND s.user_id = '$userId'";
}

if($result = mysqli_query($connectDB, $sql)){
    $resultArray = array();
    $tempArray = array();

    while($row = $result->fetch_object()){
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }

    echo json_encode($resultArray);
}

mysqli_close($connectDB);

?>