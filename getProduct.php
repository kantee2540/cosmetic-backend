<?php
session_start();
include("connectDB.php");
if(!isset($_SESSION['countedItem'])){
    $_SESSION['countedItem'] = array();
}

$productId = "productId";
$categories = "categories_id";
$brands = "brand_id";
$limit = "limit";

if(isset($_POST["keyword"])){
    $keyword = $_POST["keyword"];
    getProductBySearch($connectDB, $keyword);

}else if(isset($_POST[$categories]) && isset($_POST[$brands])){
    $sql =  "SELECT * FROM product p 
    JOIN product_brand b ON p.brand_id = b.brand_id 
    JOIN categories c ON p.categories_id = c.categories_id 
    WHERE p.categories_id = $_POST[$categories]
    AND p.brand_id = $_POST[$brands]";

    if (isset($_POST["pricemin"]) && isset($_POST["pricemax"])){
        $min = $_POST["pricemin"];
        $max = $_POST["pricemax"];
        $sql .= " AND p.product_price >= $min AND p.product_price <= $max";
    }

    else if (isset($_POST["pricemin"])){
        $min = $_POST["pricemin"];
        $sql .= " AND p.product_price >= $min";

    }else if(isset($_POST["pricemax"])){
        $max = $_POST["pricemax"];
        $sql .= " AND p.product_price <= $max";
    }

    $sql .= " ORDER BY p.product_name";
    getProduct($connectDB, $sql);
}

else if(isset($_POST[$productId])){
	$sql =  "SELECT * FROM product p 
    JOIN product_brand b ON p.brand_id = b.brand_id 
    JOIN categories c ON p.categories_id = c.categories_id 
    WHERE p.product_id = ". $_POST[$productId];
    countView($connectDB, $_POST[$productId]);
    getProduct($connectDB, $sql);
}

else if(isset($_POST[$categories])){
    $sql =  "SELECT * FROM product p 
    JOIN product_brand b ON p.brand_id = b.brand_id 
    JOIN categories c ON p.categories_id = c.categories_id 
    WHERE p.categories_id = $_POST[$categories]";

    if (isset($_POST["pricemin"]) && isset($_POST["pricemax"])){
        $min = $_POST["pricemin"];
        $max = $_POST["pricemax"];
        $sql .= " AND p.product_price >= $min AND p.product_price <= $max";
    }

    else if (isset($_POST["pricemin"])){
        $min = $_POST["pricemin"];
        $sql .= " AND p.product_price >= $min";

    }else if(isset($_POST["pricemax"])){
        $max = $_POST["pricemax"];
        $sql .= " AND p.product_price <= $max";
    }

    $sql .= " ORDER BY p.product_name";
    getProduct($connectDB, $sql);
}

else if(isset($_POST[$brands])){
    $sql = "SELECT * FROM product p 
    JOIN product_brand b ON p.brand_id = b.brand_id 
    JOIN categories c ON p.categories_id = c.categories_id 
    WHERE p.brand_id = $_POST[$brands]";

    if (isset($_POST["pricemin"]) && isset($_POST["pricemax"])){
        $min = $_POST["pricemin"];
        $max = $_POST["pricemax"];
        $sql .= " AND p.product_price >= $min AND p.product_price <= $max";
    }

    else if (isset($_POST["pricemin"])){
        $min = $_POST["pricemin"];
        $sql .= " AND p.product_price >= $min";

    }else if(isset($_POST["pricemax"])){
        $max = $_POST["pricemax"];
        $sql .= " AND p.product_price <= $max";
    }

    $sql .= " ORDER BY p.product_name";
    getProduct($connectDB, $sql);
}

else if(isset($_POST["pricemin"]) || isset($_POST["pricemax"])){

    $sql = "SELECT * FROM product p 
    JOIN product_brand b ON p.brand_id = b.brand_id 
    JOIN categories c ON p.categories_id = c.categories_id
    WHERE";

    if (isset($_POST["pricemin"]) && isset($_POST["pricemax"])){
        $min = $_POST["pricemin"];
        $max = $_POST["pricemax"];
        $sql .= " p.product_price >= $min AND p.product_price <= $max";
    }

    else if (isset($_POST["pricemin"])){
        $min = $_POST["pricemin"];
        $sql .= " p.product_price >= $min";

    }else if(isset($_POST["pricemax"])){
        $max = $_POST["pricemax"];
        $sql .= " p.product_price <= $max";
    }

    $sql .= " ORDER BY p.product_price";

    getProduct($connectDB, $sql);
}

else if(isset($_POST["sort"])){
    $sort = $_POST["sort"];
    if($sort == 1){
        $option = "p.View";
    }else{
        $option = "RAND()";
    }
    $sql = "SELECT * FROM product p 
    JOIN product_brand b ON p.brand_id = b.brand_id 
    JOIN categories c ON p.categories_id = c.categories_id 
    ORDER BY $option DESC LIMIT 10";
    getProduct($connectDB, $sql);
}

else if(isset($_POST[$limit])){
    $sql = "SELECT * FROM product p 
    JOIN product_brand b ON p.brand_id = b.brand_id 
    JOIN categories c ON p.categories_id = c.categories_id 
    ORDER BY RAND() LIMIT " .$_POST[$limit];
    getProduct($connectDB, $sql);
}

else{
    $sql = "SELECT * FROM product p 
    JOIN product_brand b ON p.brand_id = b.brand_id 
    JOIN categories c ON p.categories_id = c.categories_id
    ORDER BY p.product_name";
    getProduct($connectDB, $sql);
}

function getProduct($connectDB, $sql){
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
}

function getProductBySearch($connectDB, $keyword){
    $splitKeyword = explode(" ", $keyword);

    $resultObject = array();

    foreach($splitKeyword as $item){
        $sql = "SELECT * FROM product p 
        JOIN product_brand b ON p.brand_id = b.brand_id 
        JOIN categories c ON p.categories_id = c.categories_id 
        WHERE p.product_name LIKE \"%$item%\" 
        ORDER BY p.product_name";

        if($result = mysqli_query($connectDB, $sql)){

            $resultArray = array();
            $tempArray = array();

            while($row = $result->fetch_object()){
                $tempArray = $row;
                array_push($resultArray, $tempArray);
            }

            array_push($resultObject, $resultArray);
        }

        else{
            echo "ERROR!! Check connection or sql syntax";
        } 
    }

    echo json_encode($resultArray);
}

function countView($connectDB, $productId){

    if(!in_array($productId, $_SESSION['countedItem'])){
        $updateCount = mysqli_query($connectDB, "UPDATE product SET View = View + 1 WHERE product_id = $productId");
        array_push($_SESSION['countedItem'], $productId);
    }
}

mysqli_close($connectDB);

?>