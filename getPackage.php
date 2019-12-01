<?php 
include("connectDB.php");

$topicCode = "topic_code";
$topicId = "topic_id";

if(isset($_POST[$topicCode])){
    $sql = "SELECT * FROM packages k JOIN product p ON k.product_id = p.product_id JOIN today_topic t ON k.topic_id = t.topic_id WHERE t.topic_code = \"".$_POST[$topicCode]."\"";

}
else if(isset($_POST[$topicId])){
    $sql = "SELECT * FROM packages k JOIN product p ON k.product_id = p.product_id JOIN today_topic t ON k.topic_id = t.topic_id WHERE t.topic_id = ".$_POST[$topicId];
}

else{
    $sql = "SELECT * FROM packages k JOIN product p ON k.product_id = p.product_id JOIN today_topic t ON k.topic_id = t.topic_id";
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