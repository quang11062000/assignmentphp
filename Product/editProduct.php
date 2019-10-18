<?php
session_start();
ob_start();
if (empty($_SESSION["Email"])) {
 echo "<p style=\"color:red;text-align:center;\">Vui lòng login";
 header("location: ../login/bai8.php");
 exit();
}
try {
    if((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
        $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
    } else if((isset($_POST['id'])) && (is_numeric($_POST['id']))){
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
    } else{
        // header("location:admin-page.php");
        // exit();
    }
    require('../connect/mysqli_connect.php');
    $s_stmt = $conn->stmt_init();
    $s_query = "SELECT * FROM products WHERE productid = ?";
    $s_stmt->prepare($s_query);
    $s_stmt->bind_param('i',$id);
    $s_stmt->execute();
    $result = $s_stmt->get_result();
    $row1 = $result->fetch_array(MYSQLI_ASSOC);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // if (empty($_POST['products_image'] || empty($_POST['productname']) || empty($_POST['product_price']))) {
        //     echo "<p style=\"color:red;text-align:center;\">Vui lòng nhập thong tin!";
        // }
        // else {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"] ["name"]);
                $uploadOK = 1;
                $imangeFileTyle = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"] ["tmp_name"]);
                    echo $target_file;
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
                            echo $target_file;
                            $productname = $_POST['productname'];
                            $product_price = $_POST['product_price'];
                            $s_stmt1 = $conn->stmt_init();
                            $s_query1 = "update products set product_image = ?, productname = ?, product_price = ?  WHERE productid = ?";
                            $s_stmt1->prepare($s_query1);
                            $s_stmt1->bind_param('ssdi', $target_file, $productname, $product_price, $id);
                            $s_stmt1->execute();
                            if($s_stmt1->execute() == TRUE){
                                echo "<p style=\"color:red;text-align:center;\">Cập nhật thành công!";
                                header("location: product.php");
                                exit();
                            }
                            else {
                                echo "<p style=\"color:red;text-align:center;\">Cập nhật không thành công!";
                            }
                    }else {
                        echo "File is not an image .";
                        $uploadOK = 0;
                    }
                }
            
                
        
    }
 }
}
}catch(Exception $e)
{

}
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Adim Page</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
            <script language="JavaScript" type="text/javascript">
            function checkUpdate(){
                return confirm('Are you sure to update this user');
            }
            </script>
        </head>
        <body>
        <div class="container">
            <h2 class = "h2 text-center">Edit a Record</h2>
            <form action="editProduct.php?id=<?php echo $id=$_GET["id"] ?>" method = "post" name = "editform" onsubmit = "return checkUpdate()">
            <div class="form-group row">
                <label for="products_image" class = "col-sm-4 col-form-label text-right">Product Image*:</label>
                <div class="col-sm-8">
                    <input type="file" class = "form-control" id = "products_image" name = "fileToUpload">
                </div>
            </div>
            <div class="form-group row">
            <label for="productname" class = "col-sm-4 col-form-label text-right">Product Name*:</label>
                <div class="col-sm-8">
                    <input type="text" class = "form-control" id = "productname" name = "productname"
                    maxlength = "40" require
                    value = "<?php if(isset($row1['productname']))
                    echo htmlspecialchars($row1['productname'], ENT_QUOTES);?>">
                </div>
            </div>
            <div class="form-group row">
            <label for="product_price" class = "col-sm-4 col-form-label text-right">E-mail*:</label>
                <div class="col-sm-8">
                    <input type="text" class = "form-control" id = "product_price" name = "product_price"
                    maxlength = "60" require
                    value = "<?php if(isset($row1['product_price']))
                    echo htmlspecialchars($row1['product_price'], ENT_QUOTES);?>">
                </div>
            </div>
            <input type="hidden" name="id" value = "<?php echo $userid ?>"/>
            <div class="form-group row">
                <label for="" class = "col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                <input action = "edit-user.php" type="submit" class ="btn btn-primary" type ="submit" name="submit" value ="Update">
                </div>
            </div>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>
        </html>
        <?php
?>