<?php
 
$host='localhost';
$user='root';
$password='';
$database='quickmart';

$conn= mysqli_connect($host,$user,$password,$database);
if(!$conn){
    die('Could not connect to Mysql:' .mysqli_error($conn));
}
?>