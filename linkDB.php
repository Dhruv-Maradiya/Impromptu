<?php
error_reporting(E_ALL ^ E_WARNING);
// Open a new connection to the MySQL server
$linkdb = mysqli_connect("localhost:3306","root","","impromptu");  
  if (mysqli_connect_error()){ //for connection error finding
  die ('There was an error while connecting to database');
  }
?>