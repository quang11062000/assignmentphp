
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .c1{
            text-align: center;
        }
    </style>
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
    require("register.php");
    ?>
<form action="" class="container" method = "post">
        <div class="c1"> REGISTER</div>
        <div class="form-group">
            <label for="inputFirstName">FirstName</label>
            <input id="inputFirstName" type="name" name ="First_name" class="form-control" placeholder="Enter FirstName" require>
        </div>
        <div class="form-group">
            <label for="inputLastName">LastName</label>
            <input id="inputFirstName" type="name" name ="Last_name" class="form-control" placeholder="Enter LastName" require>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input id="inputEmail" type="email" name ="Email" class="form-control" placeholder="Enter Email" require>
        </div>
        <div class="form-group">
            <label for="inputPass">Password</label>
            <input id="inputPass" type="password" name="password" class="form-control" placeholder="Enter password" require>
        </div>
        <div class="form-group">
            <label for="inputRePass">Re-Password</label>
            <input id="inputRePass" type="password" name="re_password" class="form-control" placeholder="Enter password" require>
        </div>
        <div> <button type="submit" name = "submit" class="btn btn-primary" >REGISTER</button></div>
    </form>
</body>
</html>