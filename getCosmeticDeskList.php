<?php
include("connectDB.php");

$user_id = $_POST["user_id"];

if(isset($_POST["product_id"])){
    $product_id = $_POST["product_id"];
    $sql = "SELECT * FROM cosmetic_desk c, product p, product_brand b, categories ca
    WHERE c.product_id = p.product_id 
    AND p.brand_id = b.brand_id 
    AND p.categories_id = ca.categories_id
    AND c.user_id = '$user_id' 
    AND c.product_id = '$product_id'";

}else if(isset($_POST["favorite"])){
    $order = $_POST["orderby"];
    $sql = "SELECT * FROM cosmetic_desk c, product p, product_brand b, categories ca
    WHERE c.product_id = p.product_id
    AND p.brand_id = b.brand_id 
    AND p.categories_id = ca.categories_id
    AND c.user_id = '$user_id' 
    AND c.favorite = 1 ";

    if($order == "a-z"){
        $sql .= "ORDER BY p.product_name";
    }
    else if($order == "view"){
        $sql .= "ORDER BY p.View DESC";
    }
    else if($order == "price"){
        $sql .= "ORDER BY p.product_price DESC";
    }
    else{
        $sql .= "ORDER BY c.desk_id DESC";
    }


}else if(isset($_POST["limit"])){
    $limit = $_POST["limit"];
    $sql = "SELECT * FROM cosmetic_desk c, product p, product_brand b, categories ca
    WHERE c.product_id = p.product_id 
    AND p.brand_id = b.brand_id
    AND p.categories_id = ca.categories_id
    AND c.user_id = '$user_id'
    ORDER BY c.desk_id DESC
    LIMIT $limit";

}else{
    $order = $_POST["orderby"];
    $sql = "SELECT * FROM cosmetic_desk c, product p, product_brand b, categories ca
    WHERE c.product_id = p.product_id
    AND p.brand_id = b.brand_id 
    AND p.categories_id = ca.categories_id
    AND c.user_id = '$user_id' ";

    if($order == "a-z"){
        $sql .= "ORDER BY p.product_name";
    }
    else if($order == "view"){
        $sql .= "ORDER BY p.View DESC";
    }
    else if($order == "price"){
        $sql .= "ORDER BY p.product_price DESC";
    }
    else{
        $sql .= "ORDER BY c.desk_id DESC";
    }
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