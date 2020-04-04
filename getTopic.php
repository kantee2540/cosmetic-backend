<?php 
include("connectDB.php");

$topicCode = "topic_code";
$topicLimit = "topic_limit";
$userId = "user_id";

if (isset($_POST[$topicCode])){
    $sql = "SELECT * FROM today_topic t, user u WHERE t.user_id = u.user_id AND topic_code = \"".$_POST[$topicCode]."\"";
}

else if (isset($_POST[$topicLimit])){
    $sql = "SELECT * FROM today_topic t, user u WHERE t.user_id = u.user_id ORDER BY RAND() LIMIT ".$_POST[$topicLimit];
}

else if (isset($_POST["topic_id"])){
    $sql = "SELECT * FROM today_topic t, user u WHERE t.user_id = u.user_id AND t.topic_id = ".$_POST["topic_id"];
}

else if (isset($_POST[$userId])){
    $sql = "SELECT * FROM today_topic t, user u WHERE t.user_id = u.user_id AND t.user_id = ".$_POST[$userId];
}

else{
    $sql = "SELECT * FROM today_topic t, user u WHERE t.user_id = u.user_id";
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
else{
    echo "ERROR!! Check connection or sql syntax";
}

mysqli_close($connectDB);
?>