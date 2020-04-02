<?php
include("connectDB.php");

if (isset($_GET["cosmeticid"])){

    $cosmeticId = $_GET["cosmeticid"];

    $productid = $_GET["cosmeticid"];
    $sql = "SELECT * FROM product WHERE product_id = $productid";

    if ($result = mysqli_query($connectDB, $sql)){
        $row = mysqli_fetch_assoc($result);
    }else{
        echo "Error";
    }

    $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");

    if($iPhone || $iPod || $iPad){
        //if found device as iOS
        $pathURL = "location: cosmeticas://cosmetic?id=".$cosmeticId;
        header($pathURL);

    }else if ($Android){
        //if found device as Android
        echo "App for Android comming soon! ^_^";

    }else{
        //if found device as other device
        echo "Welcome to cosmeticas! for website comming soon!";
    }
}else{
}

?>

<html>
<head>
<link rel="shortcut icon" href="cosmetic_icon.ico">
<title> Cosmeticas
 <?php
    if(isset($_GET["cosmeticid"])){
        echo "- ". $row["product_name"];
    }
 ?>
 </title>
</head>
<body>
    <?php
    if(isset($_GET["cosmeticid"])){
        echo $row["description"];
    }
    ?>
</body>
</html>