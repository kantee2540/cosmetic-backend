<?php
include("connectDB.php");

$firstName = $_POST["first_name"];
$lastName = $_POST["last_name"];
$nickName = $_POST["nick_name"];
$email = $_POST["email"];
$uid = $_POST["uid"];
$option = $_POST["option"];

// 0 = Insert
// 1 = Update
if ($option == '0'){
    $sql = "INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `nickname`, `email`, `uid`, profilepic) VALUES (NULL, '$firstName', '$lastName', '$nickName', '$email', '$uid ', '');";
}else if ($option == '1'){
    $sql = "UPDATE `user` SET first_name = '$firstName', last_name = '$lastName', nickname = '$nickName' WHERE uid = '$uid';";
}else{
    $sql = "INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `nickname`, `email`, `uid`) VALUES (NULL, '', '', '', '', '', '', '' ');";
}

if($connectDB->query($sql) === true){
    $response['error'] = false;
    $response['message'] = "Insert data successfully";
}
else{
    $response['error'] = true;
    $response['message'] = "Error cannot insert data!";
}

echo json_encode($response);


mysqli_close($connectDB);

?>