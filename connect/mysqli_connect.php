<?php
define('db_user','root');
define('db_password','root');
define('db_port',8889);
define('db_host','localhost');
define('db_name','onlineshopdb');
$conn = new mysqli(db_host,db_user,db_password,db_name,db_port);
$conn->set_charset('utf-8');
?>