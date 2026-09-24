<?php
$host="localhost";
$username="root";
$password="";
$database="crud";
$connection= new mysqli($host,$username,$password,$database);
if($connection->connect_error){
    echo "connection failed";
}
// echo "connection Sucessfull";
?>