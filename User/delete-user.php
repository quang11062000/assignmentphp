<?php
session_start();
// if(!isset($_SESSION['user']) or ($_SESSION[user_level] != 1))
// if(!isset($_SESSION['user'])){
//     header("location: login-page.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
</head>
<body>
    <?php
    session_start();
    ob_start();
    if (empty($_SESSION["Email"])) {
     echo "<p style=\"color:red;text-align:center;\">Vui lòng login";
     header("location:../bai8.php");
     exit();
    }
    try {
        if((isset($_GET['id'])) && (is_numeric($_GET['id']))){
            $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
        } else{
            header("location:admin-page.php");
            exit();
        }
        require('../connect/mysqli_connect.php');
        $u_stmt = $conn->stmt_init();
        $u_query = "DELETE FROM users WHERE userid=? LIMIT 1";
        $u_stmt->prepare($u_query);
        $u_stmt->bind_param("s", $id);
        $u_stmt->execute();
        if($u_stmt->affected_rows == 1){
            echo '<h3>The record has been delete</h3>';
        } else{
            echo '<p class = "text-center">The record could not be deleted</p>';
        }

        $u_stmt->close();
        $conn->close();
        header("location: admin-page.php");
    } catch (Exception $e) {
        print "An Exception occurred.Message: ".$e->getMessage();
    }
    ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>