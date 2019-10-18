
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"/>
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"></script>
</head>
<body>
<?php
    require("../connect/mysqli_connect.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"] ["name"]);
        $uploadOK = 1;
        $imangeFileTyle = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (isset($_POST["submit"])) {
            echo $target_file;
            $check = getimagesize($_FILES["fileToUpload"] ["tmp_name"]);
            if ($check !== FALSE) {
                echo "File is an image - " . $check["mime"] . ".";
               $uploadOK = 1;
               if (file_exists($target_file)) {
                echo "file already exists .";
                $uploadOK = 0;
             }
             if ($imangeFileTyle != "jpg" && $imangeFileTyle != "png" && $imangeFileTyle != "jpeg" && $imangeFileTyle != "gif") {
                echo "no , only jpg are allowed";
                $uploadOK = 0;
             }
             if($uploadOK == 0){
                 echo "sorry, your file was not uploaded";
             }
             else {
                 if (move_uploaded_file($_FILES["fileToUpload"] ["tmp_name"], $target_file)) {
                    $product_name = $_POST["product_name"];
                    $product_price = $_POST["product_price"];
                        $mysql = "insert into products(productname,product_image,product_price) values ('$product_name','$target_file','$product_price')";
                        echo $mysql;
                        // $result = mysqli_query($conn,$mysql); 
                        if ($conn->query($mysql) === TRUE) {
                            echo "<p style=\"color:red;text-align:center;\">Upload Successed!";
                            header("location: product.php");
                            exit();
                            // sleep(2000);
                            exit();
                        } else {
                            echo "Error: " . $mysql . "<br>" . $conn->error;
                        }
                    }
             }
            }else {
                echo "File is not an image .";
                $uploadOK = 0;
            }
        }
    }
?>
<form action="" method="post" class="container" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputPrName">Product Name</label>
            <input id="inputPrName" type="name" name ="product_name" class="form-control" placeholder="Enter Product name" require>
        </div>
        <div class="form-group">
            <label for="inputimage">Image</label>
            <br>
            <input id="inputimage" type="file" name="fileToUpload" require>
        </div>
        <div class="form-group">
            <label for="inputprice">Price</label>
            <input id="inputprice" type="number" name="product_price" class="form-control" placeholder="Enter price" require>
        </div>
        <div> <button type="submit" name="submit" class="btn btn-primary" >UPLOAD</button></div>
    </form>
</body>
</html>
