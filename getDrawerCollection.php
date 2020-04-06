<?php
include("connectDB.php");
$userId = $_POST["user_id"];
$drawerId = $_POST["drawer_id"];

$sql = "SELECT * FROM drawer_collection c, cosmetic_desk d, drawer r, product p, product_brand b
WHERE c.desk_id = d.desk_id
AND c.drawer_id = r.drawer_id 
AND d.product_id = p.product_id
AND p.brand_id = b.brand_id
AND d.user_id = $userId
AND c.drawer_id = $drawerId 
ORDER BY c.drawer_collection_id DESC";

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