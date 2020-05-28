<?php
include("connectDB.php");

$userId = $_POST["user_id"];
$topicId = $_POST["topic_id"];

if(checkuserIsLiked($connectDB, $userId, $topicId)){
    $response['like'] = false;
    $sql = "DELETE FROM topic_like WHERE user_id = $userId AND topic_id = $topicId";
}else{
    $response['like'] = true;
    $sql = "INSERT INTO topic_like(topic_id, user_id) VALUES('$topicId', '$userId')";
}

if($connectDB->query($sql) === true){
    $response['error'] = false;
    $response['message'] = "successfully";
}
else{
    $response['error'] = true;
    $response['message'] = "Error cannot insert data!";
}

echo json_encode($response);

function checkuserIsLiked($connectDB, $userId, $topicId){

    $sql = "SELECT * FROM topic_like 
    WHERE user_id = $userId 
    AND topic_id = $topicId";

    if($result = mysqli_query($connectDB, $sql)){
        $count_row = $result->num_rows;
        if($count_row > 0){
            return true;
        }else{
            return false;
        }
    }

    else{
        echo "ERROR!! Check connection or sql syntax";
    }


}



?>