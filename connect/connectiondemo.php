<?php
try {
    require('mysqli_connect.php');
    if($conn->connect_error){
        die("Connection failed:" .$conn->connect_erro);
    }
    echo "Connected successfully";
} catch (Exception $th) {
    echo "Caught exception:", $th->getMessage(), "\n";
}
?>