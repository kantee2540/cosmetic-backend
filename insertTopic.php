<?php
include("connectDB.php");

$title = $_POST["topic_name"];
$description = $_POST["topic_desc"];
$user_id = $_POST["user_id"];

$productSet = $_POST["productset"];
$productData = json_decode($productSet, true);
$imageURL = "";

$randomlength = 6;
$randomletter = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $randomlength);

$insertResult = array();

$sql = "INSERT INTO today_topic(topic_name, topic_description, topic_code, user_id, view_count) 
VALUES ('$title', '$description', '$randomletter' ,$user_id, 0)";

if($result = mysqli_query($connectDB, $sql)){

    $topicId = getTopicId($connectDB, $title);
    
    if (isset($_FILES['imageFile']['name'])){
        $uploaddir = "topicImage/";
        $file = $topicId;
        $uploadfile = $uploaddir . $file;
        if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $uploadfile)){
    
            if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||  isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
                $protocol = 'https://';
            }
            else {
                $protocol = 'http://';
            }
    
            //if localserver
            if($_SERVER["HTTP_HOST"] == "localhost" || $_SERVER["HTTP_HOST"] == "192.168.1.176:8080"){
                $serverurl = "localhost/webService";
            }else{
                $serverurl = $_SERVER["HTTP_HOST"];
            }
            
            $imageURL = $protocol . $serverurl . "/" . $uploadfile;

            $updateSql = "UPDATE today_topic SET topic_img = '$imageURL' WHERE topic_id = $topicId ";

            mysqli_query($connectDB, $updateSql);

        }else{
            echo "Error";
        }
    }

    if ($topicId != 0){

        //INSERT TO PACKAGE
        foreach($productData as $item){
            $productId = $item;

            $sql_product = "INSERT INTO packages(product_id, topic_id) VALUES($productId, $topicId)";
            if($resultInsert = mysqli_query($connectDB, $sql_product)){ }else{
                break;
            }
            
        }

        array_push($insertResult, ["status" => "OK", "topic_code" => $randomletter]);

    }else{
        array_push($insertResult, ["status" => "Failed", "error_detail" => "get todaytopic failed!"]);
    }

    
}else{
    if ($connectDB -> errno == 1062){
        array_push($insertResult, ["status" => "Failed", "error_detail" => "This title had already exist please try another title."]);
    }else{
        array_push($insertResult, ["status" => "Failed", "error_detail" => $connectDB -> errno]);
    }
}

function getTopicId($connectDB, $topicName){
    $sqlGetTopic = "SELECT topic_id FROM today_topic WHERE topic_name = '$topicName' ";
    if($resultGetTopic = mysqli_query($connectDB, $sqlGetTopic)){
        $row = mysqli_fetch_assoc($resultGetTopic);
        $topicId = $row["topic_id"];
        return $topicId;

    }else{
        return 0;
    }
}

echo json_encode($insertResult);



?>