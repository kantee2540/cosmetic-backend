<?php
include("connectDB.php");

$result = array();
$userId = $_POST["user_id"];

if (isset($_FILES['imageFile']['name'])){
    $uploaddir = "profileimg/";
    $file = $userId . ".jpg";
    $uploadfile = $uploaddir . $file;
    if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $uploadfile)){

        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||  isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $protocol = 'https://';
        }
        else {
            $protocol = 'http://';
        }

        //if localserver
        if($_SERVER["HTTP_HOST"] == "localhost:8080" || $_SERVER["HTTP_HOST"] == "192.168.1.176:8080"){
            $serverurl = "192.168.1.176:8080/webService";
        }else{
            $serverurl = $_SERVER["HTTP_HOST"];
        }
        
        $imageURL = $protocol . $serverurl . "/" . $uploadfile;

        $updateSql = "UPDATE user SET profilepic = '$imageURL' WHERE user_id = $userId ";

        array_push($result, ["upload status" => "OK", "profileURL" => $imageURL]);

        $query = mysqli_query($connectDB, $updateSql);
        if ($query){
            array_push($result, ["query status" => "OK"]);
        }else{
            array_push($result, ["query status" => $connectDB->errno]);
        }

    }else{
        array_push($result, ["upload status" => "Failed"]);
    }

    echo json_encode($result);
}

?>