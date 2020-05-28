<?php 
include("connectDB.php");

$topicCode = "topic_code";
$topicId = "topic_id";

if(isset($_GET[$topicCode])){
    $sql = "SELECT * FROM packages k, product p, today_topic t, categories c
    WHERE k.product_id = p.product_id
    AND k.topic_id = t.topic_id 
    AND p.categories_id = c.categories_id
    AND t.topic_code = \"".$_GET[$topicCode]."\"";

}
else if(isset($_GET[$topicId])){
    $sql = "SELECT * FROM packages k, product p, today_topic t, categories c
    WHERE k.product_id = p.product_id
    AND k.topic_id = t.topic_id 
    AND p.categories_id = c.categories_id
    AND t.topic_id = ".$_GET[$topicId];
}

else{
    $sql = "SELECT * FROM packages k, product p, today_topic t, categories c
    WHERE k.product_id = p.product_id
    AND k.topic_id = t.topic_id
    AND p.categories_id = c.categories_id";
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