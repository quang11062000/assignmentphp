<?php
    session_start();
    require("../connect/mysqli_connect.php");
    if(isset($_POST['submit'])){
        if (empty($_POST['First_name']) || empty($_POST['Last_name']) || empty($_POST['Email']) || empty($_POST['password']) || empty($_POST['re_password'])) {
            echo "<p style=\"color:red;text-align:center;\">Vui lòng nhập thông tin";
        } 
        else {
            if ($_POST["password"] != $_POST["re_password"] ) {
                echo "<p style=\"color:red;text-align:center;\">mật khẩu không trùng nhau";
             }
             else {
                $FirstName = $_POST["First_name"];
                $LastName = $_POST["Last_name"];
                $Email = $_POST["Email"];
                $password = $_POST["password"];
                $hash = password_hash($password, PASSWORD_DEFAULT);
            $_SESSION["Email"] = $_POST["Email"];
            $_SESSION["password"] = $hash;
            $a = 1;
                $mysql1 = "select * from users where email = '$Email';";
                $result = $conn->query($mysql1);
                 if ($result->num_rows != 0){
                    echo "<p style=\"color:red;text-align:center;\">Tài khoản đã tồn tại!";
                }
                 else {
                    $mysql = "insert into users(firs_tname,last_name,email,passwords,registration_date,user_level) values ( '$FirstName', '$LastName', '$Email','$hash','".date("Y-m-d H:i:s")."', $a)";
                    // $result = mysqli_query($conn,$mysql); 
                    if ($conn->query($mysql) === TRUE) {
                        echo "<p style=\"color:red;text-align:center;\">Đăng ký thành công!";
                        // sleep(2000);
                        $_SESSION["name"] = $row[1];
                        echo $_SESSION["name"];
                       header("location: ../login/bai8.php");
                        exit();
                    } else {
                        echo "Error: " . $mysql . "<br>" . $conn->error;
                    }
                }
                
                $conn->close();
             }
        }
}
?>