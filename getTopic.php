<?php 
include("connectDB.php");

$topicCode = "topic_code";
$topicLimit = "topic_limit";

if (isset($_POST[$topicCode])){
    $sql = "SELECT * FROM today_topic WHERE topic_code = \"".$_POST[$topicCode]."\"";
}

else if (isset($_POST[$topicLimit])){
    $sql = "SELECT * FROM today_topic ORDER BY RAND() LIMIT ".$_POST[$topicLimit];
}

else{
    $sql = "SELECT * FROM today_topic";
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