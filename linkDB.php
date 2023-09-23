<?php
error_reporting(E_ALL ^ E_WARNING);
// Open a new connection to the MySQL server
$linkdb = mysqli_connect("b9hyorj4ggjw4md64jbt-mysql.services.clever-cloud.com:3306","u9jehhalm6pn2r6h","8xz4MUPLWdR9vS0NCamn","b9hyorj4ggjw4md64jbt");  
  if (mysqli_connect_error()){ //for connection error finding
  die ('There was an error while connecting to database');
  }
?>