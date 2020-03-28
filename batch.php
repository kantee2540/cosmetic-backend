<?php 
include("connectDB.php");
$json = file_get_contents('https://makeup-api.herokuapp.com/api/v1/products.json');
$data = json_decode($json, true);

$num = 1;
foreach($data as $item){
    $id = $item['id'];
    $brand = $item['brand'];
    $name = $item['name'];
    $price = $item['price'] * 30;
    $image = $item['image_link'];
    $category = $item['category'];
    $description = $item['description'];
    $ingredient = "n/a";

    $brand_id = getBrandId($connectDB, $brand);

    if ($category != null){
        $category_id = getCategoryId($connectDB, $category);
    }else{
        $category_id = "NULL";
    }

    $sql = "INSERT INTO `product` (`product_name`, `brand_id`, `categories_id`, `description`, `product_price`, `ingredient`, `product_img`) 
    VALUES (\"$name\", $brand_id, $category_id, \"$description\", $price, '$ingredient', '$image') ";

    $result = mysqli_query($connectDB, $sql);
    if($result){
        echo "| $num -> OK |";
        $num++;
    }else{
        echo "| $num -> Failed! | ".$connectDB -> error;
        $num++;
    }
    
}

echo "Run success";


function getBrandId($connectDB, $brandName){

    $brands = array();
    $temp = array();
    
    $sqlBrand = "SELECT brand_id, brand_name, count(*) as countbrand FROM product_brand WHERE brand_name LIKE \"$brandName\" ";
    if($result = mysqli_query($connectDB, $sqlBrand)){
        
        $row = mysqli_fetch_assoc($result);
        if ((int)$row['brand_id'] > 0){
            //echo $row['brand_id'];
            return $row['brand_id'];
        }else{
            //echo "NULL";
            return "NULL";
        }
    }else{
        return "NULL";
    }
    
    
}

function getCategoryId($connectDB, $category){

    $sqlCategory = "SELECT categories_id ,count(*) FROM categories WHERE categories_name LIKE '$category' ";

    if($result = mysqli_query($connectDB, $sqlCategory)){
        $row = mysqli_fetch_assoc($result);
        if ((int)$row['categories_id'] > 0){
            //echo $row['categories_id'];
            return $row['categories_id'];
        }else{
            //echo "NULL";
            return "NULL";
        }
    }else{
        return "NULL";
    }
}

?>