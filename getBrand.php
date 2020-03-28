<?php
include("connectDB.php");

$sql = "SELECT * FROM product_brand ORDER BY brand_name";

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