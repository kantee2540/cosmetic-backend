<?php
include("connectDB.php");
$userId = $_POST["user_id"];

$sql = "SELECT * FROM drawer WHERE user_id = '$userId' ";

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