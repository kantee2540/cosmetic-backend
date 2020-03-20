<?php
include("connectDB.php");
$userId = $_POST["user_id"];

$sql = "SELECT * FROM drawer WHERE user_id = '$userId' ";

if($result = mysqli_query($connectDB, $sql)){

    $resultArray = array();
    $tempArray = array();

    while($row = $result->fetch_object()){
        $tempArray = $row;
        $drawer_id = $row -> drawer_id;
        $tempArray-> countitem = countItemInDrawer($connectDB, $drawer_id);
        array_push($resultArray, $tempArray);
    }

     echo json_encode($resultArray);
}
else{
    echo "ERROR!! Check connection or sql syntax";
}

function countItemInDrawer($conn, $drawId){
    $countItem = 0;
    $count_sql = "SELECT count(drawer_collection_id) as countitem FROM `drawer_collection` WHERE drawer_id = '$drawId'";
    if ($result = mysqli_query($conn, $count_sql)){
        $row = mysqli_fetch_assoc($result);
        $countItem = $row["countitem"];
        
    }else{
        echo "ERROR!";
    }
    return $countItem;
}

mysqli_close($connectDB);


?>