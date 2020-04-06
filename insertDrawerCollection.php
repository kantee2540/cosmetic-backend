<?php
include("connectDB.php");

$drawer_id = $_POST["drawer_id"];

//For multiselect
if(isset($_POST["desk_set"])){
    $desk_set = $_POST["desk_set"];
    $data = json_decode($desk_set, true);

    foreach($data as $item){
        $sql_insert = "INSERT INTO drawer_collection(drawer_id, desk_id) VALUES ('$drawer_id', '$item')";

        if($resultInsert = mysqli_query($connectDB, $sql_insert)){
             $response['error'] = false;

        }else{
            $response['error'] = true;
            
            break;
        }
        
    }
    echo json_encode($response);

}

else if(isset($_POST["desk_id"])){
    $desk_id = $_POST["desk_id"];
    $sql = "INSERT INTO drawer_collection(drawer_id, desk_id) VALUES ('$drawer_id', '$desk_id')";

    if($connectDB->query($sql) === true){
        $response['error'] = false;
        $response['message'] = "Insert data successfully";
    }
    else{
        $response['error'] = true;
        $response['message'] = "Error cannot insert data!";
    }

    echo json_encode($response);

mysqli_close($connectDB);
}

?>