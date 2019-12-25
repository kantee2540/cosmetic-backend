<?php 
include("connectDB.php");

$productId = "productId";
$categories = "categories_id";
$brands = "brand_id";
$limit = "limit";

if(isset($_POST["searchbyproduct"])){
    $sql = "SELECT * FROM product p JOIN product_brand b ON p.brand_id = b.brand_id JOIN categories c ON p.categories_id = c.categories_id WHERE p.product_name LIKE \"%" . $_POST["searchbyproduct"] . "%\"";
}

else if(isset($_POST[$productId])){
	$sql =  "SELECT * FROM product p JOIN product_brand b ON p.brand_id = b.brand_id JOIN categories c ON p.categories_id = c.categories_id WHERE p.product_id = ". $_POST[$productId];
}

else if(isset($_POST[$categories])){
    $sql =  "SELECT * FROM product p JOIN product_brand b ON p.brand_id = b.brand_id JOIN categories c ON p.categories_id = c.categories_id WHERE p.categories_id = ". $_POST[$categories];
}

else if(isset($_POST[$brands])){
    $sql = "SELECT * FROM product p JOIN product_brand b ON p.brand_id = b.brand_id JOIN categories c ON p.categories_id = c.categories_id WHERE p.brand_id = ". $_POST[$brands];
}

else if(isset($_POST[$limit])){
    $sql = "SELECT * FROM product p JOIN product_brand b ON p.brand_id = b.brand_id JOIN categories c ON p.categories_id = c.categories_id ORDER BY RAND() LIMIT " .$_POST[$limit];
}

else{
    $sql = "SELECT * FROM product p JOIN product_brand b ON p.brand_id = b.brand_id JOIN categories c ON p.categories_id = c.categories_id";
}
//IF CHANGE TABLE NEED TO CHANGE JSONELEMENT IN XCODE


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