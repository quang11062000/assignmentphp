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
      <script language="JavaScript" type="text/javascript">
        function checkDelete() {
            return confirm("Press a button!");
        }
    </script>
    <style>
        .upload{
            margin-top: 10px;
            padding: 3px;
        }
        .img{
            border:1px solid red;
            border-radius: 3px;
            padding: 5px;
            background: yellowgreen;
        }
    </style>
  
</head>
<body>
   <div class="upload">
   <a class="img" href="./upload.php">Upload</a>
    <br>
    <br>
    <a class="img" href="../admin/page.php">Return</a>
   </div>
<?php
        try {
            require('../connect/mysqli_connect.php'); // Connect to the database.
            // echo "Connected successfully";
            $pagerows = 5; //set the number of rows per display page
            if (isset($_GET['p']) && is_numeric($_GET['p'])) // Has the total number of pagess already been calculated?
            {
                $pages = htmlspecialchars($_GET['p'], ENT_QUOTES);
            } else {

                // First, check for the total number of records
                $query = "SELECT count(productid) FROM products";
                $result = $conn->query($query);
                $row = $result->fetch_array(MYSQLI_NUM);
                $record = htmlspecialchars($row[0], ENT_QUOTES);

                // Calculate the number of page
                if ($record>$pagerows) { //if the number of records will fill more than one page
                    // Calculate the number of pages and round the result up to the nearest integer
                    $pages = ceil($record / $pagerows);
                } else {
                    $pages = 1;
                }
            }

            // Declare which record to start with
            if (isset($_GET['s']) && is_numeric($_GET['s'])) {
                $start = htmlspecialchars($_GET['s'], ENT_QUOTES);
            } else {
                $start = 0;
            }
            $query = "SELECT productid,productname,product_image,product_price FROM products";
            $stmt = $conn->stmt_init();
            $stmt->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) { // If it ran OK (records were returned), display the records.
                echo '<table class = "table table-srtiped">
                <tr>
                <th scope = "col">Edit</th>
                <th scope = "col">Delete</th>
                <th scope = "col">Image</th>
                <th scope = "col">Product Name</th>
                <th scope = "col">Product Price</th>
                </tr>';

                // Fetch and print all the records:
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { // Remove special characters that might already be in table to
                    // reduce the chance of XSS exploits
                    $productID = htmlspecialchars($row['productid'], ENT_QUOTES);
                    $product_image = htmlspecialchars($row['product_image'], ENT_QUOTES);
                    $product_name = htmlspecialchars($row['productname'], ENT_QUOTES);
                    $product_price = htmlspecialchars($row['product_price'], ENT_QUOTES);
                    echo '<tr>
                <td><a href="editProduct.php?id=' . $productID . '">Edit</a></td>
                <td><a href="deleteproduct.php?id=' . $productID . '" onclick="return checkDelete();">Delete</a></td>
                <td><img src="'.$row['product_image']. '" width = "100px" height="auto"></td>
                <td>' . $product_name . '</td>
                <td>' . $product_price .'</td>
                </tr>';
                }
                echo "</table>";
                $result->free_result(); // Free up the resources.
            } else { // Unlike

                // Error message:
                echo '<p class="text-center">The current users could not be retrieved.</p>';
            }

            // Now display the total number of records/members.
            $query = "SELECT count(productid) FROM products";
            $result = $conn->query($query);
            $row = $result->fetch_array(MYSQLI_NUM);
            $members = htmlspecialchars($row[0], ENT_QUOTES);
            $conn->close();
            $echostring = "<p class='text-center'>Total users: $members</p>";
            $echostring = "<p class ='text-center'>";
            if ($pages > 1) {

                // What number is the current page?
                $current_page = ($start / $pagerows);

                // If the page is not the first page then create a Previous link
                if ($current_page != 1) {
                    $echostring .= '<a herf="product.php?s=' . ($start - $pagerows) . '&p=' . $pages . '">Previous</a>';
                }

                // Create a next link
                if ($current_page != $pages) {
                    $echostring .= '<a herf="product.php?s=' . ($start + $pagerows) . '&p=' . $pages . '">Next</a>';
                }
                $echostring = '</p>';
                echo $echostring;
                echo '<input type="submit" name="un_submit" id="cancel_registration" class="btn btn-primary" value="LogOut">';
            }
        } catch (Exception $e) // We finally handle any problems here
        {
            print "An Exception occurred. Message: " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>