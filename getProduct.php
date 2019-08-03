<?php 
include("connectDB.php");

if(isset($_POST["searchbyproduct"])){
    $sql = "SELECT * FROM product p JOIN product_brand b ON p.brand_id = b.brand_id JOIN categories c ON p.categories_id = c.categories_id WHERE p.product_name LIKE \"%" . $_POST["searchbyproduct"] . "%\"";
}
else if(isset($_POST["searchbycategories"])){
    $sql = "SELECT * FROM product p JOIN product_brand b ON p.brand_id = b.brand_id JOIN categories c ON p.categories_id = c.categories_id WHERE p.categories_id = 5";
}
else if(isset($_POST["limit"])){
    $sql = "SELECT * FROM product p JOIN product_brand b ON p.brand_id = b.brand_id JOIN categories c ON p.categories_id = c.categories_id LIMIT 5";
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