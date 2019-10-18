<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="adminstyle.css">
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
<?php
   session_start();
   ob_start();
   if (empty($_SESSION["Email"])) {
    echo "<p style=\"color:red;text-align:center;\">Vui lòng login";
    header("location:../login/bai8.php");
    exit();
   }
   else {
     $name = $_SESSION["name"];
   }
    if (isset($_POST["Logout"])){
        session_unset();
        session_destroy();
        header("location:../login/bai8.php");
        ob_end_flush(); 
        exit();
       }   
?>
<div class="container-fluid">
       <div class="col-lg-6"></div>
       <div class="col-lg-6 sm">
        <form action="" method = "post">
           <div class="row">
          <div class="cl">
          <?php
           echo "<br>";
           echo "Hello ".$name;
           ?>
          </div>
            <div><button  class="btn btn-primary" name = "Logout">LOGOUT</button></div>
            <br>
           </div>
        </form>
       </div>
    <div class="contaner">
        <ul class="nav nav-tabs">
             <li class="nav-item">
                 <a class="nav-link" href="../User/admin-page.php">User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Product/product.php">Product</a>
            </li>
        </ul>
    </div>
    <div class="ad">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="./image/ban-da-nhin-thay-canh-dong-hoa-cai-nao-dep-den-me-man-the-nay-f8bc126d98201a342c8f01-1489643268-width900height600.jpg" alt="">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./image/canh-dep-tuyet-mi-o-sa-pa.jpg" alt="">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./image/ban-da-nhin-thay-canh-dong-hoa-cai-nao-dep-den-me-man-the-nay-f8bc126d98201a342c9002-1489643268-width900height600.jpg" alt="">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    </div>
</div>
</body>
</html>