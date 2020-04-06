<?php
include("connectDB.php");

if (isset($_GET["cosmeticid"])){

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
        $pathURL = "location: cosmeticas://cosmetic?id=".$productid;
        header($pathURL);

    }else if ($Android){
        //if found device as Android
        echo "App for Android comming soon! ^_^";

    }else{
        //if found device as other device
        
    }
}

else if (isset($_GET["topicId"])){

    $topicId = $_GET["topicId"];

    $sql = "SELECT * FROM today_topic WHERE topic_id = $topicId";

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
        $pathURL = "location: cosmeticas://topic?id=".$topicId;
        header($pathURL);

    }else if ($Android){
        //if found device as Android
        echo "App for Android comming soon! ^_^";

    }else{
        //if found device as other device
        
    }
}

else{

}

?>

<html>
<head>
<link rel="shortcut icon" href="cosmetic_icon.ico">
<title> 
 <?php
    if(isset($_GET["cosmeticid"])){
        //Uncomment this code when app has released
        //echo $row["product_name"] . " - "; 
    }else if(isset($_GET["topicId"])){
        echo $row["topic_name"] . " - ";
    }
 ?>
    Cosmeticas
 </title>
 <link rel="stylesheet" href="index_style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="topbar">
    <a href="index.php" style="tranform: translateX(-50%);">
        <img src="index_icon.svg" width="60" height="60">
    </a>
</div>
<div class ="container">
<?php
if(isset($_GET["cosmeticid"])){ ?>
    <h1 class="product_title"><?php echo $row["product_name"]; ?></h1>
    <?php echo $row["description"] ?>
    <div class="image">
    <img src="<?php echo $row["product_img"]?>" width="300" height="300">
    </div>

<?php
}else{
    echo "<h1 class='product_title'>Pick for you</h1>";?>
    <div class="row">
    <?php
    $sql ="SELECT * FROM product ORDER BY RAND() LIMIT 15";
    if($resultall=mysqli_query($connectDB, $sql)){ 
        while($rowall=mysqli_fetch_array($resultall)) { ?>
            
            <a class="product-row col-lg-4 col-md-6" href="index.php?cosmeticid=<?php echo $rowall["product_id"]; ?>">
                <div class="row">
                    <div class="col-4">
                        <img src="<?php echo $rowall["product_img"];?>" width="100" height="100">
                    </div>
                    <div class="col-8">
                        <?php echo $rowall["product_name"]; ?>
                        <div class="price">
                            <b>Price : <?php echo number_format($rowall["product_price"], 2);?> Baht</b>
                        </div>
                    </div>
                </div>
            </a>
        <?php
        }
    }else{
        echo "Error!";
    }
}
?>
    </div>
</div>
</body>
</html>