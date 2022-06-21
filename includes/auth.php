<?php
session_start();
if(!isset($_SESSION['Username']) && !isset($_SESSION['Email']) && !isset($_SESSION['Role'])){
    header("Location:./Home.html");
}
?>