<?php
    session_start();
?>
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
      crossorigin="anonymous"
    />
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
</head>
<body>
    <div style="text-align:center;">LOGIN</div>
    <?php
    require('../connect/mysqli_connect.php');
        if (isset($_POST['submit'])) {
            if (empty($_POST["Email"]) || empty($_POST["password"])){
             echo "<p style=\"color:red;text-align:center;\">Vui lòng nhập email hoặc mật khẩu";
            }
            else {
                $Email = $_POST["Email"];
                $password = $_POST["password"];
                $mysql = "select last_name,email,passwords,user_level from users where email = '$Email'";
                $result = $conn->query($mysql);
                $row = mysqli_fetch_row($result);
                 if ($result->num_rows == 1){
                    if (password_verify($password, $row[2])) {
                       if ($row[3] == 2) {
                         $name = $row[0];
                        header('location: ../admin/page.php');
                        $_SESSION["Email"] = $_POST["Email"];
                        $_SESSION["password"] = $_POST["password"];
                        $_SESSION["name"] = $name;
                       }
                       else {
                        $_SESSION["Email"] = $_POST["Email"];
                        $_SESSION["password"] = $_POST["password"];
                           header("location: ../index.php");
                       }
                     }
                     else {
                        echo "<p style=\"color:red;text-align:center;\">Vui lòng nhập đúng mật khẩu";
                     }

            }
                 else {
                    echo "<p style=\"color:red;text-align:center;\">Vui lòng nhập đúng Email";
                 }
            }
        }    
    ?>
    <form action="bai8.php" class="container" method = "post">
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input id="inputEmail" type="email" name ="Email" class="form-control" placeholder="Enter Email">
        </div>
        <div class="form-group">
            <label for="inputPass">Password</label>
            <input id="inputPass" type="password" name="password" class="form-control" placeholder="Enter password">
        </div>
        <div class="row">
        <div class="col-lg-5"></div>
        <div class="col-lg-1">
        <div> <button type="submit" name = "submit" class="btn btn-primary" >LOGIN</button></div>
        </div>
        <div class="col-lg-1"><a href="../register/formregister.php">REGISTER</a></div>
        <div class="col-lg-5"></div>
        </div>
    </form>
</body>
</html>