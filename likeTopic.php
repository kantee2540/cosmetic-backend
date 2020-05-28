<?php
include("connectDB.php");

$topic_id = $_GET["topic_id"];

$sql_like = "SELECT count(*) as countlike FROM topic_like
WHERE topic_id = $topic_id";

if($result = mysqli_query($connectDB, $sql_like)){
    $obj = mysqli_fetch_object($result);
    $response["countlike"] = $obj->countlike;
}

else{
    $response["error"] = true;
}

echo json_encode($response);
mysqli_close($connectDB);


?>